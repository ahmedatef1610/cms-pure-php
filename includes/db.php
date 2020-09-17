<?php

$db['db_host'] = '127.0.0.1:3325';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

foreach ( $db as $key => $value ) {
    define( strtoupper( $key ), $value );
}

$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME );

if ( !$connection ) {
    die( 'Could not connect: ' . mysqli_connect_error() );
} else {
   // echo 'Connected successfully';
}

$query = 'SET NAMES utf8';
mysqli_query( $connection, $query );

?>