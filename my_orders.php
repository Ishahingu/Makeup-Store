<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Get user id from session
$user_id = $_SESSION['user_id'];

// Query to fetch all orders for the user
$query = "
    SELECT o.id AS order_id, p.name AS product_name, o.quantity, o.total_price, o.order_date, o.address AS shipping_address
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE o.user_id = $user_id
    ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching orders: " . mysqli_error($conn));  // ✅ Fix here
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold text-pink-600">Blush & Buy</div>
        <div class="space-x-6">
            <a href="index.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Home</a>
            <a href="cart.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Cart</a>
            <a href="my_orders.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">My Orders</a>
            <a href="logout.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Logout</a>
        </div>
    </nav>

    <!-- My Orders Section -->
    <section class="py-10 px-4">
        <h2 class="text-3xl font-semibold text-center text-pink-600 mb-6">My Orders</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-lg">
                <thead class="bg-pink-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Order ID</th>
                        <th class="py-2 px-4 text-left">Product</th>
                        <th class="py-2 px-4 text-left">Quantity</th>
                        <th class="py-2 px-4 text-left">Total Price</th>
                        <th class="py-2 px-4 text-left">Order Date</th>
                        <th class="py-2 px-4 text-left">Shipping Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($order = mysqli_fetch_assoc($result)): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4"><?php echo $order['order_id']; ?></td>
                            <td class="py-2 px-4"><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td class="py-2 px-4"><?php echo $order['quantity']; ?></td>
                            <td class="py-2 px-4">₹<?php echo $order['total_price']; ?></td>
                            <td class="py-2 px-4"><?php echo $order['order_date']; ?></td>
                            <td class="py-2 px-4"><?php echo $order['shipping_address']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-600">You have no orders yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
    </section>

</body>
</html>
