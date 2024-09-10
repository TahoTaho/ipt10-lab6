<?php
session_start();
require 'products.php';

// Generate a unique order code
$order_code = substr(md5(uniqid(rand(), true)), 0, 8);

// Retrieve the cart items
$cart_items = array_filter($products, function($product) {
    return in_array($product['id'], $_SESSION['cart']);
});

// Compute total price
$total_price = array_reduce($cart_items, function($sum, $product) {
    return $sum + $product['price'];
}, 0);

// Prepare order details
$order_details = "Order Code: $order_code\n";
$order_details .= "Date and Time: " . date('Y-m-d H:i:s') . "\n";
$order_details .= "Items:\n";

foreach ($cart_items as $item) {
    $order_details .= "Product ID: " . $item['id'] . "\n";
    $order_details .= "Product Name: " . $item['name'] . "\n";
    $order_details .= "Price: " . $item['price'] . " PHP\n";
}

$order_details .= "Total Price: " . $total_price . " PHP\n";
$order_details .= str_repeat("-", 20) . "\n"; // Separator for clarity

// Append the order details to orders.txt
file_put_contents('orders.txt', $order_details, FILE_APPEND);

// Clear the cart
$_SESSION['cart'] = [];

// Display order confirmation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Code: <?php echo htmlspecialchars($order_code); ?></p>
    <p>Date and Time: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p>Total Price: <?php echo number_format($total_price, 2); ?> PHP</p>
</body>
</html>
