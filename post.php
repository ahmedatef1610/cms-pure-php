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


        $query = "UPDATE posts SET post_views_count = post_views_count + 1 "; 
        $query .= "WHERE post_id = $the_post_id "; 
        $send_query = mysqli_query($connection, $query);
        if(!$send_query){
            die("QUERY FAILED ".mysqli_error($connection));
        }


    }
}else{
    header("location:index.php"); 
}
?>


<?php require 'includes/header.php' ?>

<!-- Navigation -->
<?php require 'includes/navigation.php' ?>

<?php

//echo loggedInUserId();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if(isset($_POST['liked'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    //1 =  FETCHING THE RIGHT POST
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];

    // 2 = UPDATE - INCREMENTING WITH LIKES
    mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");

    // 3 = CREATE LIKES FOR POST
    mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();
}
if(isset($_POST['unliked'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    //1 =  FETCHING THE RIGHT POST
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];

    //2 = UPDATE WITH DECREMENTING WITH LIKES
    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");
    
    //3 = DELETE LIKES
    mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");
    exit();
}
?>

<?php // GET DATA FOR POST
if ( isset( $_GET['post_id'] ) ){
    $the_post_id = $_GET['post_id'];
}

if(isset($_SESSION['user_role'])&& $_SESSION['user_role']=='admin'){
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
}else{
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
}
$select_all_posts_query = mysqli_query( $connection, $query );
$count_data = mysqli_num_rows($select_all_posts_query);
if($count_data==0){
    header("location:index.php"); 
}


if ( $select_all_posts_query ) {

    $row = mysqli_fetch_array( $select_all_posts_query );

    $post_title        = $row['post_title'];
    $post_user       = $row['post_user'];
    $post_category_id  = $row['post_category_id'];
    $post_status       = $row['post_status'];
    $post_image        = $row['post_image'];
    $post_tags         = $row['post_tags'];
    $post_content      = $row['post_content'];

    $post_timestamp = strtotime( $row['post_date'] );
    $post_time = date( 'Y-m-d h:i:s A', $post_timestamp );
}
?>

<!-- Page Content -->
<div class='container'>
    <div class='row'>
        <!-- Blog Post Content Column -->
        <div class='col-lg-8'>
            <!-- Blog Post -->
            <!-- Title -->
            <h1><?php echo $post_title ?></h1>
            <!-- Author -->
            <p class='lead'>
                by <?php echo $post_user ?>
            </p>
            <hr>
            <!-- Date/Time -->
            <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_time ?></p>
            <hr>
            <!-- Preview Image -->
            <img class='img-responsive' src='images/<?php echo $post_image ?>' alt=''>
            <hr>
            <!-- Post Content -->
            <p><?php echo $post_content ?></p>
            <hr>




            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->
            <?php if(isLoggedIn()): ?>
                <div class="row">
                    <p class="pull-right">
                        <?php $userLiked = userLikedThisPost($the_post_id); ?>
                        <a class="<?php echo $userLiked ? 'unlike' : 'like'; ?>" href="">
                            <span class="glyphicon glyphicon-thumbs-<?php echo $userLiked ? 'down' : 'up'; ?>"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="<?php echo $userLiked ? 'I liked this before' : 'Want to like it?'; ?>"
                            ></span>
                            <?php echo $userLiked ? ' Unlike' : ' Like'; ?>
                        </a>
                    </p>
                </div>
            <?php else: ?>
                <div class="row">
                    <p class="pull-right login-to-post">You need to <a href="login.php">Login</a> to like </p>
                </div>
            <?php endif ?>


            <div class="row">
                <p class="pull-right likes">Like: <?php getPostLikes($the_post_id); ?></p>
            </div>

            <div class="clearfix"></div>
            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->
            <!-- LIKES SYSTEM -->





            <!-- Blog Comments -->
            <hr>

            <?php
                if ( isset( $_POST['create_comment'] ) ) {

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author)&&!empty($comment_email)&&!empty($comment_content)){

                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email,comment_content) "; 
                        $query .= "VALUES({$the_post_id},'{$comment_author}','{$comment_email}','{$comment_content}') "; 
                        $create_comment_query = mysqli_query($connection, $query);
                        if($create_comment_query){
    
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 "; 
                            $query .= "WHERE post_id = $the_post_id "; 
                            $update_comment_count = mysqli_query($connection, $query);
                            if($update_comment_count){
                                header("location:{$_SERVER['REQUEST_URI']}");
                            }else{
                                die("QUERY FAILED ".mysqli_error($connection));
                            }
                            
                            // header("location:{$_SERVER['REQUEST_URI']}");
                        }
                        else{
                            die("QUERY FAILED ".mysqli_error($connection));
                        }
                        
                    }
                    else{
                        echo "<script>alert('field cannot be empty')</script>";
                    }

                }
            ?>

            <!-- Comments Form -->
            <div class='well'>
                <h4>Leave a Comment:</h4>
                <form action='<?php echo $_SERVER['REQUEST_URI']?>' method='post'>

                    <div class='form-group'>
                        <label for='comment_author'>Author</label>
                        <input type='text' class='form-control' id='comment_author' name='comment_author'>
                    </div>
                    <div class='form-group'>
                        <label for='comment_email'>Email</label>
                        <input type='email' class='form-control' id='comment_email' name='comment_email'>
                    </div>

                    <div class='form-group'>
                        <label for='comment_content'>Content</label>
                        <textarea class='form-control' rows='3' id='comment_content' name='comment_content'></textarea>
                    </div>
                    <button type='submit' class='btn btn-primary' name='create_comment'>Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php 
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query) {
                    die('Query Failed' . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_array($select_comment_query)) {
                    $comment_timestamp = strtotime( $row['comment_date'] );
                    $comment_time = date( 'Y-m-d h:i:s A', $comment_timestamp );
                    $comment_content= $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    
            ?>
                <!-- Comment -->
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'><?php echo $comment_author ?>
                            <small><?php echo $comment_time ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>

            <?php
                } 
            ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php require 'includes/sidebar.php' ?>
    </div>
    <!-- /.row -->
    <hr>
    <?php require 'includes/footer.php' ?>
    <script>

        console.log('<?php echo $_SERVER['REQUEST_URI']?>');

        $(document).ready(function () {

            $("[data-toggle='tooltip']").tooltip();

            let post_id = <?php echo $the_post_id ?>;
            let user_id = <?php echo loggedInUserId() ?>;

            let dataLike = {post_id,user_id,liked : 1};
            let dataUnlike = {post_id,user_id,unliked : 1};

            $('.like').click(function(e){
                e.preventDefault();
                // LIKING
                $.ajax({
                    type: "post",
                    url: "<?php echo $_SERVER['REQUEST_URI']?>",
                    data: dataLike,
                    success: function (res) {
                        console.log("success: ",res);
                        location.reload();
                    },
                    error: function (res) {
                        console.log("error: ",res);
                    }
                });
            });
            $('.unlike').click(function(e){
                e.preventDefault();
                // UNLIKING
                $.ajax({
                    type: "post",
                    url: "<?php echo $_SERVER['REQUEST_URI']?>",
                    data: dataUnlike,
                    success: function (res) {
                        console.log("success: ",res);
                        location.reload();
                    },
                    error: function (res) {
                        console.log("error: ",res);
                    }
                });
            });
        });
    </script>
    <?php ob_end_flush() ?>