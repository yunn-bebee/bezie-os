<?php
 include 'src\model\gaurdianmodel.php';
class GuardianController
{

   
    public function processSignup()
    {
        require_once 'src\model\gaurdianmodel.php';
    
        // Validate and sanitize form data
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING) ?? '';
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING) ?? '';
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        $agreeterms = $_POST['agreeterms'] ?? '';
    
        // Additional validation: Check if date of birth is provided and guardian is older than 18
        if (empty($date_of_birth) || $this -> calculateAge($date_of_birth) < 18) {
            setcookie('signup_error', 'You must be at least 18 years old to register', time() + 3600, '/');
            header('Location: /signup');
            exit;
        }
    
        if ($agreeterms == ''){
            // Set an error cookie for terms agreement
            setcookie('signup_error', 'Please agree to the terms and conditions', time() + 3600, '/'); // 1 hour expiry
            header('Location: /signup');
            exit; 
        }
    
        // Check if passwords match
        if ($password !== $confirm_password) {
            // Set an error cookie for password mismatch
            setcookie('signup_error', 'Passwords do not match', time() + 3600, '/'); // 1 hour expiry
            header('Location: /signup');
            exit;
        }
    
        // Connect to the database
        $conn = getDbConnection();
        $guardianModel = new GuardianModel($conn);
    
        // Check if email is already taken
        if ($guardianModel->isEmailTaken($email)) {
            // Set an error cookie for email already taken
            setcookie('signup_error', 'Email is already taken', time() + 3600, '/');
            header('Location: /signup');
            exit;
        }
    
        // Save guardian data
        $success = $guardianModel->saveGuardian($first_name, $last_name, $email, $password, $date_of_birth);
    
        if ($success) {
            setcookie('signup_error', 'Registered successfully', time() + 3600, '/');
            header('Location: /login');
            exit;
        } else {
            // Set a generic error cookie
            setcookie('signup_error', 'Failed to register guardian', time() + 3600, '/');
            header('Location: /signup');
            exit;
        }
    }
    
    // Function to calculate age based on date of birth
   private function calculateAge($date_of_birth) {
        $dob = new DateTime($date_of_birth);
        $now = new DateTime();
        $age = $now->diff($dob);
        return $age->y;
    }
    public function processLogin()
    {
        require_once 'src\model\gaurdianmodel.php';

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']) ? true : false;
        $conn = getDbConnection();

        $guardianModel = new GuardianModel($conn);

        $guardian = $guardianModel->getGuardianByEmail($email);

        if ($guardian && password_verify($password, $guardian['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['guardian_id'] = $guardian['id'];
            $_SESSION['guardian_email'] = $guardian['email'];
            $_SESSION['guardian_firstname'] = $guardian['first_name'];
            $_SESSION['guardian_lastname'] = $guardian['last_name']; 
              // Handle "Remember Me" functionality
              if ($remember) {
                // Generate a random token
                $token = bin2hex(random_bytes(16));
                $guardianModel->setRememberToken($guardian['id'], $token);

                // Set the remember me cookie (expires in 30 days)
                setcookie('remember_me', $token, time() + (86400 * 30), "/");
            }
            // Redirect to dashboard or home page
            header('Location: /dashboard');
            exit;
        } else {
            setcookie('signup_error', 'Email and password do not match', time() + 3600, '/'); // 1 hour expiry
             
            // Redirect back to login with error
            header('Location: /login');
            exit;
        }
    }
     // Method to auto-login with "Remember Me" cookie
     public function autoLogin() {
        if (isset($_SESSION['guardian_id'])) {
            header('Location: /dashboard');
            exit;
        }

        if (isset($_COOKIE['remember_me'])) {
            require_once 'src\model\gaurdianmodel.php';

            $token = $_COOKIE['remember_me'];
            $conn = getDbConnection();
            $guardianModel = new GuardianModel($conn);
            $guardian = $guardianModel->getGuardianByRememberToken($token);

            if ($guardian) {
                $_SESSION['guardian_id'] = $guardian['id'];
                $_SESSION['guardian_firstname'] = $guardian['first_name'];
                $_SESSION['guardian_lastname'] = $guardian['last_name'];
                setcookie('signup_error', 'Logged in successfully', time() + 3600, '/'); // 1 hour expiry
                header('Location: /dashboard');
                exit;
            }
        }

        // No valid session or cookie, stay on the login page
    }
    public function logout()
    {
        // Clear session data
        session_start();
        session_unset();
        session_destroy();

        // Clear the remember me cookie
        if (isset($_COOKIE['remember_me'])) {
            setcookie('remember_me', '', time() - 3600, '/'); // Expire the cookie
        }

        // Redirect to the login page or homepage
        header('Location: /login');
        exit;
    }

public function dashboard(){
    $conn = getDbConnection();
     $guardianId = $_SESSION['guardian_id'];
    $guardianModel = new GuardianModel($conn);
    $progressData =  $guardianModel ->  getLessonProgress($guardianId);
    $groupedData = [];
foreach ($progressData as $progress) {
    $groupedData[$progress['child_name']][] = $progress;
}
    require 'src/views/user/dashboard.php';
}

}