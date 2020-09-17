<?php
    if ( isset( $_GET['post_id'] ) ) {
        $the_post_id =   $_GET['post_id'];
    }
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id  ";
    $select_posts_by_id = mysqli_query( $connection, $query );
    if ( $select_posts_by_id ) {
        $row = mysqli_fetch_array( $select_posts_by_id );
        $post_id            = $row['post_id'];
        $post_user        = $row['post_user'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date'];
    }
?>


<?php
    if(isset($_POST['update_post'])){
        $post_title        = escape($_POST['post_title']);
        $post_user         = escape($_POST['post_user']);
        $post_category_id  = escape($_POST['post_category_id']);
        $post_status       = escape($_POST['post_status']);
        $post_image        = $_FILES['post_image']['name'];
        $post_image_temp   = $_FILES['post_image']['tmp_name'];    
        $post_tags         = escape($_POST['post_tags']);
        $post_content      = escape($_POST['post_content']);
    
        move_uploaded_file($post_image_temp, "../images/$post_image" );

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connection,$query);
            if($select_image) {
                $row = mysqli_fetch_array( $select_image );
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .="post_title  = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_user = '{$post_user}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags   = '{$post_tags}', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}', ";
        $query .="post_date = now() ";
        $query .= " WHERE post_id = {$the_post_id} ";
       
        $update_post = mysqli_query($connection,$query);
        confirmQuery($update_post);
        // header("location:posts.php"); 
        echo "<p class='alert alert-success'>Post Update. <a href='../post.php?post_id={$the_post_id}'>View Post</a> OR <a href='posts.php'>Edit More Posts</a></p>";
    }
?>


<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='post_title'>Post Title</label>
        <input type='text' class='form-control' id='post_title' name='post_title' value="<?php echo $post_title?>">
    </div>

    <div class='form-group'>
        <label for='post_category_id'>Post Category Id</label>
        <!-- <input type = 'text' class = 'form-control' id = 'post_category_id' name = 'post_category_id' value = "<?php //echo $post_category_id?>"> -->
        <select name='post_category_id' id='post_category_id' class="form-control">
            <option value="" hidden>Choose Category from here</option>
            <?php
                $query = 'SELECT * FROM categories ';
                $select_categories = mysqli_query( $connection, $query );
                confirmQuery( $select_categories );
                while( $row = mysqli_fetch_assoc( $select_categories ) ) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    if ( $cat_id == $post_category_id ) {
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_user'>Post Author</label>
        <select name='post_user' id='post_user' class="form-control">
            <option value="" hidden>Choose User from here</option>
            <?php
                $query = 'SELECT * FROM users ';
                $select_users = mysqli_query( $connection, $query );
                confirmQuery( $select_users );
                while( $row = mysqli_fetch_assoc( $select_users ) ) {
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    if ( $user_name == $post_user ) {
                        echo "<option selected value='{$user_name}'>{$user_name}</option>";
                    } else {
                        echo "<option value='{$user_name}'>{$user_name}</option>";
                    }
                }
            ?>
        </select>
    </div>

    <!-- <div class='form-group'>
        <label for='post_author'>Post Author</label>
        <input type='text' class='form-control' id='post_author' name='post_author' value="<?php //echo $post_author?>">
    </div> -->

    <!-- <div class='form-group'>
        <label for='post_status'>Post Status</label>
        <input type='text' class='form-control' id='post_status' name='post_status' value="<?php //echo $post_status?>">
    </div> -->

    <div class='form-group'>
        <label for='post_status'>Post Status</label>
        <select name='post_status' id='post_status' class="form-control">
            <option value="" hidden>Choose Status from here</option>
            <option selected value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php 
                if ( $post_status == "published" ) {
                    echo "<option value='draft'>Draft</option>";
                } else {
                    echo "<option value='published'>Published</option>";
                }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_image'>Post Image</label>
        <div>
            <input type='file' id='post_image' name='post_image' class="">
        </div>
        <div>
            <img src="../images/<?php echo $post_image?>" width='400' alt=''>
        </div>
    </div>

    <div class='form-group'>
        <label for='post_tags'>Post Tags</label>
        <input type='text' class='form-control' id='post_tags' name='post_tags' value="<?php echo $post_tags?>">
    </div>

    <div class='form-group'>
        <label for='post_content'>Post Content</label>
        <textarea class='form-control ' name='post_content' id='post_content' cols='30'
            rows='10'><?php echo $post_content?></textarea>
    </div>

    <div class='form-group'>
        <input class='btn btn-primary' type='submit' name='update_post' value='Update Post'>
    </div>

</form>