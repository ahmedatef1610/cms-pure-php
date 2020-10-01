<?php
if(isset($_GET['category_title'])){
    $pageTitle = $_GET['category_title'];
}else{
    header("location:index.php"); 
}
?>



<?php require "includes/db.php" ?>
<?php require "includes/header.php" ?>

<!-- Navigation -->
<?php require "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <!-- First Blog Post -->
            <?php 

                if(isset($_GET['category_id'])){
                    $post_category_id = $_GET['category_id'];
                }

                if(isset($_SESSION['user_name']) && isAdmin($_SESSION['user_name'])){
                    $query="SELECT * FROM posts WHERE post_category_id = {$post_category_id} ORDER BY post_date DESC";
                }else{
                    $query="SELECT * FROM posts WHERE post_category_id = {$post_category_id} AND post_status = 'published' ORDER BY post_date DESC";
                }

                $select_all_posts_query = mysqli_query($connection,$query);

                $count_data = mysqli_num_rows($select_all_posts_query);
                if($count_data==0){
                    echo "<h1>No Posts Available</h1>";
                }
                else{
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_timestamp=strtotime($row['post_date']);
                        $post_time=date("Y-m-d h:i:s A", $post_timestamp);
                        $post_content = substr($row['post_content'],0,100);
    
                        echo "
                        <h2>
                        <a href='post.php?post_id={$row['post_id']}' style='text-transform:uppercase;'>{$row['post_title']}</a>
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
                }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php require "includes/footer.php" ?>