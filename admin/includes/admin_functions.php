<?php
//0

function confirmQuery( $result ) {
    global $connection;
    if ( !$result ) {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    }
}
//1

function users_online() {

    if ( isset( $_GET['usersOnline'] ) ) {

        global $connection;
        if ( !$connection ) {

            session_start();
            require '../../includes/db.php';

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 3;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query( $connection, $query );
            $count = mysqli_num_rows( $send_query );

            if ( $count == NULL ) {
                mysqli_query( $connection, "INSERT INTO users_online(session , time) VALUES('$session', $time ) " );
            } else {
                mysqli_query( $connection, "UPDATE users_online SET time = $time WHERE session = '$session' " );
            }

            $users_online_query = mysqli_query( $connection, "SELECT * FROM users_online WHERE time > $time_out " );

            echo $count_user = mysqli_num_rows( $users_online_query );
        }
    }
}
users_online();
//2

function escape( $string ) {
    global $connection;
    return mysqli_escape_string( $connection, trim( $string ) );
}
//3

function recordCount( $table ) {
    global $connection;
    //$query = "SELECT * FROM $table WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_start,$per_page";
    $query = "SELECT * FROM $table";
    $select_query = mysqli_query( $connection, $query );
    $count_data = mysqli_num_rows( $select_query );
    return $count_data;
}
//4

function checkStatus( $table, $column, $value ) {
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$value' ";
    $select_query = mysqli_query( $connection, $query );
    $count_data = mysqli_num_rows( $select_query );
    return $count_data;
}
//5

function isAdmin( $username = '' ) {
    global $connection;
    if(isLoggedIn()){
        $query = "SELECT user_role FROM users WHERE user_name = '{$_SESSION['user_name']}' ";
        $result = mysqli_query( $connection, $query );
        confirmQuery( $result );
        $row = mysqli_fetch_array( $result );
        if ( $row['user_role'] == 'admin' ) {
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }
}
//6

function user_name_exists( $username = '' ) {
    global $connection;
    $query = "SELECT user_name FROM users WHERE user_name = '$username' ";
    $result = mysqli_query( $connection, $query );
    confirmQuery( $result );
    $count_data = mysqli_num_rows( $result );
    if ( $count_data > 0 ) {
        return true;
    } else {
        return false;
    }
}
//7

function user_email_exists( $email = '' ) {
    global $connection;
    $query = "SELECT user_name FROM users WHERE user_email = '$email' ";
    $result = mysqli_query( $connection, $query );
    confirmQuery( $result );
    $count_data = mysqli_num_rows( $result );
    if ( $count_data > 0 ) {
        return true;
    } else {
        return false;
    }
}
//8

function redirect( $location ) {
    return header( "Location:$location" );
    exit;
}
//9

function register_user( $username, $email, $password ) {
    global $connection;

    $username = mysqli_real_escape_string( $connection, $username );
    $email = mysqli_real_escape_string( $connection, $email );
    $password = mysqli_real_escape_string( $connection, $password );

    if ( user_name_exists( $username ) || user_email_exists( $email ) ) {
        $message = 'user exists';
    } else {
        if ( !empty( $username ) && !empty( $email ) && !empty( $password ) ) {

            $password = password_hash( $password, PASSWORD_DEFAULT );

            $query = 'INSERT INTO users(user_name , user_email , user_password , user_role) ';

            $query .= "VALUES('{$username}','{$email}','{$password}','subscriber') ";

            $register_user_query = mysqli_query( $connection, $query );
            confirmQuery( $register_user_query );
            $message = 'Your Registration has been submitted';

        } else {
            $message = 'Fields cannot be empty';
        }
    }
}
//10

function login_user( $username, $password ) {

    global $connection;

    $username = mysqli_real_escape_string( $connection, $username );
    $password = mysqli_real_escape_string( $connection, $password );

    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $select_user_query = mysqli_query( $connection, $query );

    if ( !$select_user_query ) {
        die( 'QUERY FAILED '.mysqli_error( $connection ) );
    } else {
        $row = mysqli_fetch_array( $select_user_query );
        if ( isset( $row ) ) {

            foreach ( $row as $key => $value ) {
                $$key = $value ;
            }

            //$password = crypt( $password, $user_password );

            $password_verify = password_verify( $password, $user_password );
            // boolean

            if ( $user_name != $username || !$password_verify || empty( $username ) || empty( $password ) ) {
                redirect( 'login.php' );
            } elseif ( $user_name == $username && $password_verify && !empty( $username ) && !empty( $password ) ) {
                foreach ( $row as $key => $value ) {
                    $_SESSION["$key"] = $value ;
                }
                redirect( '../../admin' );
            }
        } else {
            redirect( 'login.php' );
        }

    }
}
//11

function ifItIsMethod( $method = null ) {
    if ( $_SERVER['REQUEST_METHOD'] == strtoupper( $method ) ) {
        return true;
    }
    return false;
}
//12

function isLoggedIn() {
    if ( isset( $_SESSION['user_role'] ) ) {
        return true;
    }
    return false;
}
//13

function checkIfUserIsLoggedInAndRedirect( $redirectLocation = null ) {
    if ( isLoggedIn() ) {
        redirect( $redirectLocation );
    }
}
//14

function currentUser() {
    if ( isset( $_SESSION['user_name'] ) ) {
        return $_SESSION['user_name'];
    }
    return false;
}
//15

function imagePlaceholder( $image = '' ) {
    if ( !$image ) {
        return 'icon.png';
    }
    else {
        return $image;
    }
}
//
function count_records($result){
    return mysqli_num_rows($result);
}

//16
function get_all_user_posts(){
    return query("SELECT * FROM posts WHERE post_user='".$_SESSION['user_name']."'");
}
function get_all_posts_user_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE post_user='".$_SESSION['user_name']."'");

}
function get_all_user_categories(){
    return query("SELECT * FROM categories WHERE user_id=".loggedInUserId()."");
}

function get_all_user_published_posts(){
    return query("SELECT * FROM posts WHERE post_user='".$_SESSION['user_name']."' AND post_status='published'");
}
function get_all_user_draft_posts(){
    return query("SELECT * FROM posts WHERE post_user='".$_SESSION['user_name']."' AND post_status='draft'");
}


function get_all_user_approved_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE post_user='".$_SESSION['user_name']."' AND comment_status='approved'");
}


function get_all_user_unapproved_posts_comments(){
    return query("SELECT * FROM posts
    INNER JOIN comments ON posts.post_id = comments.comment_post_id
    WHERE post_user='".$_SESSION['user_name']."' AND comment_status='unapproved' ");
}
?>