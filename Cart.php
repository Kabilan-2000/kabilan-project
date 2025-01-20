<?php
session_start();

$total_price = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>

<h1>Shopping Cart</h1>
<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <ul>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <li>
                <?php echo $item['name']; ?> - $<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <p>Total Price: $<?php echo $total_price; ?></p>
    <a href="checkout.php">Proceed to Checkout</a> 
    <a href="cart.php?action=clear">Clear Cart</a>
<?php else: ?>
    <p>Your cart is empty.</p>
    <a href="products.php">Back to Products</a>
<?php endif; ?>

</body>
</html>
