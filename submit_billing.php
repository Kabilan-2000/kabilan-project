<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'billing_system';

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $amount = $conn->real_escape_string($_POST['amount']);

    // Insert data into the database
    $sql = "INSERT INTO billing_info (customer_name, email, phone, address, amount) 
            VALUES ('$customer_name', '$email', '$phone', '$address', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Billing information saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
