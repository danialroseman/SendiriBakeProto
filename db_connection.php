<?php
$servername = "localhost"; // Replace with your server name if different
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "prototype"; // Replace with your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
