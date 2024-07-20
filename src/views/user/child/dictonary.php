<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee website</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../src/assets/css/style.css">
</head>

<body class="overflow-hidden w-screen h-screen bg-sky-300">
<?php
// Check if the success message cookie is set
if (isset($_COOKIE['signup_error'])) {
    // Display the success message in an alert box
    $message = $_COOKIE['signup_error'];
    echo "<script>alert('$message');</script>";

    // Remove the cookie after displaying the message (optional)
    setcookie('signup_error', '', time() - 3600, '/');
}
?>
<div class="flex flex-col p-2 gap-4 w-[10%] absolute top-5">
    <a href="#child-profile" class="bg-gray-300 flex items-center flex-col justify-center size-14 rounded-md black_border max-sm:size-10 font-mono"><img
                src="src/assets/images/child.png" class="size-10">Child</a>
    <button onclick="openModal('guardianReviewModal')"
            class="bg-gray-300 flex items-center flex-col justify-center size-14 rounded-md black_border max-sm:size-10 font-mono"><img
                src="src/assets/images/child.png" class="size-10">Review
    </button>
    <button class="bg-gray-300 flex items-center flex-col justify-center size-14 rounded-md black_border max-sm:size-10 font-mono"><img
                src="src/assets/images/child.png" class="size-10">Child</button>
    <a href="#child-profile" class="bg-gray-300 flex items-center flex-col justify-center size-14 rounded-md black_border max-sm:size-10 font-mono"><img
                src="src/assets/images/child.png" class="size-10">Child</a>
</div>

<div class="border border-black bg-yellow-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
    <div class="border-gray-400 border-4">
     
        <?php   $name = "";
         require_once 'src\views\components\windowtab.php'; ?>

        <!-- Content Area with Overflow Scroll -->
        <div class="mt-[52px] overflow-y-scroll h-screen">
            <div class="p-4">
            <form action="" class="flex items-center justify-between mb-6">
            <input type="text" id="searchtxt" class="flex-grow p-2 border-b-2 border-white bg-transparent text-lg focus:outline-none" placeholder="Search what you want">
            <button type="submit" id="search" class="ml-4 p-2 text-lg rounded-md bg-white text-yellow-800">Search</button>
        </form>
        <div class="result">
            <!-- Results will be displayed here -->
        </div>

              
            </div>
        </div> <!-- End of overflow-y-scroll -->
    </div> <!-- End of border-gray-400 -->
</div> <!-- End of bg-yellow-200 -->


<?php require 'src\views\user\child\components\taskbar.php'; ?>

<!-- Include custom scripts -->
<script src="../src/assets/js/script.js"></script>
<script src="../src/assets/js/dictionary.js"></script>



</body>
</html>
