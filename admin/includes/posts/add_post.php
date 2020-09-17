<?php //echo $_SERVER['PHP_SELF'] . '<br>' . $_SERVER['REQUEST_URI'] ?>

<?php
    if ( isset( $_POST['create_post'] ) ) {
        $post_title        = escape($_POST['post_title']);
        //$post_author         = $_POST['post_author'];
        $post_user         = escape($_POST['post_user']);
        $post_category_id  = escape($_POST['post_category_id']);
        $post_status       = escape($_POST['post_status']);
        $post_image        = $_FILES['post_image']['name'];
        $post_image_temp   = $_FILES['post_image']['tmp_name'];    
        $post_tags         = escape($_POST['post_tags']);
        $post_content      = escape($_POST['post_content']);

        move_uploaded_file($post_image_temp, "../images/$post_image" );

        $query = "INSERT INTO posts(post_category_id, post_title, post_user,post_image,post_content,post_tags,post_status) "; 
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}','{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
        $create_post_query = mysqli_query($connection, $query);
        confirmQuery($create_post_query);

        // header("location:posts.php");
        $the_post_id= mysqli_insert_id($connection);
        echo "<p class='alert alert-success'>Post Created. <a href='../post.php?post_id={$the_post_id}'>View Post</a> OR <a href='posts.php'>Edit More Posts</a></p>";

    }
?>

<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='post_title'>Post Title</label>
        <input type='text' class='form-control' id='post_title' name='post_title'>
    </div>

    <div class='form-group'>
        <label for='post_category_id'>Post Category Id</label>
        <!-- <input type='text' class='form-control' id='post_category_id' name='post_category_id'> -->
        <select name='post_category_id' id='post_category_id' class="form-control">
            <option value="" hidden>Choose Category from here</option>
            <?php
                $query = 'SELECT * FROM categories ';
                $select_categories = mysqli_query( $connection, $query );
                confirmQuery( $select_categories );
                while( $row = mysqli_fetch_assoc( $select_categories ) ) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_user'>Post Author</label>
        <select name='post_user' id='post_user' class="form-control">
            <option value="" hidden>Choose Author from here</option>
            <?php
                $query = 'SELECT * FROM users ';
                $select_users = mysqli_query( $connection, $query );
                confirmQuery( $select_users );
                while( $row = mysqli_fetch_assoc( $select_users ) ) {
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    echo "<option value='{$user_name}'>{$user_name}</option>";
                }
            ?>
        </select>
    </div>

    <!-- <div class='form-group'>
        <label for='post_author'>Post Author</label>
        <input type='text' class='form-control' id='post_author' name='post_author'>
    </div> -->

    <div class='form-group'>
        <label for='post_status'>Post Status</label>
        <select class='form-control' name='post_status' id='post_status'>
            <option value='draft' hidden>Choose Status from here</option>
            <option value='published'>Publish</option>
            <option value='draft'>Draft</option>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_image'>Post Image</label>
        <input type='file' id='post_image' name='post_image'>
    </div>

    <div class='form-group'>
        <label for='post_tags'>Post Tags</label>
        <input type='text' class='form-control' id='post_tags' name='post_tags'>
    </div>

    <div class='form-group'>
        <label for='post_content'>Post Content</label>
        <textarea class='form-control ' name='post_content' id='post_content' cols='30' rows='10'></textarea>
    </div>

    <div class='form-group'>
        <input class='btn btn-primary' type='submit' name='create_post' value='Publish Post'>
    </div>

</form>