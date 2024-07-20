<?php
// Middleware.php

class AdminMiddleware {
    
    // Function to check if the user is authenticated as admin
    public static function isAdminAuthenticated() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
         if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            return true;
        }
        return false;
    }
}
?>
