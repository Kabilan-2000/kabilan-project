<?php
// Set the Content-Type to JSON
header("Content-Type: application/json");

// Include database connection
include('databases.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate and sanitize input
    if (isset($data['product_id']) && isset($data['quantity']) && isset($data['customer_name']) && isset($data['customer_email'])) {
        
        $product_id = $conn->real_escape_string($data['product_id']);
        $quantity = $conn->real_escape_string($data['quantity']);
        $customer_name = $conn->real_escape_string($data['customer_name']);
        $customer_email = $conn->real_escape_string($data['customer_email']);

        // Query to get product price
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch product price
            $product = $result->fetch_assoc();
            $price = $product['price'];
            $total_price = $price * $quantity;
            // Insert order into the database
            $order_sql = "INSERT INTO orders (product_id, quantity, total_price, customer_name, customer_email) 
                          VALUES ('$product_id', '$quantity', '$total_price', '$customer_name', '$customer_email')";

            if ($conn->query($order_sql) === TRUE) {
                // If the order was successfully inserted
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Order placed successfully!',
                    'order_id' => $conn->insert_id
                ]);
            } else {
                // If there was an error inserting the order
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to place order.'
                ]);
            }
        } else {
            // If the product was not found
            echo json_encode([
                'status' => 'error',
                'message' => 'Product not found.'
            ]);
        }
    } else {
        // If the required data is missing
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input data.'
        ]);
    }
}

// Close the database connection
$conn->close();
?>
