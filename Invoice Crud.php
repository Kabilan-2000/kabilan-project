<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "invoice_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $customer_email = htmlspecialchars($_POST['customer_email']);
    $item_description = htmlspecialchars($_POST['item_description']);
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];
    $total = $quantity * $price;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare("UPDATE invoices SET customer_name=?, customer_email=?, item_description=?, quantity=?, price=?, total=? WHERE id=?");
        $stmt->bind_param("sssiddi", $customer_name, $customer_email, $item_description, $quantity, $price, $total, $id);

        if ($stmt->execute()) {
            echo "<p>Invoice updated successfully!</p>";
        } else {
            echo "<p>Error updating invoice: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO invoices (customer_name, customer_email, item_description, quantity, price, total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssidd", $customer_name, $customer_email, $item_description, $quantity, $price, $total);

        if ($stmt->execute()) {
            echo "<p>Invoice created successfully!</p>";
        } else {
            echo "<p>Error creating invoice: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM invoices WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p>Invoice deleted successfully!</p>";
    } else {
        echo "<p>Error deleting invoice: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$invoices = $conn->query("SELECT * FROM invoices");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 20%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
        input, textarea { width: 20%; padding: 4px; margin: 5px 0; box-sizing: border-box; }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Invoice System</h1>

    <h2>Create or Update Invoice</h2>
    <form method="POST" action="">
        <input type="hidden" id="id" name="id" value="<?php echo isset($_GET['edit']) ? htmlspecialchars($_GET['edit']) : ''; ?>">

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

        <input type="submit" value="Save Invoice">
    </form>

    <h2>Invoices</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Item Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $invoices->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
            <td><?php echo htmlspecialchars($row['item_description']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['total']); ?></td>
            <td>
                <a href="?edit=<?php echo $row['id']; ?>"  onclick="return confirm('Are you sure?')">Edit</a>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
