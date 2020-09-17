<?php 
    if (isset($_GET['post_id'])) {
        $the_post_id = mysqli_real_escape_string( $connection , $_GET['post_id'] );
    }else{
        header("location:comments.php");
    }
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM comments INNER JOIN posts 
                    ON comments.comment_post_id = posts.post_id 
                    WHERE comment_post_id = {$the_post_id}
                    ORDER BY comment_date DESC";

        $select_posts = mysqli_query( $connection, $query );
        while( $row = mysqli_fetch_assoc( $select_posts ) ) {

            $comment_id          = $row['comment_id'];
            $comment_post_id     = $row['comment_post_id'];
            $comment_post_title  = $row['post_title'];
            $comment_author      = $row['comment_author'];
            $comment_content     = $row['comment_content'];
            $comment_email       = $row['comment_email'];
            $comment_status      = $row['comment_status'];
            $comment_date        = $row['comment_date'];
            
            $comment_timestamp=strtotime($comment_date);
            $comment_time=date("Y-m-d h:i:s A", $comment_timestamp);
            
            echo
            "
                <tr>
                    <td>{$comment_id}</td>
                    <td>{$comment_author}</td>
                    <td>{$comment_content}</td>
                    <td>{$comment_email}</td>
                    <td>{$comment_status}</td>
                    <td><a href='../post.php?post_id={$comment_post_id}'>{$comment_post_title}</a></td>
                    <td>{$comment_time}</td> 
                    <td><a href='{$_SERVER['REQUEST_URI']}&approve_comment_id={$comment_id}'>Approve</a></td> 
                    <td><a href='{$_SERVER['REQUEST_URI']}&unapproved_comment_id={$comment_id}'>Unapprove</a></td> 
                    <td><a href='{$_SERVER['REQUEST_URI']}&delete={$comment_id}'>Delete</a></td> 
                </tr>
            ";
        }
    ?>
    </tbody>
</table>


<?php 
if(isset($_GET['approve_comment_id'])){
    $the_comment_id = escape($_GET['approve_comment_id']);
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
    $approved_query = mysqli_query( $connection, $query );
    if( $approved_query ) {
        header("location:comments.php?source=post_comments&post_id={$_GET['post_id']}");
    }
    else{
        die("QUERY FAILED ".mysqli_error($connection));
    }
}
?>

<?php 
if(isset($_GET['unapproved_comment_id'])){
    $the_comment_id = escape($_GET['unapproved_comment_id']);
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
    $unapproved_query = mysqli_query( $connection, $query );
    if( $unapproved_query ) {
        header("location:comments.php?source=post_comments&post_id={$_GET['post_id']}");
    }
    else{
        die("QUERY FAILED ".mysqli_error($connection));
    }
}
?>

<?php 
if(isset($_GET['delete'])){
    $the_comment_id = escape($_GET['delete']);
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query( $connection, $query );
    if( $delete_query ) {

        $the_post_id = escape($_GET['post_id']);
        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 "; 
        $query .= "WHERE post_id = {$the_post_id} "; 
        $update_comment_count = mysqli_query($connection, $query);
        if($update_comment_count){
            header("location:comments.php?source=post_comments&post_id={$_GET['post_id']}");
        }else{
            die("QUERY FAILED ".mysqli_error($connection));
        }
        

    }
    else{
        die("QUERY FAILED ".mysqli_error($connection));
    }
}
?>