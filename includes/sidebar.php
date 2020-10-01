<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Blog login Well -->
    <div class="well">
        <?php if(isset($_SESSION['user_role'])): ?>
            <h4>Logged in as <?php echo $_SESSION['user_name'] ?></h4>
            <a href="includes/login/logout.php" class="btn btn-primary">Logout</a>
        <?php else: ?>
            <h4>Login</h4>
            <form action="includes/login/login.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="enter username">
                </div>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" placeholder="enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">
                            Login
                        </button> 
                    </span>
                </div>
                <div class="form-group">
                    <a href="forgot.php?forgot=<?php echo uniqid() ?>">Forgot Password</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                        $query="SELECT * FROM categories";
                        $select_categories_sidebar= mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            echo "<li><a href='category.php?category_id={$row['cat_id']}&category_title={$row['cat_title']}'>{$row['cat_title']}</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php require 'includes/widget.php' ?>
</div>