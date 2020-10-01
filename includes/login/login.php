<?php session_start() ?>

<?php require '../db.php' ?>
<?php require "../../admin/includes/admin_functions.php" ?>


<?php
if(ifItIsMethod('post')){
    if ( isset( $_POST['login'] ) ) {
        $username   = trim( $_POST['username'] );
        $password   = trim( $_POST['password'] );
        login_user($username, $password);
    }
}
else{
    redirect("../../index.php");
}

?>