<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaurdian</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
</head>

<body class="overflow-hidden w-screen h-screen bg-green-300">
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
  
  
  <?php require_once 'src\views\components\icons.php'; ?>
   

<div
    class="border border-black bg-orange-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
    <div class="border-gray-400 border-4">
        
    <?php $name = "Bee"; 
    require_once 'src\views\components\windowtab.php';?>

        <!-- Content Area with Overflow Scroll -->
        <div class="mt-[52px] h-screen overflow-y-scroll">
        <div class="w-11/12 mx-auto pt-10 pl-5  font text-4xl font-bold text-pink-400 text_shadow flex justify-between"> 
        <h1 >
                WELCOME Gaurdian
            </h1>
        <button class="font-bold text-shadow"> <i class="fas fa-gear"></i>
        </button>
        </div>
        <hr class="bg-">  
            <?php require_once 'src\views\user\components\addchild.php';
            require_once 'src/views/user/components/viewchild.php';
            require_once 'src/views/user/components/reviewmodel.php';
            ?>
            <section id="progress-reports" class="mt-20 font-mono">
        <h3 class="text-2xl font-semibold mb-4 text-center">Progress Reports</h3>
        <?php foreach ($groupedData as $childName => $progressList): ?>
            <div class="mb-10">
                <h3 class="text-xl font-semibold mb-4 text-center"><?php echo htmlspecialchars($childName); ?>'s Progress</h3>
                <?php foreach ($progressList as $progress): ?>
                    <?php 
                        $percentage = ($progress['lessons_completed'] / $progress['total_lessons']) * 100;
                        $barColor = match ($progress['subject_name']) {
                            'Math' => 'bg-blue-500',
                            'Science' => 'bg-green-500',
                            'English' => 'bg-yellow-500',
                            default => 'bg-gray-500',
                        };
                    ?>
                    <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border mb-6">
                        <h4 class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($progress['subject_name']); ?> Progress</h4>
                        <p class="text-gray-600 mb-4">Progress: <?php echo round($percentage); ?>%</p>
                        <div class="bg-gray-200 rounded-full h-2 mb-4">
                            <div class="<?php echo $barColor; ?> h-2 rounded-full" style="width: <?php echo round($percentage); ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </section>
        </div> <!-- End of overflow-y-scroll -->
    </div> <!-- End of border-gray-400 -->
</div> <!-- End of bg-yellow-200 -->

           
                  
 

<!-- Include custom scripts -->
<script src="../../assets/script.js"></script>
<?php require_once 'src\views\components\taskbar.php'; ?>
</body>
</html>
