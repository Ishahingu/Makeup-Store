<?php
session_start();
include('db.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Plain text password comparison
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name']    = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>


<!-- HTML Form to collect email and password
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form> -->

<!-- Display error if login fails -->
<?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Makeup Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 min-h-screen flex items-center justify-center text-gray-800">

  <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-md">
    <h2 class="text-3xl font-bold text-pink-600 text-center mb-6">Welcome Back, Glam Queen</h2>
    
    <?php if (isset($error)): ?>
      <p class="text-red-500 text-center mb-4 text-sm"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-pink-400 outline-none">
      <input type="password" name="password" required placeholder="Password" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-pink-400 outline-none">
      <button type="submit" class="w-full bg-pink-600 text-white py-3 rounded-xl hover:bg-pink-700 transition font-semibold">Login</button>
    </form>
    <p class="text-sm text-center mt-4">Don't have an account? <a href="register.php" class="text-pink-500 font-semibold hover:underline">Register</a></p>
  </div>

</body>
</html>
