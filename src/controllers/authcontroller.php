
<?php

require_once 'src/model/adminModel.php';

class AuthController {
    private $adminModel;

    public function __construct() {
        $conn = getDbConnection();
        $this->adminModel = new AdminModel($conn);
    }

    public function showLoginForm() {
        require 'src/views/admin/login.php';
    }

    public function  login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $admin = $this->adminModel->findByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['is_admin'] = true;
            header('Location: /admin/dashboard');
        } else {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['error'] = 'Invalid credentials';
            header('Location: /admin');
        }
    }

    public function logout() {
        session_start();
        unset($_SESSION['admin_id']);
        header('Location: /admin');
    }
    public function showSignupForm() {
        require 'src/views/admin/signup.php';
    }

    public function processSignup() {
        // Get the form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

              // Validate the form data
              if (empty($username) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: /admin/signup');
                exit;
            }
    
            // Check if the username or email already exists
            if ($this->adminModel->findByUsername($username)) {
                $_SESSION['error'] = 'Username already taken.';
                header('Location: /admin/signup');
                exit;
            }
    
            if ($this->adminModel->findByEmail($email)) {
                $_SESSION['error'] = 'Email already registered.';
                header('Location: /admin/signup');
                exit;
            }
    
            // Create the admin
            if ($this->adminModel->create($username, $email, $password)) {
                // Redirect to login page after successful signup
                header('Location: /admin/login');
            } else {
                $_SESSION['error'] = 'Signup failed. Please try again.';
                header('Location: /admin/signup');
            }
    
    }
}
?>
