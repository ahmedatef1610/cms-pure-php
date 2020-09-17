<?php require "./includes/delete_modal.php"?>
<?php
    if ( isset( $_POST['submit'] ) ) {
        if ( isset( $_POST['checkBoxArray'] ) ) {
            foreach ( $_POST['checkBoxArray'] as $key => $postID ) {

                $bulk_options = $_POST['bulk_options'];

                if ( empty($bulk_options)) {
                    echo '<h5>Choose Options</h5>';
                }
                elseif ( $bulk_options == 'published' ) {
                    $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id='$postID' ";
                    $update_to_published_status = mysqli_query( $connection, $query );
                    confirmQuery( $update_to_published_status );
                }
                elseif ( $bulk_options == 'draft' ) {
                    $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id='$postID' ";
                    $update_to_draft_status = mysqli_query( $connection, $query );
                    confirmQuery( $update_to_draft_status );
                }
                elseif ( $bulk_options == 'delete' ) {
                    $query = "DELETE FROM posts WHERE post_id='$postID' ";
                    $update_to_delete_status = mysqli_query( $connection, $query );
                    confirmQuery( $update_to_delete_status );
                }
                elseif ( $bulk_options == 'clone' ) {

                    $query = "SELECT * FROM posts WHERE post_id = '{$postID}' ";
                    $select_post_query = mysqli_query($connection, $query);
                
                    $row = mysqli_fetch_array($select_post_query);
                    $post_title         = $row['post_title'];
                    $post_category_id   = $row['post_category_id'];
                    $post_date          = $row['post_date']; 
                    $post_user        = $row['post_user'];
                    $post_status        = $row['post_status'];
                    $post_image         = $row['post_image'] ; 
                    $post_tags          = $row['post_tags']; 
                    $post_content       = $row['post_content'];
                    
        
                    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
                    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
                    $copy_query = mysqli_query($connection, $query);   
                    if(!$copy_query ) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }  
                }
            }
            header("location:{$_SERVER['REQUEST_URI']}");
        }
    }
?>

<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post'>

    <table class='table table-bordered table-hover'>

        <div class='row'>
            <div id='bulkOptionsContainer' class='col-xs-4'>
                <select class='form-control' name='bulk_options' id=''>
                    <option value='' hidden>Choose Options from here</option>
                    <option value='published'>Publish</option>
                    <option value='draft'>Draft</option>
                    <option value='delete'>Delete</option>
                    <option value='clone'>Clone</option>
                </select>
            </div>
            <div class='col-xs-4'>
                <input type='submit' name='submit' class='btn btn-success' value='Apply'>
                <a class='btn btn-primary' href='posts.php?source=add_post'>Add New</a>
            </div>
        </div>

        <br>

        <thead>
            <tr>
                <th><input type='checkbox' id='selectAllBoxes'></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>views</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //$user = currentUser();
                // WHERE post_user = '$user'
                $query = "SELECT * FROM posts INNER JOIN categories 
                            ON posts.post_category_id = categories.cat_id 
                            
                            ORDER BY post_id DESC";

                $select_posts = mysqli_query( $connection, $query );
                while( $row = mysqli_fetch_assoc( $select_posts ) ) {
                    $post_timestamp = strtotime( $row['post_date'] );
                    $post_time = date( 'Y-m-d h:i:s A', $post_timestamp );
                    
                    /**********************************************/
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$row['post_id']}";
                    $send_comment_query = mysqli_query( $connection, $query );

                    $rowComment = mysqli_fetch_array($send_comment_query);
                    if($rowComment){
                        $comment_id = $rowComment['comment_id'];
                    }
                    else{
                        $comment_id= "noComment";
                    }

                    

                    $count_comments = mysqli_num_rows($send_comment_query);
                    //<td>{$row['post_comment_count']}</td>
                    /**********************************************/
                    if(!empty($row['post_author'])){
                        $post_user = $row['post_author'];
                    }elseif (!empty($row['post_user'])) {
                        $post_user = $row['post_user'];

                    }

                    

                    echo
                    "
                    <tr>
                        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$row['post_id']}'></td>
                        <td>{$row['post_id']}</td>
                        <td>{$post_user}</td>
                        <td>{$row['post_title']}</td>
                        <td>{$row['cat_title']}</td>
                        <td>{$row['post_status']}</td>
                        <td><img src='../images/{$row['post_image']}' width='100' /></td>
                        <td>{$row['post_tags']}</td>
                        <td><a href='comments.php?source=post_comments&post_id={$row['post_id']}'>$count_comments</a></td>
                        <td>{$post_time}</td> 
                        <td><a class='confirm' href='posts.php?reset={$row['post_id']}'>{$row['post_views_count']}</a></td>
                        <td><a class='btn btn-primary' href='../post.php?post_id={$row['post_id']}'>View Post</a></td> 
                        <td><a class='btn btn-info' href='posts.php?source=edit_post&post_id={$row['post_id']}'>Edit</a></td> 
                        <td><a rel='{$row['post_id']}' class='delete_link btn btn-danger' >Delete</a></td>
                        </tr>
                        ";
                    }

                    //<td><a class='confirm' href='posts.php?delete={$row['post_id']}'>Delete</a></td> 

                    //<td><a rel='{$row['post_id']}' href='' class='delete_link' >Delete</a></td> 

                //     <td>
                //     <form action='{$_SERVER['REQUEST_URI']}' method='POST'>
                //         <input type='hidden' name='post_id' value='{$row['post_id']}'>
                //         <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                //     </form>
                // </td>
            ?>
        </tbody>


    </table>
</form>
<?php
if ( isset( $_POST['delete'] ) ) {
    $the_post_id = escape($_POST['post_id']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query( $connection, $query );
    if ( $delete_query ) {
        header( 'location:posts.php' );
    } else {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    }
}
?>
<?php
if ( isset( $_GET['delete'] ) ) {
    $the_post_id = escape($_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query( $connection, $query );
    if ( $delete_query ) {
        header( 'location:posts.php' );
    } else {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    }
}
?>
<?php
if ( isset( $_GET['reset'] ) ) {
    $the_post_id = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = ".mysqli_real_escape_string($connection,$the_post_id)." ";
    $reset_query = mysqli_query( $connection, $query );
    if ( $reset_query ) {
        header( 'location:posts.php' );
    } else {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    }
}
?>
