<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
</head>

<body>
<nav class="relative h-20 w-full bg-sky-900 z-1">   
    <div class="flex justify-between items-center py-4 px-4">
        <a href="/">
            <img src="src/assets/c/logo.png" alt="logo" class="h-14" />
        </a>
        <ul class="items-center justify-between space-x-4 hidden md:flex text-lg">
            <li>
                <a href="/about" class="link text-[#74FE71] hover:text-primary-500 font-semibold text_shadow">About</a>
            </li>
            <li>
                <a href="/gameintro" class="link text-[#74FE71] hover:text-primary-500 font-semibold text_shadow leading-tight">App-intro</a>
            </li>
            <li>
                <a href="/contact" class="link text-[#74FE71] hover:text-primary-500 font-semibold text_shadow">Support</a>
            </li>
            <li>
                <a href="/gallery" class="link text-[#74FE71] hover:text-primary-500 font-semibold text_shadow">Gallery</a>
            </li>
            
            <?php
        
            if (isset($_SESSION['guardian_id'])) {
                // User is logged in, display link to dashboard
                echo '<li><a href="/dashboard" class="link bg-yellow-400 text-black black_border px-5 py-2  hover:translate-x-1 hover:translate-y-1 duration-200 rounded-md active:-translate-x-1 active:-translate-y-1 active:bg-yellow-800 inline-block  font-semibold hover:bg-yellow-500">Dashboard</a></li>';
            } else {
                // User is not logged in, display sign up button
                echo '<li><a href="/signup" class="link bg-yellow-400 text-black black_border px-5 py-2  hover:translate-x-1 hover:translate-y-1 duration-200 rounded-md active:-translate-x-1 active:-translate-y-1 active:bg-yellow-800 inline-block  font-semibold hover:bg-yellow-500">Sign Up</a></li>';
            }
            ?>
        </ul>
        
        <div class="md:hidden flex items-center gap-4">
            <?php
            if (isset($_SESSION['guardian_id'])) {
                // User is logged in, display link to dashboard in mobile view
                echo '<a href="/dashboard" class="bg-yellow-400 link text-black black_border hover:translate-x-1 hover:translate-y-1 duration-200 p-2 px-5 py-2 text-lg font-semibold hover:bg-yellow-500 active:-translate-y-1 active:bg-yellow-800 inline-block ">Dashboard</a>';
            } else {
                // User is not logged in, display sign up button in mobile view
                echo '<a href="/signup" class="bg-yellow-400 link text-black black_border hover:translate-x-1 hover:translate-y-1 duration-200 p-2 px-5 py-2 text-lg font-semibold hover:bg-yellow-500 active:-translate-y-1 active:bg-yellow-800 inline-block ">Sign Up</a>';
            }
            ?>
            <button id="menu-btn">
                <i class="fa fa-bars text-black bg-yellow-400 text-xl p-2 font-semibold black_border hover:text-primary-400"></i>
            </button>
        </div>
    </div>
    <div class="hidden absolute left-0 right-0 md:hidden bg-sky-600 bg-opacity-50 z-50 duration-300" id="mobile-menu">
        <ul class="text-center">
            <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60">
                <a href="/about" class="link text-text-100 hover:text-primary-500 px-5 py-2 font-semibold">About</a>
            </li>
            <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60">
                <a href="/gameintro" class="link text-text-100 hover:text-primary-500 px-5 py-2 font-semibold">App-intro</a>
            </li>
            <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 ">
                <a href="/contact" class="link text-text-100 hover:text-primary-500 px-5 py-2 font-semibold">Support</a>
            </li>
            <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 ">
                <a href="/gallery" class="link text-text-100 hover:text-primary-500 px-5 py-2 font-semibold">Gallery</a>
            </li>
        </ul>
    </div>
</nav>


<script src="src/assets/js/script.js"></script>
<script src="src/assets/js/jquery.js"></script>


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

<script src="src/assets/js/loading.js"></script> <!-- Link to your JS file -->