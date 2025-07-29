<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Get cart item ID from the POST request
$cart_id = $_POST['cart_id'];

// Remove the item from the cart
$query = "DELETE FROM cart WHERE id = $cart_id";
if (mysqli_query($conn, $query)) {
    header("Location: cart.php"); // Redirect to cart page after removing item
    exit();
} else {
    echo "Error removing item from cart: " . mysqli_error($conn);
}
?>
