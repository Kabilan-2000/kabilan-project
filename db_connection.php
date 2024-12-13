<?php
// Database credentials
$servername = "localhost";  // Replace with your server name if not localhost
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password
$database = "ecommerce_db"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!";
}
?>


