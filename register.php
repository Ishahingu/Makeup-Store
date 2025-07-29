<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = $_POST['name'];
  $email    = $_POST['email'];
  $password = $_POST['password'];

  // Simple query using mysqli
  $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
  
  // Execute the query
  if (mysqli_query($conn, $query)) {
      header("Location: login.php");
      exit();
  } else {
      echo "Error: " . mysqli_error($conn);
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Makeup Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 min-h-screen flex items-center justify-center text-gray-800">

  <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-md">
    <h2 class="text-3xl font-bold text-pink-600 text-center mb-6">Create Glam Account</h2>
    <form method="POST" class="space-y-4">
      <input type="text" name="name" required placeholder="Full Name" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-pink-400 outline-none">
      <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-pink-400 outline-none">
      <input type="password" name="password" required placeholder="Password" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-pink-400 outline-none">
      <button type="submit" class="w-full bg-pink-600 text-white py-3 rounded-xl hover:bg-pink-700 transition font-semibold">Register</button>
    </form>
    <p class="text-sm text-center mt-4">Already registered? <a href="login.php" class="text-pink-500 font-semibold hover:underline">Login</a></p>
  </div>

</body>
</html>
