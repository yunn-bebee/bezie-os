<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezie-os</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
</head>
<body>
<div class="taskbar fixed bottom-0 w-screen shadow-inner bg-gray-400 border black_border p-2 z-50">
    <button class="bg-yellow-400 pointer text-black black_border px-5 py-1 rounded-md active:bg-yellow-800 inline-block font font-semibold hover:bg-yellow-500" id="menu-btn">Menu</button>
    <div class="text font text-xl font-bold float-right">Admin
      time ->
    </div>

</div>

<div class="absolute text-lg font-mono left-2 bottom-14 hidden bg-gray-300 p-3 rounded-md black_border z-50 duration-300" id="mobile-menu">    
    <ul class="text-left ">
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/dashboard" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/users" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-users"></i> Users</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/contacts" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-envelope"></i> Contacts</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/lessons" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-book"></i> Lessons</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/tests" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-file-circle-question"></i> Tests</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/achievements" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-trophy"></i> Achievement</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/settings" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-cogs"></i> Settings</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/reports" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-chart-line"></i> Reports</a>
        </li>
        <li class="px-12 py-2 hover:bg-sky-500 hover:bg-opacity-60 rounded-md my-1 shadow-inner">
          <a href="/admin/logout" class="text-text-100 hover:text-primary-500 px-5 py-2 font-semibold"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>  
</div>
    
   <script src="src/assets/js/script.js"></script>
   <script src="../src/assets/js/script.js"></script>
