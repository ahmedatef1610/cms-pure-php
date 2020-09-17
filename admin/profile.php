<?php $pageTitle = 'profile' ?>

<?php require 'includes/admin_header.php' ?>

<?php
if ( isset( $_SESSION['user_name'] ) ) {
    $username = $_SESSION['user_name'];
    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $select_user_profile_query = mysqli_query( $connection, $query );
    if ( !$select_user_profile_query ) {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    } else {
        $row = mysqli_fetch_array( $select_user_profile_query );
        foreach ( $row as $key => $value ) {
            $$key = $value ;
        }
    }
}
?>

<?php
if ( isset( $_POST['update_profile'] ) ) {
    $user_name_data        = escape($_POST['user_name']);
    $user_email_data          = escape($_POST['user_email']);
    $user_password_data   = escape($_POST['user_password']);
    //$user_role_data        = $_POST['user_role'];
    $user_firstname_data          = escape($_POST['user_firstname']);
    $user_lastname_data       = escape($_POST['user_lastname']);

    if(!empty($user_password_data)){
        $query_password = "SELECT user_password FROM users WHERE user_id =  $user_id";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password_data) {
            $hashed_password = password_hash($user_password_data, PASSWORD_DEFAULT);
        }else{
            $hashed_password =  $db_user_password;
        }
        $query = "UPDATE users SET ";
        $query .="user_name  = '{$user_name}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$hashed_password}', ";
        // $query .="user_role = '{$user_role}', ";
        $query .="user_firstname   = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_date = now() ";
        $query .= " WHERE user_name = '{$username}' ";
       
        $_SESSION['user_name'] = $user_name_data ;

        $update_user_profile = mysqli_query( $connection, $query );
        confirmQuery( $update_user_profile );
        header( 'location:users.php' );
        //echo "User Updated" . " <a href='users.php'>View Users?</a>";

    }




}
?>

<div id='wrapper'>

    <!-- Navigation -->
    <?php require 'includes/admin_navigation.php' ?>

    <div id='page-wrapper'>
        <div class='container-fluid'>
            <!-- Page Heading -->
            <div class='row'>
                <div class='col-lg-12'>

                    <h1 class='page-header'>
                        Welcome to admin
                        <small><?php echo (isset($_SESSION['user_name']))?$_SESSION['user_name']:"anonymous" ?></small>
                    </h1>

                    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post' enctype='multipart/form-data'>

                        <div class='form-group'>
                            <label for='user_name'>Username</label>
                            <input type='text' class='form-control' id='user_name' name='user_name'
                                value="<?php echo $user_name?>">
                        </div>

                        <div class='form-group'>
                            <label for='user_email'>Email</label>
                            <input type='email' class='form-control' id='user_email' name='user_email'
                                value="<?php echo $user_email?>">
                        </div>

                        <div class='form-group'>
                            <label for='user_password'>Password</label>
                            <input type='password' class='form-control' id='user_password' name='user_password'
                                value="<?php //echo $user_password?>">
                        </div>

                        <!-- <div class='form-group'>
                            <label for='user_role'>Role</label>
                            <select name='user_role' id='user_role' class='form-control'>
                                <option value='' hidden>Choose Role from here</option>
                                <option value='admin' <?php //echo ( $user_role == 'admin' )?'selected':''?>>Admin
                                </option>
                                <option value='subscriber' <?php //echo ( $user_role == 'subscriber' )?'selected':''?>>
                                    Subscriber</option>
                            </select>
                        </div> -->

                        <div class='form-group'>
                            <label for='user_firstname'>First Name</label>
                            <input type='text' class='form-control' id='user_firstname' name='user_firstname'
                                value="<?php echo $user_firstname?>">
                        </div>

                        <div class='form-group'>
                            <label for='user_lastname'>Last Name</label>
                            <input type='text' class='form-control' id='user_lastname' name='user_lastname'
                                value="<?php echo $user_lastname?>">
                        </div>

                        <div class='form-group'>
                            <input class='btn btn-primary' type='submit' name='update_profile' value='Update Profile'>
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php require 'includes/admin_footer.php' ?>
    <?php ob_end_flush() ?>