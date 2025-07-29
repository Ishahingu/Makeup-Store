<?php
session_start();
include("admin_navbar.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$users = mysqli_query($conn, "SELECT * FROM user ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<div class="container">
    <h2 class="section-title">All Users 👩‍💻</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($users)) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
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

/* Container for the Users Table */
.container {
    width: 90%;
    margin: 30px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Users Table */
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

table td {
    font-size: 16px;
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
