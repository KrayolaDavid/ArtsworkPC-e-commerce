<?php
$host = "127.0.0.1";  // Try using 127.0.0.1 instead of localhost
$username = "root";
$password = "";  // Ensure this is correct for your MySQL user
$database = "artworkdb";

// Creating Database connection
$con = mysqli_connect($host, $username, $password, $database, 3307);

// Check database connection
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
