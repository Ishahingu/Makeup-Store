<?php
include 'db.php'; // Include the database connection

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Makeup Store</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <header>
        <h1>Makeup Products</h1>
    </header>

    <main>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h2><?php echo $product['name']; ?></h2>
                    <p><?php echo $product['description']; ?></p>
                    <p>Price: ₹<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product_details.php?id=<?php echo $product['product_id']; ?>" class="view-details">View Details</a>
                    <a href="add_to_cart.php?id=<?php echo $product['product_id']; ?>" class="add-to-cart">Add to Cart</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Makeup Store</p>
    </footer>
</body>
</html>
