<?php session_start() ?>
<?php require "./admin/includes/admin_functions.php" ?>
<?php require "./includes/likes_functions.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ahmed m.atef">

    <title><?php echo ( isset( $pageTitle ) ) ? ucfirst( $pageTitle ) : '' ; ?> - CMS Blog</title>

    <link rel="shortcut icon" href="images/icon2.png" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="/12-cms/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/12-cms/css/blog-home.css" rel="stylesheet">
    <link href="/12-cms/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>