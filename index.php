<?php $pageTitle = 'Home' ?>

<?php require "includes/db.php" ?>
<?php require "includes/header.php" ?>

<!-- Navigation -->
<?php require "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">
    <?php echo "{$_SERVER['DOCUMENT_ROOT']}/index.php" ?>
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
<!-- 
            <h1 class="page-header">
                Home Page
                <small>Posts</small>
            </h1> -->

            <!-- First Blog Post -->
            <?php 

                $per_page = 3;

                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else {
                    $page = 1;
                }
                if($page==""||$page == 1){
                    $page_start = 0;
                }else{
                    $page_start = ($page * $per_page) - $per_page;
                }

                if(isset($_SESSION['user_role'])&& $_SESSION['user_role']=='admin'){
                    $query="SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_start,$per_page";
                }else{
                    $query="SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_start,$per_page";
                }
                

                // get posts
                $select_all_posts_query = mysqli_query($connection,$query);
                $count_data = mysqli_num_rows($select_all_posts_query);
                if($count_data==0){
                    echo "<h1>No Posts Available</h1>";
                }
                else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                        $post_timestamp=strtotime($row['post_date']);
                        $post_time=date("Y-m-d h:i:s A", $post_timestamp);
                        $post_content = substr($row['post_content'],0,100);
                        $post_status = $row['post_status'];
    
                       // if($post_status != "published"){
                            //echo "<h1>Post under draft mode</h1><hr>";
                        //}else {
                            echo "
                            <h2>
                            <a href='post.php?post_id={$row['post_id']}' style='text-transform:uppercase;'>{$row['post_title']}</a>
                            <p class='lead'>by <a href='.\author_posts.php?author={$row['post_user']}&post_id={$row['post_id']}'>{$row['post_user']}</a></p>
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
                       // }
                    }
                }
            ?>

            <!-- Pager -->
            <!-- <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->
            <ul class="pager">
                <?php
                    if(isset($_SESSION['user_role'])&& $_SESSION['user_role']=='admin'){
                        $query = "SELECT * FROM posts ";
                    }else{
                        $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    }
                    $post_query_count = mysqli_query($connection,$query);
                    $count = mysqli_num_rows($post_query_count);
                    $count = ceil($count/$per_page);
                    for ($i=1; $i <= $count; $i++) { 
                        if($i == $page ){
                            echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
                        }else{
                            echo "<li><a href='index.php?page=$i'>$i</a></li>";
                        }
                    }
                ?>
            </ul>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php require "includes/footer.php" ?>