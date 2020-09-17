<?php $pageTitle = 'My Data' ?>

<?php require "includes/admin_header.php" ?>






<div id="wrapper">

    <!-- Navigation -->
    <?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo (isset($_SESSION['user_name']))?$_SESSION['user_name']:"anonymous" ?></small>
                    </h1>
                    <!-- <h4>Dashboard</h4> -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php ;
                                        //$post_count = recordCount("posts");
                                        $post_count = count_records(get_all_user_posts());
                                        echo  "<div class='huge'>{$post_count}</div>"
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                        $comment_count = count_records(get_all_posts_user_comments());
                                        echo  "<div class='huge'>{$comment_count}</div>"
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                        $category_count = recordCount("categories");;
                                        echo  "<div class='huge'>{$category_count}</div>"
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <!-- /.row -->
            <?php 
                // $post_published_count = checkStatus( "posts", "post_status", "published" );
                // $post_draft_count = checkStatus( "posts", "post_status", "draft" );
                // $unapproved_comments_count = checkStatus( "comments", "comment_status", "unapproved" );
                $post_published_count = count_records(get_all_user_published_posts());
                $post_draft_count = count_records(get_all_user_draft_posts());
                $unapproved_comments_count = count_records(get_all_user_unapproved_posts_comments());
                $approved_comments_count = count_records(get_all_user_approved_posts_comments());
            ?>
            <div class="row">
                <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([

                        ['Data', 'Count'],

                        ['All Posts', <?php echo $post_count ?>],
                        ['Published Posts', <?php echo $post_published_count ?>],
                        ['Draft Posts', <?php echo $post_draft_count ?> ],

                        ['Comments', <?php echo $comment_count ?>],
                        ['approved Comments', <?php echo $approved_comments_count ?>],
                        ['Unapproved Comments', <?php echo $unapproved_comments_count ?>],

                        ['Categories', <?php echo $category_count ?>]
                    ]);
                    var options = {
                        chart: {
                            title: 'CMS Statistics',
                            subtitle: 'count all data we have',
                        }
                    };
                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px; padding:25px;"></div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php require "includes/admin_footer.php" ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready(function () {  
            // Enable pusher logging - don't include this in production
            //Pusher.logToConsole = true;
            var pusher = new Pusher('edd82eb19d14afc0ab92', {cluster: 'eu'});
            var notificationChannel = pusher.subscribe('notifications');
            notificationChannel.bind('new_user', function(data) {
                console.log(data);
                toastr.success(`${data.message} just register`);
                //alert(JSON.stringify(data));
            });
        });
    </script>
    <?php ob_end_flush() ?>