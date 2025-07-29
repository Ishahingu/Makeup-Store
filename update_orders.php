<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    // Update the order status in the database
    $update_query = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "Order status updated successfully!";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

?>
