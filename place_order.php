<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'] ?? 'Default Address';
    $payment_method = $_POST['payment_method'] ?? 'Cash on Delivery';

    // If user is buying single product (Buy Now)
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Get price
        $query = "SELECT price FROM products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $price = $row['price'];
        $total_price = $price * $quantity;

        $insert = "INSERT INTO orders (user_id, product_id, quantity, total_price, address, payment_method)
                   VALUES ('$user_id', '$product_id', '$quantity', '$total_price', '$address', '$payment_method')";
        mysqli_query($conn, $insert);

    } elseif (isset($_POST['total_price'])) {
        // If placing cart order (multiple items)
        $total_price = $_POST['total_price'];

        // Get all items from cart
        $cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
        $cart_result = mysqli_query($conn, $cart_query);

        while ($item = mysqli_fetch_assoc($cart_result)) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];

            $product_query = "SELECT price FROM products WHERE product_id = $product_id";
            $product_result = mysqli_query($conn, $product_query);
            $product = mysqli_fetch_assoc($product_result);
            $price = $product['price'];

            $item_total = $price * $quantity;

            $insert = "INSERT INTO orders (user_id, product_id, quantity, total_price, address, payment_method)
                       VALUES ('$user_id', '$product_id', '$quantity', '$item_total', '$address', '$payment_method')";
            mysqli_query($conn, $insert);
        }

        // Clear cart
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");
    }

    echo "<script>alert('Order placed successfully!'); window.location.href='my_orders.php';</script>";
    exit();

} else {
    header("Location: index.php");
    exit();
}
?>
