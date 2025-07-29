<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Only access $_POST if the form was submitted
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded admin login for example
    if ($email === "admin@yourdomain.com" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2 class="section-title">Admin Login</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f4f8;
    color: #333;
    margin: 0;
    padding: 0;
}

h2.section-title {
    text-align: center;
    font-size: 32px;
    color: #ff8c9e; /* Soft pink */
    margin-top: 100px;
}

form {
    width: 300px;
    margin: 40px auto;
    padding: 30px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

input[type="email"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #ff8c9e; /* Soft pink */
    outline: none;
}

input[type="submit"] {
    background-color: #ff8c9e;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #d45a5a; /* Darker soft pink */
}

.error {
    color: #d45a5a; /* Red for error messages */
    font-size: 16px;
    text-align: center;
    margin-top: 10px;
}

/* Mobile Responsiveness */
@media (max-width: 600px) {
    form {
        width: 90%;
        padding: 20px;
    }

    h2.section-title {
        font-size: 28px;
    }
}

        </style>
</body>
</html>
