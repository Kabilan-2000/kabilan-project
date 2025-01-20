<?php
session_start();
$products = [
    1 => ['name' => 'Laptop', 'price' => 30000],
    2 => ['name' => 'Smartphone', 'price' => 15000],
    3 => ['name' => 'Headphone', 'price' => 500],
];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $products[$product_id]['name'],
            'price' => $products[$product_id]['price'],
            'quantity' => $quantity
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
</head>
<body>
<h1>Products</h1>
<ul>
    <?php foreach ($products as $id => $product): ?>
        <li>
            <?php echo $product['name']; ?> - $<?php echo $product['price']; ?>
            <form action="products.php" method="post" style="display:inline;">
                <input type="number" name="quantity" value="1" min="1" required>
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<a href="cart.php">Go to Cart</a>
</body>
</html>
