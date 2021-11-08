<?php
$host = "localhost";
$username = "root";
$passwd = "COSC4343";
$dbname = "userAccount";
global $connection;

if ( isset( $connection ) )
    return;

$connection =mysqli_connect($host,$username,$passwd,$dbname) or die('Error connecting to MySQL server.');

if (mysqli_connect_errno()) {
    die(sprintf("Connect failed: %s\n", mysqli_connect_error()));
}
