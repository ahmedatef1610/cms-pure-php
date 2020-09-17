<?php $pageTitle = 'posts' ?>

<?php require 'includes/admin_header.php' ?>

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

                            case 'add_post':
                                include 'includes/posts/add_post.php';
                            break;

                            case 'edit_post':
                                include 'includes/posts/edit_post.php';
                            break;

                            default:
                                include 'includes/posts/view_all_post.php';
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