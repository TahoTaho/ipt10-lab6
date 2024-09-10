<?php
session_start();

// Clear the cart
$_SESSION['cart'] = [];

// Redirect to the cart page
header('Location: cart.php');
exit;
?>
