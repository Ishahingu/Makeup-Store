<?php
session_start();
include("admin_navbar.php");
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- <div class="navbar">
        <h2>Admin Dashboard</h2>
        <div>
            <a href="admin_manage_products.php">Manage Products</a>
            <a href="admin_view_orders.php">View Orders</a>
            <a href="admin_view_users.php">View Users</a>
            <a href="admin_logout.php">Logout</a>
        </div>
    </div> -->

    <div class="section-title"><u><b>Welcome, Admin!</b></u></div>

    <div class="categories">
        <div class="category-grid">
            <div class="category-card"><a href="admin_manage_products.php">📦 Manage Products</a></div>
            <div class="category-card"><a href="admin_view_orders.php">🧾 View Orders</a></div>
            <div class="category-card"><a href="admin_view_users.php">👥 View Users</a></div>
        </div>
    </div>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Admin Navbar (if needed) */
.navbar {
    background-color: #ff8c9e; /* Soft pink */
    color: white;
    padding: 20px;
    text-align: center;
}

.navbar h2 {
    font-size: 28px;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 20px;
    font-weight: bold;
}

.navbar a:hover {
    text-decoration: underline;
}

/* Section Title */
.section-title {
    text-align: center;
    color: #d45a5a; /* Soft red tone */
    margin-top: 50px;
    font-size: 32px;
}

/* Categories Section */
.categories {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

/* Grid Layout for Categories */
.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    width: 80%;
}

/* Category Card */
.category-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #ff8c9e;
    transition: transform 0.3s, box-shadow 0.3s;
}

.category-card a {
    text-decoration: none;
    color: inherit;
}

.category-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

/* Hover Effect on Cards */
.category-card:hover a {
    color: #d45a5a; /* Change color on hover */
}

/* Footer */
footer {
    text-align: center;
    padding: 10px;
    background-color: #f5f5f5;
    font-size: 14px;
    color: #888;
}

        </style>
</body>
</html>
