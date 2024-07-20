<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
</head>

<body class="overflow-hidden bg-sky-300  h-screen"></body>
<?php
$guardianController = new GuardianController();
$guardianController->autoLogin(); 

// Check if the success message cookie is set
if (isset($_COOKIE['signup_error'])) {
    // Display the success message in an alert box
    $message = $_COOKIE['signup_error'];
    echo "<script>alert('$message');</script>";

    // Remove the cookie after displaying the message (optional)
    setcookie('signup_error', '', time() - 3600, '/');
}
?>
    <div class=" flex space-between items-center">
        <!-- Left: Image -->
    <div class="w-1/5 h-screen hidden md:block ">
      <img src="src/assets/c2/3.png" alt="Placeholder Image" class="object-cover w-full h-full">
    </div>
    <!-- Right: Login Form -->
    <div class="lg:p-36 md:p-36 font-mono sm:20 p-8 w-full lg:w-4/5">
      <h1 class="text-2xl font-semibold mb-4 text-center font text-pink-400 text_shadow">Welcome Back , Parent</h1>
      <form action="/login" method="POST">
    <!-- Email Input -->
    <div class="mb-4">
        <label for="email" class="block text-pink-900 text-md">Email</label>
        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" required>
    </div>
    <!-- Password Input -->
    <div class="mb-4">
        <label for="password" class="block text-pink-900 text-md">Password</label>
        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" required>
    </div>
    <!-- Remember Me Checkbox -->
    <div class="mb-4 flex items-center">
        <input type="checkbox" id="remember" name="remember" class="text-blue-500">
        <label for="remember" class="text-gray-600 ml-2">Remember Me</label>
    </div>
    <!-- Forgot Password Link -->
    <div class="mb-6 text-blue-500">
        <a href="/forgot-password" class="hover:underline">Forgot Password?</a>
    </div>
    <!-- Login Button -->
    <button class="bg-white hover:bg-gray-200 focus:outline-none text-black black_border font-bold py-2 px-4 rounded" type="submit">Log in</button>
</form>

      <!-- Sign up  Link -->
      <div class="mt-6 text-blue-500 text-center">
        <a href="/signup" class="hover:underline link">Sign up Here</a>
      </div>
    </div>
    </div>

<div class="window" id="loading-spinner">
  <div class="logo">
   <img src="src/assets/c/logo.png" alt="">
  </div>
  <div class="container">
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
  </div>
</div>
</body>

<script src="src/assets/js/loading.js"></script> <!-- Link to your JS file -->