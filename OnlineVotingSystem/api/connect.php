<?php
$host = "127.0.0.1";   // Use 127.0.0.1 instead of localhost
$user = "root";         // Your phpMyAdmin username
$password = "root";     // Your phpMyAdmin password
$database = "Voting";   // Your database name
$port = 8889;           // MAMP MySQL port

$connect = mysqli_connect($host, $user, $password, $database, $port);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>
