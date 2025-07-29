<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if (!isset($_GET['product_id'])) {
    echo "Product not found!";
    exit();
}

$product_id = $_GET['product_id'];
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $product['name']; ?> - Product Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
    <div class="text-2xl font-bold text-pink-600">Makeup Store</div>
    <div class="space-x-6">
        <a href="index.php" class="hover:text-pink-500 font-medium">Home</a>
        <a href="cart.php" class="hover:text-pink-500 font-medium">Cart</a>
        <a href="logout.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Logout</a>
    </div>
</nav>

<!-- Product Detail -->
<section class="product-detail-container mt-10 flex justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md flex space-x-10">
        <div class="product-detail-image">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" 
     class="w-full max-w-md h-auto object-contain rounded-lg shadow-lg">

        </div>
        <div class="product-detail-info">
            <h2 class="text-3xl font-bold text-pink-600"><?php echo $product['name']; ?></h2>
            <p class="mt-2 text-gray-600"><?php echo $product['description']; ?></p>
            <p class="mt-4 text-xl font-semibold text-pink-500">₹<?php echo $product['price']; ?></p>

            <!-- Add to Cart Form -->
<form action="add_to_cart.php" method="POST" class="mt-4 flex items-center space-x-4">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
    <input type="number" name="quantity" value="1" min="1" class="border rounded p-2 w-20">
    <button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-full hover:bg-pink-700">Add to Cart</button>
</form>

<form action="checkout.php" method="POST">
<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
<input type="hidden" name="quantity" value="1">
<button type="submit" class="bg-pink-600 text-white px-6 py-2 rounded-full hover:bg-pink-700">Buy Now </button>
</form>




        </div>
    </div>
</section>

</body>
</html>
