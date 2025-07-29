<?php
session_start();
include("admin_navbar.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>



<div class="container">
    <h2 class="section-title">All Orders 📦</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Date</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>₹<?php echo $row['total_price']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form action="update_orders.php" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if ($row['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Shipped" <?php if ($row['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="Delivered" <?php if ($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                    </select>
                    <input type="submit" value="Update">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
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

/* Section Title */
h2.section-title {
    text-align: center;
    color: #d45a5a; /* Soft red tone */
    margin-top: 30px;
    font-size: 30px;
}

/* Container for the Orders Table */
.container {
    width: 90%;
    margin: 30px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Orders Table */
table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
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
    background-color: #f9f9f9; /* Light gray for even rows */
}

table tr:hover {
    background-color: #ffebeb; /* Light pink hover */
}

table td select {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

table td input[type="submit"] {
    background-color: #ff8c9e;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

table td input[type="submit"]:hover {
    background-color: #d45a5a; /* Darker pink for hover */
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
<?php include 'footer.php'; ?>

</body>
</html>
