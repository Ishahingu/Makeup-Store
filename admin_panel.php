<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2 class="section-title">Welcome, Admin 👩‍💻</h2>

    <div class="category-grid">
        <a class="category-card" href="admin_manage_products.php">🛍️ Manage Products</a>
        <a class="category-card" href="admin_view_orders.php">📦 View Orders</a>
        <a class="category-card" href="admin_view_users.php">👥 View Users</a>
        <a class="category-card" href="admin_logout.php">🚪 Logout</a>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
