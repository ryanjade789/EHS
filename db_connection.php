<?php
$servername = "localhost";  // MySQL server address
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$database = "db_sm3101";  // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (if needed)
if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
}
?>
