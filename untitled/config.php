<?php
$host = "localhost";
$username = "root";
$passwd = "COSC4343";
$dbname = "userAccount";
$port = 22;

// Create connection
echo "0";
$db= mysqli_connect($host,$username,$passwd,$dbname) or die('Error connecting to MySQL server.');
echo "5";
// Check connection


$query = "SELECT * FROM UserAccounts";

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

while ($row = mysqli_fetch_array($result)) {
    echo $row['userId'] . ' ' . $row['username'] . ': ' . $row['password'] . ' ' . $row['clearance'] .'<br />';
}

echo "Connected";
