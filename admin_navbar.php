<!-- admin_navbar.php -->
<style>
    .admin-navbar {
        background: #880e4f;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .admin-navbar .left,
    .admin-navbar .right {
        display: flex;
        align-items: center;
    }

    .admin-navbar a {
        color: #fff;
        margin: 0 10px;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .admin-navbar a:hover {
        color: #f8bbd0;
        text-decoration: underline;
    }

    .admin-navbar .logo {
        font-size: 22px;
        font-weight: bold;
        letter-spacing: 1px;
    }
</style>

<div class="admin-navbar">
    <div class="left">
        <div class="logo">Admin Panel</div>
    </div>
    <div class="right">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_manage_products.php">Products</a>
        <a href="admin_view_orders.php">Orders</a>
        <a href="admin_view_users.php">Users</a>
        <a href="admin_logout.php" style="color: #ffcccb;">Logout</a>
    </div>
</div>
