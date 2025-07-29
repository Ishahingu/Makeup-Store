<?php
session_start();
include("db.php");
include("admin_navbar.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $insert_query = "INSERT INTO products (name, price, image, description) VALUES ('$name', '$price', '$image', '$description')";

    if (mysqli_query($conn, $insert_query)) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}


// Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Use prepared statement for delete query
    $delete_query = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $delete_query->bind_param("i", $id);
    $delete_query->execute();
}

// Fetch product to edit
$edit_product = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // Use prepared statement for select query
    $select_query = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $select_query->bind_param("i", $id);
    $select_query->execute();
    $result = $select_query->get_result();
    $edit_product = $result->fetch_assoc();
}

// Update Product
if (isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Use prepared statement for update query
    $update_query = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE product_id = ?");
    $update_query->bind_param("sdsi", $name, $price, $image, $id);

    if ($update_query->execute()) {
        header("Location: admin_manage_products.php");
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}

// Fetch all products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- <?php include("navbar.php"); ?> -->

<h2 class="section-title">Manage Products</h2>

<!-- Add Product Form -->
<?php if (!$edit_product): ?>
    <h3>Add New Product</h3>
    <form method="post">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="text" name="image" placeholder="Image URL" required>
        <input type="submit" name="add_product" value="Add Product">
    </form>
<?php endif; ?>

<!-- Edit Product Form -->
<?php if ($edit_product): ?>
    <h3>Edit Product: <?= htmlspecialchars($edit_product['name']) ?></h3>
    <form method="post">
        <input type="hidden" name="product_id" value="<?= $edit_product['product_id'] ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($edit_product['name']) ?>" required>
        <input type="number" step="0.01" name="price" value="<?= $edit_product['price'] ?>" required>
        <input type="text" name="image" value="<?= htmlspecialchars($edit_product['image']) ?>" required>
        <input type="submit" name="update_product" value="Update Product">
        <a href="admin_manage_products.php" style="margin-left: 10px;">Cancel</a>
    </form>
<?php endif; ?>

<!-- Products Table -->
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $products->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>₹<?= number_format($row['price'], 2) ?></td>
        <td><img src="<?= $row['image'] ?>" width="80"></td>
        <td>
            <a href="?edit=<?= $row['product_id'] ?>">Edit</a> |
            <a href="?delete=<?= $row['product_id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Navbar */
.navbar {
    background-color: #ff8c9e; /* Soft pink */
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 20px;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 20px;
    font-weight: bold;
}

.navbar a:hover {
    text-decoration: underline;
    color: #333;
}

/* Main Section */
h2.section-title {
    text-align: center;
    color: #d45a5a; /* Soft red tone */
    margin-top: 30px;
}

h3 {
    color: #555;
    font-size: 20px;
    margin-bottom: 20px;
}

form {
    width: 70%;
    margin: 30px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

form input[type="text"], form input[type="number"], form input[type="submit"] {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

form input[type="submit"] {
    background-color: #ff8c9e;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #d45a5a; /* Darker pink for hover */
}

/* Products Table */
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #f4f4f4;
}

table th {
    background-color: #ff8c9e; /* Soft pink for header */
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f9f9f9; /* Very light gray for even rows */
}

table tr:hover {
    background-color: #ffebeb; /* Light pink hover */
}

table a {
    color: #ff8c9e;
    text-decoration: none;
    font-weight: bold;
}

table a:hover {
    color: #d45a5a;
}

/* Product Image */
img {
    max-width: 100px;
    border-radius: 5px;
}

/* Cancel Link */
a {
    text-decoration: none;
    color: #777;
    font-size: 16px;
}

a:hover {
    color: #d45a5a;
}

/* Button styles for Product Management */
input[type="submit"] {
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #ff8c9e;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border: none;
}

input[type="submit"]:hover {
    background-color: #d45a5a; /* Hover color for submit */
}

    </style>


</body>
</html>
