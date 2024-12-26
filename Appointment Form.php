<?php
$host = 'localhost';
$db = 'hospital';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $doctor_name = $_POST['doctor_name'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO appointments (patient_name, email, phone, appointment_date, doctor_name, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $patient_name, $email, $phone, $appointment_date, $doctor_name, $message);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment Form</title>
</head>
<body>
    <h1>Book an Appointment</h1>
    <form action="" method="POST">
        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required><br><br>

        <label for="doctor_name">Doctor Name:</label>
        <input type="text" id="doctor_name" name="doctor_name"><br><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea><br><br>

        <button type="submit">Book Appointment</button>
    </form>
</body>
</html>
