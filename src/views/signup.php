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

// Check if there are validation errors
$errors = [];
if (isset($_COOKIE['signup_errors'])) {
    $errors = json_decode($_COOKIE['signup_errors'], true);
    setcookie('signup_errors', '', time() - 3600, '/'); // Clear the cookie
}
?>

<body class="overflow-hidden bg-sky-300 h-screen">
    <div class="flex space-between items-center">
        <!-- Left: Image -->
        <div class="w-1/5 h-screen hidden md:block ">
            <img src="src/assets/c2/3.png" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>
        <!-- Right: Register Form -->
        <div class="lg:p-28 md:p-28 font-mono sm:20 p-8 w-full lg:w-4/5">
            <h1 class="text-2xl font-semibold mb-4 text-center font text-pink-400 text_shadow">Adventure awaits, Parent</h1>
            <form action="/signup" method="POST" id="signupForm">
                <!-- First Name and Last Name Inputs -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="first_name" class="block text-pink-900 text-md">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                        <?php if (isset($errors['first_name'])): ?>
                            <p class="text-red-500 text-sm"><?php echo $errors['first_name']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="w-1/2">
                        <label for="last_name" class="block text-pink-900 text-md">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                        <?php if (isset($errors['last_name'])): ?>
                            <p class="text-red-500 text-sm"><?php echo $errors['last_name']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-pink-900 text-md">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                    <?php if (isset($errors['email'])): ?>
                        <p class="text-red-500 text-sm"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-pink-900 text-md">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                    <?php if (isset($errors['password'])): ?>
                        <p class="text-red-500 text-sm"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Confirm Password Input -->
                <div class="mb-4">
                    <label for="confirm_password" class="block text-pink-900 text-md">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                    <?php if (isset($errors['confirm_password'])): ?>
                        <p class="text-red-500 text-sm"><?php echo $errors['confirm_password']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Date of Birth Input -->
                <div class="mb-4">
                    <label for="date_of_birth" class="block text-pink-900 text-md">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none black_border focus:border-blue-500" autocomplete="off">
                    <?php if (isset($errors['date_of_birth'])): ?>
                        <p class="text-red-500 text-sm"><?php echo $errors['date_of_birth']; ?></p>
                    <?php endif; ?>
                    <small class="block text-gray-600">This is needed to confirm the guardian's age.</small>
                </div>
                <!-- Terms and Conditions Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="agreeterms" name="agreeterms" class="text-blue-500">
                    <label for="agreeterms" class="text-gray-600 ml-2">I agree with the terms and conditions</label>
                    <?php if (isset($errors['agreeterms'])): ?>
                        <p class="text-red-500 text-sm"><?php echo $errors['agreeterms']; ?></p>
                    <?php endif; ?>
                </div>
                <!-- Signup Button -->
                <button class="bg-white hover:bg-gray-200 focus:outline-none text-black black_border font-bold py-2 px-4 rounded" type="submit">Sign up</button>
            </form>
            <!-- Sign up Link -->
            <div class="mt-6 text-blue-500 text-center">
                <a href="/login" class="hover:underline link">Or login here</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formDataKey = 'formData';
            const expirationKey = 'formDataExpiration';

            // Restore form data from localStorage if it is still valid
            const expirationTime = localStorage.getItem(expirationKey);
            if (expirationTime && new Date().getTime() < expirationTime) {
                const formData = JSON.parse(localStorage.getItem(formDataKey));
                if (formData) {
                    document.getElementById('first_name').value = formData.first_name || '';
                    document.getElementById('last_name').value = formData.last_name || '';
                    document.getElementById('email').value = formData.email || '';
                    document.getElementById('password').value = formData.password || '';
                    document.getElementById('confirm_password').value = formData.confirm_password || '';
                    document.getElementById('date_of_birth').value = formData.date_of_birth || '';
                    document.getElementById('agreeterms').checked = formData.agreeterms || false;
                }
            } else {
                // Clear the expired data
                localStorage.removeItem(formDataKey);
                localStorage.removeItem(expirationKey);
            }

            // Save form data to localStorage on input changes
            document.querySelector('form').addEventListener('input', function() {
                const formData = {
                    first_name: document.getElementById('first_name').value,
                    last_name: document.getElementById('last_name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    confirm_password: document.getElementById('confirm_password').value,
                    date_of_birth: document.getElementById('date_of_birth').value,
                    agreeterms: document.getElementById('agreeterms').checked
                };
                localStorage.setItem(formDataKey, JSON.stringify(formData));

                // Set expiration time for 15 minutes from now
                const expiration = new Date().getTime() + 15 * 60 * 1000; // 15 minutes
                localStorage.setItem(expirationKey, expiration);
            });

           
        });
    </script>
</body>
</html>
