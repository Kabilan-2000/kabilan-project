<?php
// Database connection settings
$host = "localhost";  // Database host, typically 'localhost' for local servers
$username = "root";   // Database username (default is 'root' for local server)
$password = "";       // Database password (empty for local server)
$dbname = "login_form"; // Name of the database where data will be stored

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there is a connection error, stop the script and print an error message
    die("Connection failed: " . $conn->connect_error);
} else {
    // If the connection is successful, print a success message (for debugging purposes)
    echo "Connected successfully to the database.";
}

// Handle form submission and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data using POST method
    $form_username = $_POST['username'];
    $form_password = $_POST['password'];
    $form_email = $_POST['email'];
    $form_mobile = $_POST['mobile'];
    $form_message = $_POST['message'];

    // Insert data into the database using a prepared statement
    $sql = "INSERT INTO users (username, password, email, mobile)
            VALUES (?, ?, ?, ?, ?)";

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $form_username, $form_password, $form_email, $form_mobile,);

    // Execute the prepared statement and check if the insertion was successful
    if ($stmt->execute()) {
        // If the data is successfully inserted, display a success message and the form data
        echo "<h2>Form Submitted Successfully</h2>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($form_username) . "</p>";
        echo "<p><strong>Password:</strong> " . htmlspecialchars($form_password) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($form_email) . "</p>";
        echo "<p><strong>Mobile Number:</strong> " . htmlspecialchars($form_mobile) . "</p>";
    } else {
        // If there is an error with the query execution, print the error message
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
