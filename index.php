<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Fetch products from the database (you can limit if needed)
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $query = "SELECT * FROM products";
}
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makeup Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-50">
    <div class="text-2xl font-bold text-pink-600">Blush & Buy</div>
    <div class="space-x-6 flex-grow flex justify-center">
    <div class="flex items-center space-x-4">
        <!-- Search Bar -->
        <form action="index.php" method="get" class="flex items-center">
            <input type="text" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Search Products..." class="px-4 py-2 border rounded-md text-gray-700">
            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-pink-600">Search</button>
        </form>

   </div>
        <a href="index.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Home</a>
        <a href="cart.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Cart</a>
        <a href="my_orders.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">My Orders</a>
        <a href="logout.php" class="text-white bg-pink-500 px-4 py-2 rounded-full hover:bg-pink-600">Logout</a>
 
    </div>
</nav>


<!-- Hero Section with Banner Image -->
<section class="text-center py-20 bg-cover bg-center" style="background-image: url('images/banner.jpg');">
    <div class="bg-black bg-opacity-50 p-6">
        <h1 class="text-4xl md:text-6xl font-bold text-white">Hello, <?php echo $_SESSION['name']; ?>!</h1>
        <p class="mt-4 text-lg md:text-xl text-white">Find your perfect glam look today 💄✨</p>
    </div>
</section>

<!-- Products Section -->
<section class="py-10 px-4">
    <h2 class="text-3xl font-semibold text-center text-pink-600 mb-6">Featured Products</h2>
    
    <!-- Updated product layout using Tailwind grid -->
    <div class="product-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center">
      <?php
      if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="product-card bg-white p-4 shadow-lg rounded-lg w-full max-w-xs">';
              echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" class="w-full h-64 object-cover rounded-lg">';
              echo '<h3 class="text-lg font-semibold text-pink-600 mt-4">' . $row['name'] . '</h3>';
              echo '<p class="text-gray-700 mt-2">' . $row['description'] . '</p>';
              echo '<span class="text-pink-600 font-bold mt-2 block">₹' . $row['price'] . '</span>';
              echo '<a href="product_details.php?product_id=' . $row['product_id'] . '" class="mt-4 inline-block bg-pink-600 text-white px-6 py-3 rounded-full hover:bg-pink-700 transition">View Details</a>';
              echo '</div>';
          }
      } else {
          echo '<p class="text-center text-red-500">Error fetching products.</p>';
      }
      ?>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white text-center text-sm py-6 text-gray-500">
    &copy; <?php echo date('Y'); ?> Makeup Store. All rights reserved 💗
</footer>

</body>
</html>
