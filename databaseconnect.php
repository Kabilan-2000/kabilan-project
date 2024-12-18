<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Check the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"));
    
    // Get user details
    $name = $data->name;
    $email = $data->email;

    // Insert into the database
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'User added successfully']);
    } else {
        echo json_encode(['message' => 'Error: ' . $conn->error]);
    }
}

$conn->close();
?>
