<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Lessons</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../src/assets/css/style.css">
    <style>
        /* Your custom styles here */
        .lesson-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            width: 80%;
            text-align: center;
        }
        .lesson-card.locked {
            opacity: 0.5;
            pointer-events: none;
        }
        .subject-button {
            background-color: #3B82F6;
            color: white;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
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
    <?php require_once 'src\views\user\child\components\icons.php'; ?>

    <div class="border border_black bg-yellow-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
        <div class="border-gray-400 border-4">
            <?php $name = "bee"; ?>
            <?php require 'src\views\components\windowtab.php'; ?>

                      <!-- Content Area with Overflow Scroll -->
            <div class="mt-[52px] pt-10 overflow-y-scroll h-full w-full pl-4 ">
                    <h1 class="font text-4xl text-pink-500 font-semibold mb-7 mt-2 text_shadow">Test for level 3 </h1>  
        

    <!-- Test title -->
    <h2 class="text-2xl  mb-4 font text-pink-500 font-semibold">Child Lessons Test</h2>

    <!-- Progress bar -->
    <div class="progress-bar mb-4">
      <div class="progress" style="width: 6%"></div>
    </div>

    <!-- Questions container -->
    <div class="questions-container">
      <!-- Question 1 -->
      <div class="card p-6 mb-4 black_border bg-white m-2 rounded-md">
        <h3 class="card-title  text-lg font-mono ">Question 1</h3>
        <p class="card-text text-2xl font font-bold">What is the capital of France?</p>
        <ul class="list-group p-3 font font-semibold">
          <li class="list-group-item">
            <input type="radio" id="q1-a" name="q1" value="A">
            <label for="q1-a">Paris</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-b" name="q1" value="B">
            <label for="q1-b">London</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-c" name="q1" value="C">
            <label for="q1-c">Berlin</label>
          </li>
        </ul>
      </div>
      <div class="card p-6 mb-4 black_border bg-white m-2 rounded-md">
        <h3 class="card-title  text-lg font-mono ">Question 1</h3>
        <p class="card-text text-2xl font font-bold">What is the capital of France?</p>
        <ul class="list-group p-3 font font-semibold">
          <li class="list-group-item">
            <input type="radio" id="q1-a" name="q1" value="A">
            <label for="q1-a">Paris</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-b" name="q1" value="B">
            <label for="q1-b">London</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-c" name="q1" value="C">
            <label for="q1-c">Berlin</label>
          </li>
        </ul>
      </div>
      <div class="card p-6 mb-4 black_border bg-white m-2 rounded-md">
        <h3 class="card-title  text-lg font-mono ">Question 1</h3>
        <p class="card-text text-2xl font font-bold">What is the capital of France?</p>
        <ul class="list-group p-3 font font-semibold">
          <li class="list-group-item">
            <input type="radio" id="q1-a" name="q1" value="A">
            <label for="q1-a">Paris</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-b" name="q1" value="B">
            <label for="q1-b">London</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-c" name="q1" value="C">
            <label for="q1-c">Berlin</label>
          </li>
        </ul>
      </div>
      <div class="card p-6 mb-4 black_border bg-white m-2 rounded-md">
        <h3 class="card-title  text-lg font-mono ">Question 10</h3>
        <p class="card-text text-2xl font font-bold">What is the capital of France?</p>
        <ul class="list-group p-3 font font-semibold">
          <li class="list-group-item">
            <input type="radio" id="q1-a" name="q1" value="A">
            <label for="q1-a">Paris</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-b" name="q1" value="B">
            <label for="q1-b">London</label>
          </li>
          <li class="list-group-item">
            <input type="radio" id="q1-c" name="q1" value="C">
            <label for="q1-c">Berlin</label>
          </li>
        </ul>
      </div>

    <!-- Submit button -->
    <button class="btn btn-primary">Submit</button>

    <!-- Marks container -->
    <div class="marks-container mt-4">
      <h2 class="text-lg font-bold">Your Marks:</h2>
      <p id="marks" class="text-2xl font-bold">0/10</p>
    </div>
  </div>

          <!-- End of main content -->

        </div> <!-- End of border-gray-400 -->
    </div> <!-- End of bg-yellow-200 -->
    </div>
    <!-- Include custom scripts -->
    <script src="../../src/assets/js/script.js"></script>

    <?php require 'src\views\user\child\components\taskbar.php'; ?> <!-- End of container -->

