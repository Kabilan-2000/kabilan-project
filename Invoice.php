<?php

$invoiceNumber = "INV-1001";
$invoiceDate = date("Y-m-d");
$customerName = "Suresh";
$customerAddress = "123 Nehru street, Bengaluru";
$items = [
    ["description" => "Vegetables", "quantity" => 2, "price" => 150],
    ["description" => "Chocolate", "quantity" => 1, "price" => 50],
    ["description" => "Fruits", "quantity" => 3, "price" => 300],
];
$totalAmount = 0;
foreach ($items as $item) {
    $totalAmount += $item["quantity"] * $item["price"];
}
$invoiceHTML = "
<!DOCTYPE html>
<html>
<head>
    <title>Invoice - $invoiceNumber</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .invoice-header { text-align: center; }
        .invoice-details, .invoice-items { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .invoice-details td, .invoice-items th, .invoice-items td { border: 10px solid #ddd; padding: 8px; }
        .invoice-items th { background-color:rgb(19, 120, 227); }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class='invoice-header'>
        <h1>Invoice</h1>
        <p><strong>Invoice Number:</strong> $invoiceNumber</p>
        <p><strong>Date:</strong> $invoiceDate</p>
    </div>
    <div class='invoice-customer'>
        <h3>Customer Details</h3>
        <p><strong>Name:</strong> $customerName</p>
        <p><strong>Address:</strong> $customerAddress</p>
    </div>
    <table class='invoice-items'>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>";
foreach ($items as $item) {
    $lineTotal = $item["quantity"] * $item["price"];
    $invoiceHTML .= "
            <tr>
                <td>{$item['description']}</td>
                <td>{$item['quantity']}</td>
                <td class='text-right'>\$" . number_format($item['price'], 2) . "</td>
                <td class='text-right'>\$" . number_format($lineTotal, 2) . "</td>
            </tr>";
}
$invoiceHTML .= "
        </tbody>
        <tfoot>
            <tr>
                <td colspan='3' class='text-right'><strong>Total</strong></td>
                <td class='text-right'>\$" . number_format($totalAmount, 2) . "</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
";
echo $invoiceHTML;
?>
