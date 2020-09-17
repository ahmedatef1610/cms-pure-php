<?php $pageTitle = 'Home' ?>

<?php require "includes/db.php" ?>
<?php require "includes/header.php" ?>

<!-- Navigation -->
<?php require "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Home Page
                <small>Posts</small>
            </h1>

            <!-- First Blog Post -->
            <?php 
                $query="SELECT * FROM posts ORDER BY post_date DESC";
                $select_all_posts_query = mysqli_query($connection,$query);
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                    $post_timestamp=strtotime($row['post_date']);
                    $post_time=date("Y-m-d h:i:s A", $post_timestamp);
                    $post_content = substr($row['post_content'],0,100);
                    $post_status = $row['post_status'];

                    if($post_status != "published"){
                        echo "<h1>Post under draft mode</h1><hr>";
                    }else {
                        echo "
                        <h2>
                        <a href='post.php?post_id={$row['post_id']}' style='text-transform:uppercase;'>{$row['post_title']}</a>
                        <p class='lead'>by <a href='.\author_posts.php?author={$row['post_author']}&post_id={$row['post_id']}'>{$row['post_author']}</a></p>
                        </h2>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_time}</p>
                        <hr>
                        <a href='post.php?post_id={$row['post_id']}'>
                            <img class='img-responsive' src='images/{$row['post_image']}' alt='{$row['post_title']}'>
                        </a>
                        <hr>
                        <p>{$post_content}</p>
                        <a class='btn btn-primary' href='post.php?post_id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                        <hr>
                        ";
                    }
                }
            ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php require "includes/footer.php" ?>