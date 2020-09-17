<?php
    if ( isset( $_GET['edit_user'] ) ) {
        $the_user_id =  escape( $_GET['edit_user']);
    }else{
        header("location:users.php");
    }

    $query = "SELECT * FROM users WHERE user_id = $the_user_id  ";
    $select_posts_by_id = mysqli_query( $connection, $query );
    if ( $select_posts_by_id ) {
        $row = mysqli_fetch_array( $select_posts_by_id );
        $user_id             = $row['user_id'];
        $user_name           = $row['user_name'];
        $user_email          = $row['user_email'];
        $user_password       = $row['user_password'];
        $user_firstname      = $row['user_firstname'];
        $user_lastname       = $row['user_lastname'];
        $user_role           = $row['user_role'];
        $user_image          = $row['user_image'];
        $user_randSalt       = $row['user_randSalt'];
        $user_date           = $row['user_date'];

    }
?>
<?php
    if(isset($_POST['update_user'])){
        $user_name        = escape($_POST['user_name']);
        $user_email         = escape($_POST['user_email']);
        $user_password  = escape($_POST['user_password']);
        $user_role       = escape($_POST['user_role']);
        $user_firstname         = escape($_POST['user_firstname']);
        $user_lastname      = escape($_POST['user_lastname']);
        
        //$hashed_password = crypt($user_password , $user_randSalt);
        //$hashed_password = password_hash( $user_password , PASSWORD_DEFAULT );
        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id =  $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);
            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];
  
            if($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
            }else{
                $hashed_password =  $db_user_password;
            }
            $query = "UPDATE users SET ";
            $query .="user_name  = '{$user_name}', ";
            $query .="user_email = '{$user_email}', ";
            $query .="user_password = '{$hashed_password}', ";
            $query .="user_role = '{$user_role}', ";
            $query .="user_firstname   = '{$user_firstname}', ";
            $query .="user_lastname = '{$user_lastname}', ";
            $query .="user_date = now() ";
            $query .= " WHERE user_id = {$the_user_id} ";
           
            $update_user = mysqli_query($connection,$query);
            confirmQuery($update_user);
            //header("location:users.php");
            echo "User Updated" . " <a href='users.php'>View Users?</a>";

        }else{
            header("location:users.php");
        }


    }
?>

<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='user_name'>Username</label>
        <input type='text' class='form-control' id='user_name' name='user_name' value="<?php echo $user_name?>">
    </div>
    
    <div class='form-group'>
        <label for='user_email'>Email</label>
        <input type='email' class='form-control' id='user_email' name='user_email' value="<?php echo $user_email?>">
    </div>

    <div class='form-group'>
        <label for='user_password'>Password</label>
        <input type='password' class='form-control' id='user_password' name='user_password' value="<?php //echo $user_password?>">
    </div>
    
    <div class='form-group'>
        <label for='user_role'>Role</label>
        <select name='user_role' id='user_role' class="form-control">
            <option value="" hidden>Choose Role from here</option>
            <option value='admin' <?php echo ($user_role == 'admin')?'selected':''?> >Admin</option>
            <option value='subscriber' <?php echo ($user_role == 'subscriber')?'selected':''?> >Subscriber</option>
        </select>
    </div>

    <div class='form-group'>
        <label for='user_firstname'>First Name</label>
        <input type='text' class='form-control' id='user_firstname' name='user_firstname' value="<?php echo $user_firstname?>">
    </div>

    <div class='form-group'>
        <label for='user_lastname'>Last Name</label>
        <input type='text' class='form-control' id='user_lastname' name='user_lastname' value="<?php echo $user_lastname?>">
    </div>


    <div class='form-group'>
        <input class='btn btn-primary' type='submit' name='update_user' value='Update User'>
    </div>

</form>