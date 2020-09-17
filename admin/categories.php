<?php $pageTitle = 'categories' ?>
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

                    <div class='col-xs-6'>
                        <!-- add category -->
                        <?php insert_categories() ?>
                        <!-- form to add category -->
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method='post'>
                            <div class='form-group'>
                                <label for='cat-title'>Add Category</label>
                                <input type='text' class='form-control' name='cat_title'>
                            </div>
                            <div class='form-group'>
                                <input class='btn btn-primary' type='submit' name='submit' value='Add Category'>
                            </div>
                        </form>

                        <!-- form to edit category -->
                        <?php 
                            if(isset($_GET['edit'])){
                                require 'includes/categories/update_categories.php';
                            }
                        ?>
                    </div>
                    <!-- to show categories -->
                    <div class='col-xs-6'>
                        <table class='table table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- get all categories -->
                                <?php findAllCategories() ?>
                                <!-- delete category -->
                                <?php deleteCategories() ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php require 'includes/admin_footer.php' ?>
    <?php ob_end_flush() ?>