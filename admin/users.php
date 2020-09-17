<?php $pageTitle = 'users' ?>

<?php require 'includes/admin_header.php' ?>

<?php
    if ( !isAdmin( $_SESSION['user_name'] ) ) {
        header( 'location:./index.php' );
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

                    <?php
                    
                        if ( isset( $_GET['source'] ) ) {
                            $source = $_GET['source'];
                        }
                        else{
                            $source = "";
                        }

                        switch ( $source ) {

                            case 'add_user':
                                include 'includes/users/add_user.php';
                            break;

                            case 'edit_user':
                                include 'includes/users/edit_user.php';
                            break;

                            default:
                                include 'includes/users/view_all_user.php';
                            break;
                        }

                    ?>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php require 'includes/admin_footer.php' ?>
    <?php ob_end_flush() ?>