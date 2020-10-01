<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index">CMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php 
                    $query="SELECT * FROM categories LIMIT 9";
                    $select_all_categories_query = mysqli_query($connection,$query);
                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        if($row['cat_title']==$pageTitle){
                            echo "
                              <li class='active'>
                                  <a href='category.php?category_id={$row['cat_id']}&category_title={$row['cat_title']}'>{$row['cat_title']}</a>
                              </li>
                              ";
                        }
                        else{
                            echo "
                              <li>
                                  <a href='category.php?category_id={$row['cat_id']}&category_title={$row['cat_title']}'>{$row['cat_title']}</a>
                              </li>
                              ";
                        }
                    }
                ?>

                <?php if(isLoggedIn()): ?>                    
                    <li>
                        <a href='admin'>Admin</a>
                    </li>
                    <li>
                        <a href="./includes/login/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="<?php echo ($pageTitle == 'Login')?'active':''; ?>">
                        <a href='login.php'>Login</a>
                    </li>
                <?php endif; ?>
                    
                <li class="<?php echo ($pageTitle == 'Registration')?'active':''; ?>">
                    <a href='registration'>Registration</a>
                </li>
                <li class="<?php echo ($pageTitle == 'Contact')?'active':''; ?>">
                    <a href='contact'>Contact</a>
                </li>
                <?php
                    if ( isset( $_SESSION['user_role'] ) ) {
                        if(isset($_GET['post_id'])){
                            $the_post_id = $_GET['post_id'];
                            echo "
                                <li>
                                    <a href='./admin/posts.php?source=edit_post&post_id={$the_post_id}'>Edit Post</a>
                                </li>
                            ";
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>