<?php ob_start() ?>

<?php require 'includes/db.php' ?>

<?php
if(isset($_GET['post_id'])){
    $the_post_id = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_all_posts_query = mysqli_query( $connection, $query );
    if ( $select_all_posts_query ) {
        $row = mysqli_fetch_array( $select_all_posts_query );
        $post_title = $row['post_title'];
        $pageTitle = $post_title;
    }
}else{
    header("location:index.php"); 
}
?>


<?php require 'includes/header.php' ?>

<!-- Navigation -->
<?php require 'includes/navigation.php' ?>

<?php
if ( isset( $_GET['post_id'] ) ){
    $the_post_id = $_GET['post_id'];
    $the_post_author = $_GET['author'];
}
?>


<!-- Page Content -->
<div class='container'>
    <div class='row'>
        <!-- Blog Post Content Column -->
        <div class='col-lg-8'>
            <?php
                $query = "SELECT * FROM posts WHERE post_user = '$the_post_author' ";
                $select_all_posts_query = mysqli_query( $connection, $query );
                if ( $select_all_posts_query ) {
                while ( $row = mysqli_fetch_assoc( $select_all_posts_query )) {

                    $post_id       = $row['post_id'];
                    $post_title        = $row['post_title'];
                    $post_author       = $row['post_author'];
                    $post_user       = $row['post_user'];
                    $post_category_id  = $row['post_category_id'];
                    $post_status       = $row['post_status'];
                    $post_image        = $row['post_image'];
                    $post_tags         = $row['post_tags'];
                    $post_content      = $row['post_content'];
                    
                    $post_timestamp = strtotime( $row['post_date'] );
                    $post_time = date( 'Y-m-d h:i:s A', $post_timestamp );
            ?>

                <!-- Blog Post -->
                <!-- Title -->
                <h1> 
                    <a href='post.php?post_id=<?php echo $post_id ?>' style='text-transform:uppercase;'><?php echo $post_title ?></a>
                </h1>
                <!-- Author -->
                <p class='lead'>
                    by <?php echo $post_user ?>
                </p>
                <hr>
                <!-- Date/Time -->
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_time ?></p>
                <hr>
                <!-- Preview Image -->
                <img class='img-responsive' src='./images/<?php echo $post_image ?>' alt=''>
                <hr>
                <!-- Post Content -->
                <p><?php echo $post_content ?></p>
                <hr>

            <?php
                    }
                    
                }
            ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php require 'includes/sidebar.php' ?>
    </div>
    <!-- /.row -->
    <hr>
    <?php require 'includes/footer.php' ?>
    <?php ob_end_flush() ?>