<?php
session_start();
require 'products.php'; // Use straight quotes

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];

    // Check if the product exists
    $product_exists = array_filter($products, function($product) use ($product_id) {
        return $product['id'] == $product_id;
    });

    if ($product_exists) {
        $_SESSION['cart'][] = $product_id;
    }
}

// Redirect back to the product browsing page
header('Location: index.php');
exit;
?>
