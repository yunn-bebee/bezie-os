<!DOCTYPE html>
<html lang="en">
 <!-- #region -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css">
    <?php // Check if the success message cookie is set   
if (isset($_COOKIE['signup_error'])) {
    // Display the success message in an alert box
    $message = $_COOKIE['signup_error'];
    echo "<script>alert('$message');</script>";

    // Remove the cookie after displaying the message (optional)
    setcookie('signup_error', '', time() - 3600, '/');
}
?>
</head>
<body class="bg-indigo-400 h-screen font-sans">
    <div class="flex h-full flex-col">
    <?php  require_once 'src/views/admin/sidebar.php';?>
        <!-- Main Content -->
        <div class="flex-1 p-6">
      
            <h1 class="text-3xl font-semibold mb-6 text-yellow-200 text_shadow font"><img src="/src/assets/images/" alt="">Welcome, Admin</h1>
            <div class="w-11/12 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg black_border hover:scale-110 duration-100 font text-center ">
                    
                    <h2 class="text-xl font-semibold mb-4 font text-center"><i class="fas fa-users"></i> Total Users</h2>
                    <p class="text-gray-600 text-4xl font"><?php echo $totalUsers; ?></p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg black_border hover:scale-110 duration-100 font text-center ">
                    <h2 class="text-xl font-semibold mb-4 font">Total Lessons </h2>
                    <p class="text-gray-600 text-4xl font"><?php echo $totalLessons; ?></p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg black_border hover:scale-110 duration-100 font text-center ">
                    <h2 class="text-xl font-semibold mb-4 font">New Signups</h2>
                    <p class="text-gray-600 text-4xl font"><?php echo $newSignups; ?></p>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-2xl font-semibold mb-4">Recent Activity</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between">
                            <p>User John Doe signed up</p>
                            <span class="text-gray-500 text-sm">2 hours ago</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <p>User Jane Smith updated profile</p>
                            <span class="text-gray-500 text-sm">5 hours ago</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <p>User Admin added a new lesson</p>
                            <span class="text-gray-500 text-sm">1 day ago</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

     <div class=" flex mx-auto gap-10 pb-20 flex-wrap">

     <!-- Achievement Overview -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4 font text-center">Achievement Overview</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <ul class="divide-y divide-gray-200">
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Total Achievements</span>
                    <span class="text-gray-600">36</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">New Achievements Today</span>
                    <span class="text-gray-600">3</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Recently Unlocked</span>
                    <span class="text-gray-600">12</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contact Messages -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4 font text-center">Contact Messages</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <ul class="divide-y divide-gray-200">
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Total Messages</span>
                    <span class="text-gray-600">45</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Unread Messages</span>
                    <span class="text-gray-600">8</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Recently Received</span>
                    <span class="text-gray-600">5</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Settings Overview -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4 font text-center">Settings Overview</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <ul class="divide-y divide-gray-200">
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">API Integrations</span>
                    <span class="text-gray-600">Active</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Security Settings</span>
                    <span class="text-gray-600">Enabled</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Backup Settings</span>
                    <span class="text-gray-600">Weekly</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Reports -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4 font text-center ">Reports</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <ul class="divide-y divide-gray-200">
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">User Activity Report</span>
                    <span class="text-gray-600">View Report</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Lesson Completion Report</span>
                    <span class="text-gray-600">View Report</span>
                </li>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-semibold">Achievement Unlock Report</span>
                    <span class="text-gray-600">View Report</span>
                </li>
            </ul>
        </div>
    </div></div>
</div>   
</div>
</body>
</html>
