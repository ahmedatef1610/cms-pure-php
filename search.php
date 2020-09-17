
<?php

    if(!empty($_POST['search'])){
        $pageTitle = $_POST['search'];
    }else{
        redirect("index.php");
    }

?>

<?php require 'includes/db.php' ?>
<?php require 'includes/header.php' ?>

<!-- Navigation -->
<?php require 'includes/navigation.php' ?>

<!-- Page Content -->
<div class='container'>

    <div class='row'>

        <!-- Blog Entries Column -->
        <div class='col-md-8'>

            <?php

if ( isset( $_POST['submit'] ) ) {

    $search = $_POST['search'];
    if(isset($_SESSION['user_role'])&& $_SESSION['user_role']=='admin'){
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ORDER BY post_date DESC";
    }else{
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published' ORDER BY post_date DESC";
    }
    $search_query = mysqli_query( $connection, $query );

    if ( !$search_query ) {
        die( 'QUERY FAILED : '.mysqli_error( $connection ) );
    } else {
        $count = mysqli_num_rows( $search_query );
        // echo $search.'<br>';
        // echo $count.'<br>';
        if ( $count == 0 ) {
            echo '<h1>No Results</h1>';
        } else {

            ?>

            <h1 class='page-header'>
                <?php echo $_POST['search'] ?> Search
                <small>Posts</small>
            </h1>
            <!-- First Blog Post -->
            <?php
            while ( $row = mysqli_fetch_assoc( $search_query ) ) {
                $post_timestamp = strtotime( $row['post_date'] );
                $post_time = date( 'Y-m-d h:i:s A', $post_timestamp );
                $post_content = substr($row['post_content'],0,100);
                echo "
                    <h2>
                    <a href='#' style='text-transform:uppercase;'>{$row['post_title']}</a>
                    <p class='lead'>by <a href='#'>{$row['post_user']}</a></p>
                    </h2>
                    <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_time}</p>
                    <hr>
                    <img class='img-responsive' src='images/{$row['post_image']}' alt='{$row['post_title']}'>
                    <hr>
                    <p>{$post_content}</p>
                    <a class='btn btn-primary' href='post.php?post_id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                    <hr>
                ";
            }
            ?>

            <!-- Pager -->
            <ul class='pager'>
                <li class='previous'>
                    <a href='#'>&larr;
                        Older</a>
                </li>
                <li class='next'>
                    <a href='#'>Newer &rarr;
                    </a>
                </li>
            </ul>

            <?php
        }
    }
} else {
    header( 'location:index.php' );
}
?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php require 'includes/footer.php' ?>