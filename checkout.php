<!-- checkout.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$product_id = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? null;
$total_price = $_POST['total_price'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto bg-white mt-10 p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-pink-600">Enter Your Details</h2>
    <form action="place_order.php" method="POST">
        <?php if ($product_id): ?>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
        <?php endif; ?>
        <?php if ($total_price): ?>
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        <?php endif; ?>

        <label class="block mb-2 text-gray-700">Shipping Address:</label>
        <textarea name="address" required class="w-full p-2 border border-gray-300 rounded mb-4"></textarea>

        <label class="block mb-2 text-gray-700">Payment Method:</label>
        <select name="payment_method" required class="w-full p-2 border border-gray-300 rounded mb-4">
            <option value="">Select</option>
            <option value="UPI">UPI</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select>

        <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded hover:bg-pink-600">Place Order</button>
    </form>
</div>

</body>
</html>
