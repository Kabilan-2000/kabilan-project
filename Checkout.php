<?php
session_start();
$total_price = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    echo "<h3>Order Summary</h3>";
    echo "<p>Name: $name</p>";
    echo "<p>Address: $address</p>";
    echo "<p>Payment Method: $payment_method</p>";
    echo "<p>Total Price: $$total_price</p>";

    unset($_SESSION['cart']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
<h1>Checkout</h1>
<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <h2>Your Cart</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li>
                <?php echo $item['name']; ?> - $<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <p>Total Price: $<?php echo $total_price; ?></p>
    <h2>Shopping Details</h2>
    <form action="checkout.php" method="post">
        Name: <input type="text" name="name" required><br>
        Address: <input type="text" name="address" required><br>
        Payment Method: 
        <select name="payment_method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="PayPal">PayPal</option>
        </select><br><br>
        <input type="submit" value="Submit Order">
    </form>
<?php else: ?>
    <p>Your cart is empty. <a href="products.php">Browse Products</a></p>
<?php endif; ?>
</body>
</html>
