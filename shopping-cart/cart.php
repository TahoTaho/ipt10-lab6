<?php
session_start();
require 'products.php';

// Map product IDs to product details
$cart_items = array_filter($products, function($product) {
    return in_array($product['id'], $_SESSION['cart']);
});

// Compute total price
$total_price = array_reduce($cart_items, function($sum, $product) {
    return $sum + $product['price'];
}, 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php foreach ($cart_items as $item): ?>
            <li>
                <?php echo $item['name']; ?> - <?php echo $item['price']; ?> PHP
            </li>
        <?php endforeach; ?>
    </ul>
    <p>Total Price: <?php echo $total_price; ?> PHP</p>

    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
</body>
</html>
