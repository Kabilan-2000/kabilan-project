<?php
// Database configuration
$servername = "localhost";  // or your database host (e.g., "127.0.0.1" or "localhost")
$username = "root";         // your MySQL username (default: root)
$password = "";             // your MySQL password (default: empty for local development)
$dbname = "your_database";  // the name of your database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // If connection fails, show error
} 

//Uncomment this line to check if the connection is successful
 echo "Connected successfully"; 
?>
