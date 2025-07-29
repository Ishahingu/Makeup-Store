<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Fetch cart items for the logged-in user
$user_id = $_SESSION['user_id'];
$query = "SELECT c.id, p.name, p.price, c.quantity, p.image, p.description FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id = $user_id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .cart-item {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .continue-shopping-btn, .checkout-btn {
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 30px;
            display: inline-block;
            margin-top: 20px;
        }
        .continue-shopping-btn {
            background-color: #f87171;
            color: white;
        }
        .continue-shopping-btn:hover {
            background-color: #f03e3e;
        }
        .checkout-btn {
            background-color: #fbbf24;
            color: white;
        }
        .checkout-btn:hover {
            background-color: #f59e0b;
        }
        .cart-item img {
            max-width: 100px;
            border-radius: 8px;
        }
        .product-info {
            padding-left: 20px;
            flex-grow: 1;
        }
        .product-info h3 {
            font-size: 18px;
            color: #f43f5e;
            font-weight: bold;
        }
        .product-info p {
            font-size: 14px;
            color: #6b7280;
        }
        .product-info .price {
            color: #f43f5e;
            font-weight: bold;
        }
        .cart-item input[type="number"] {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .update-btn, .remove-btn {
            padding: 8px 16px;
            background-color: #4ade80;
            color: white;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
        }
        .remove-btn {
            background-color: #ef4444;
        }
    </style>
</head>
<body class="bg-pink-50 text-gray-800">

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

<!-- Cart Items Section -->
<section class="py-10 px-4">
    <h2 class="text-3xl font-semibold text-center text-pink-600 mb-6">Your Shopping Cart</h2>
    <div class="cart-container space-y-6">
        <?php
        if (mysqli_num_rows($result) > 0) {
            $total_price = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $subtotal = $row['price'] * $row['quantity'];
                $total_price += $subtotal;
                echo '<div class="cart-item flex items-center space-x-6">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<div class="product-info">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<span class="price">₹' . $row['price'] . '</span>';
                echo '<form action="update_cart.php" method="POST" class="mt-2 flex items-center">';
                echo '<input type="hidden" name="cart_id" value="' . $row['id'] . '">';
                echo '<input type="number" name="quantity" value="' . $row['quantity'] . '" min="1" class="border rounded p-2 w-20">';
                echo '<button type="submit" class="update-btn">Update</button>';
                echo '</form>';
                echo '<form action="remove_from_cart.php" method="POST" class="mt-2">';
                echo '<input type="hidden" name="cart_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="remove-btn">Remove</button>';
                echo '</form>';
                echo '</div>';
                echo '<span class="text-pink-600 font-semibold">₹' . $subtotal . '</span>';
                echo '</div>';
            }
            echo '<div class="text-right mt-4">';
            echo '<h3 class="text-2xl font-semibold text-pink-600">Total: ₹' . $total_price . '</h3>';
            echo '</div>';
        } else {
            echo '<p class="text-center text-gray-600">Your cart is empty. Add some products!</p>';
        }
        ?>
    </div>

    <form action="checkout.php" method="POST">
    <input type="hidden" name="total_price" value="<?php echo $grand_total; ?>">
    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Proceed to Checkout</button>
</form>



    <!-- Continue Shopping Button -->
    <div class="text-center mt-6">
        <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
    </div>

    
</section>

</body>
</html>
