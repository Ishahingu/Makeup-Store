<!DOCTYPE html>
<html>
<head>
    <title>Thank You - Order Placed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
    <div class="text-2xl font-bold text-pink-600">Makeup Store</div>
    <div class="space-x-6">
        <a href="index.php" class="hover:text-pink-500 font-medium">Home</a>
        <a href="products.php" class="hover:text-pink-500 font-medium">Shop More</a>
        <a href="logout.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Logout</a>
    </div>
</nav>

<!-- Thank You Message -->
<section class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-10 rounded-3xl shadow-2xl text-center">
        <h1 class="text-4xl font-extrabold text-pink-600 mb-4">Thank You Beautiful! 💖</h1>
        <p class="text-lg text-gray-700 mb-6">Your order has been placed successfully! 💄<br>We’ll make sure your glam goodies reach you soon ✨</p>
        <a href="index.php" class="bg-pink-500 text-whit<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT o.id, p.name, o.quantity, o.total_price, o.order_date, o.address, o.payment_method 
          FROM orders o 
          JOIN products p ON o.product_id = p.product_id 
          WHERE o.user_id = $user_id 
          ORDER BY o.order_date DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
    $order = mysqli_fetch_assoc($result);
    echo "Order ID: " . $order['id'] . "<br>";
    echo "Product Name: " . $order['name'] . "<br>";
    echo "Quantity: " . $order['quantity'] . "<br>";
    echo "Total Price: ₹" . $order['total_price'] . "<br>";
    echo "Order Date: " . $order['order_date'] . "<br>";
    echo "Shipping Address: " . $order['address'] . "<br>";
    echo "Payment Method: " . $order['payment_method'] . "<br>";
} else {
    echo "No orders found.";
}
?>
e px-6 py-3 rounded-full hover:bg-pink-600">Continue Shopping</a>
    </div>
</section>

</body>
</html>
