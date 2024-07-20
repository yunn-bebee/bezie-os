<!-- views/admin/signup.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="shortcut icon" href="/src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/src/assets/css/style.css">
</head>
<body class="overflow-hidden bg-sky-300 h-screen">

    <div class="flex items-center">
        <!-- Left: Image -->
        <div class="w-1/5 h-screen hidden md:block">
            <img src="/src/assets/c2/3.png" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>
        <!-- Right: Signup Form -->
        <div class="lg:p-28 md:p-28 font-mono p-8 w-full lg:w-4/5">
            <h1 class="text-2xl font-semibold mb-4 text-center text-pink-400 text_shadow">Admin Signup</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>
            <form action="/admin/signup" method="POST">
                <!-- Username Input -->
                <div class="mb-4">
                    <label for="username" class="block text-pink-900 text-md">Username</label>
                    <input type="text" id="username" name="username" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" required>
                </div>
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
                <!-- Signup Button -->
                <button class="bg-white hover:bg-gray-200 focus:outline-none text-black black_border font-bold py-2 px-4 rounded" type="submit">Sign Up</button>
            </form>
            <!-- Link to Admin Login -->
            <div class="mt-6 text-blue-500 text-center">
                <a href="/admin/login" class="hover:underline link">Or login here</a>
            </div>
        </div>
    </div>

    <div class="window" id="loading-spinner">
        <div class="logo">
            <img src="/src/assets/c/logo.png" alt="">
        </div>
        <div class="container">
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
        </div>
    </div>

    <script src="/src/assets/js/loading.js"></script>
</body>
</html>
