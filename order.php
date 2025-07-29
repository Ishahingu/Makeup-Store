<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Get product price
    $query = "SELECT price FROM products WHERE product_id = $product_id";
    $result = mysqli_query($mysqli, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Product not found!";
        exit();
    }

    $price = $product['price'];
    $total_price = $price * $quantity;
    $order_date = date('Y-m-d H:i:s');
    $payment_method = 'COD';
    $status = 'Pending';

    // Insert into orders table
    $insert = "INSERT INTO orders (user_id, order_date, total_price, payment_method, status, product_id, quantity) 
               VALUES ('$user_id', '$order_date', '$total_price', '$payment_method', '$status', '$product_id', '$quantity')";
    
    if (mysqli_query($mysqli, $insert)) {
        echo "<script>alert('Order placed successfully!'); window.location.href='my_orders.php';</script>";
    } else {
        echo "Error placing order: " . mysqli_error($mysqli);
    }
} else {
    echo "Invalid request!";
}
?>
