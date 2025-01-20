<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "invoice_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "Connected successfully to the database";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $item_description = $_POST['item_description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $quantity * $price;

    $sql = "INSERT INTO invoices (customer_name, customer_email, item_description, quantity, price, total)
            VALUES ('$customer_name', '$customer_email', '$item_description', $quantity, $price, $total)";

    if ($conn->query($sql) === TRUE) {
        echo "Invoice created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
</head>
<body>
    <h1>Create Invoice</h1>
    <form method="POST" action="">
        <label for="customer_name">Customer Name:</label><br>
        <input type="text" id="customer_name" name="customer_name" required><br><br>

        <label for="customer_email">Customer Email:</label><br>
        <input type="email" id="customer_email" name="customer_email" required><br><br>

        <label for="item_description">Item Description:</label><br>
        <textarea id="item_description" name="item_description" required></textarea><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="price">Price per Item:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <input type="submit" value="Create Invoice">
    </form>
</body>
</html>
