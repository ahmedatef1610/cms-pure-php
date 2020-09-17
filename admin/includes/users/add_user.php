<?php //echo $_SERVER['PHP_SELF'] . '<br>' . $_SERVER['REQUEST_URI'] ?>

<?php
if ( isset( $_POST['create_user'] ) ) {

    $user_email       = escape($_POST['user_email']);
    $user_name        = escape($_POST['user_name']);
    $user_password    = escape($_POST['user_password']);
    $user_role        = escape($_POST['user_role']);
    $user_firstname   = escape($_POST['user_firstname']);
    $user_lastname    = escape($_POST['user_lastname']);

    $user_password = password_hash( $user_password , PASSWORD_DEFAULT );

    $query = "INSERT INTO users( user_name, user_email, user_password , user_role , user_firstname , user_lastname) "; 
    $query .= "VALUES('{$user_name}','{$user_email}','{$user_password}','{$user_role}','{$user_firstname}','{$user_lastname}') "; 
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    header("location:users.php");
    
}
?>

<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='user_name'>Username</label>
        <input type='text' class='form-control' id='user_name' name='user_name'>
    </div>
    
    <div class='form-group'>
        <label for='user_email'>Email</label>
        <input type='email' class='form-control' id='user_email' name='user_email'>
    </div>

    <div class='form-group'>
        <label for='user_password'>Password</label>
        <input type='password' class='form-control' id='user_password' name='user_password'>
    </div>
    
    <div class='form-group'>
        <label for='user_role'>Role</label>
        <select name='user_role' id='user_role' class="form-control">
            <option value="" hidden>Choose Role from here</option>
            <option value='admin'>Admin</option>
            <option value='subscriber'>Subscriber</option>
        </select>
    </div>

    <div class='form-group'>
        <label for='user_firstname'>First Name</label>
        <input type='text' class='form-control' id='user_firstname' name='user_firstname'>
    </div>

    <div class='form-group'>
        <label for='user_lastname'>Last Name</label>
        <input type='text' class='form-control' id='user_lastname' name='user_lastname'>
    </div>

    <!-- <div class='form-group'>
        <label for='user_image'>Image</label>
        <input type='file' id='user_image' name='user_image'>
    </div> -->


    <div class='form-group'>
        <input class='btn btn-primary' type='submit' name='create_user' value='Create User'>
    </div>

</form>