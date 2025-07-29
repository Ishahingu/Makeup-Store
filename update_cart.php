<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Get cart item ID and new quantity from the POST request
$cart_id = $_POST['cart_id'];
$new_quantity = $_POST['quantity'];

// Make sure quantity is valid (positive number)
if ($new_quantity < 1) {
    $new_quantity = 1;
}

// Update the cart with the new quantity
$query = "UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id";
if (mysqli_query($conn, $query)) {
    header("Location: cart.php"); // Redirect to cart page after updating
    exit();
} else {
    echo "Error updating cart: " . mysqli_error($mysqli);
}
?>
