<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <!-- <li><a href="#"><i class="fa fa-users"></i> Users Online: <?php //echo users_online()?></a></li> -->
        <li><a href="#"><i class="fa fa-users"></i> Users Online: <span class="usersOnline"></span></a></li>
        
        <li><a href="../"><i class="fa fa-home"></i> Home Site</a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
            <?php echo (isset($_SESSION['user_name']))?$_SESSION['user_name']:"anonymous" ?>
            <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/login/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>

    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?php echo ($pageTitle == 'Dashboard')?'active':''; ?>">
                <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="<?php echo ($pageTitle == 'My Data')?'active':''; ?>">
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> My Data</a>
            </li>
            <li class="<?php echo ($pageTitle == 'posts')?'active':''; ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown">
                    <i class="fa fa-fw fa-envelope"></i> Posts <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View All Posts</a>
                    </li>
                    <li>
                        <a href="./posts.php?source=add_post">Add Posts</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($pageTitle == 'categories')?'active':''; ?>">
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li>
            <li class="<?php echo ($pageTitle == 'comments')?'active':''; ?>">
                <a href="comments.php"><i class="fa fa-fw fa-comments"></i> Comments</a>
            </li>
            <li class="<?php echo ($pageTitle == 'users')?'active':''; ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown">
                <i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="./users.php">View All users</a>
                    </li>
                    <li>
                        <a href="./users.php?source=add_user">Add users</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($pageTitle == 'profile')?'active':''; ?>">
                <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>