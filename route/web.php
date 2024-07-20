<?php
require_once 'src/controllers/HomeController.php';
require_once 'src/controllers/ContactController.php';
require_once 'src/controllers/gaurdiancontroller.php';
require_once 'src/controllers/ChildController.php';
require_once 'src/controllers/admincontroller.php';
require_once 'src/controllers/authcontroller.php';
require_once 'src/middleware/adminmiddleware.php';
require_once 'src/middleware/gaurdianmiddleware.php';

// Create AltoRouter instance
$router = new AltoRouter();

// Create instance of HomeController and ContactController
$homeController = new HomeController();
$contactController = new ContactController();
$guardianController = new GuardianController();
$childController = new ChildController();
$adminController = new AdminController();
$authController = new AuthController();

// Middleware function to check admin authentication
$adminMiddleware = function() {
    if (!AdminMiddleware::isAdminAuthenticated()) {
        header('Location: /admin/login'); // Redirect if not authenticated as admin
        exit;
    }
};

// Middleware function to check guardian authentication
$guardianMiddleware = function() {
    if (!GuardianMiddleware::isGuardianAuthenticated()) {
        header('Location: /login'); // Redirect if not authenticated as guardian
        exit;
    }
};
 
// Define routes using HomeController and ContactController methods
$router->map('GET', '/', [$homeController, 'index']);
$router->map('GET', '/about', [$homeController, 'about']);
$router->map('GET', '/contact', [$homeController, 'contact']);
$router->map('GET', '/gameintro', [$homeController, 'gameintro']);
$router->map('GET', '/gallery', [$homeController, 'gallery']);
$router->map('GET', '/login', [$homeController, 'login']);
$router->map('GET', '/signup', [$homeController, 'signup']);
$router->map('POST', '/contact/submit', [$contactController, 'submit']);
$router->map('POST', '/signup', [$guardianController, 'processSignup']);
$router->map('POST', '/login', [$guardianController, 'processLogin']);
$router->map('GET', '/h', [$homeController, 'h']);
$router->map('POST', '/child/add', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->addChild(); 
});

$router->map('POST', '/child/update', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->updateChildProfile(); 
});

$router->map('POST', '/child/verify_security_answer', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->verifySecurityAnswer(); 
});
$router->map('POST', '/submit_guardian_review', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->submitReview(); 
});
$router->map('GET', '/dashboard', function() use ($guardianController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $guardianController->dashboard();
});
$router->map('GET', '/child/dashboard/[i:id]', function($id) use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->childdashboard($id);
});
$router->map('GET', '/child/getnotification/[i:id]', function($id) use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->getNotification($id);
});
$router->map('GET', '/child/dashboard/[i:id]/lessons', function($id) use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->showLessons($id);
});
$router->map('GET', '/child/dictionary', function() use ($homeController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $homeController->showDictionaryPage();
});
$router->map('GET', '/child/dashboard/[i:id]/lesson/[i:lid]', function($id, $lid) use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->lessondetail($lid,$id);
});
$router->map('POST', '/child/dashboard/[i:id]/lesson/[i:lid]/complete', function($id, $lid) use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->markLessonAsCompleted($id,$lid);
});
$router->map('POST', '/child/set_security_answer', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->setSecurityAnswer(); 
});


$router->map('GET', '/child/profiles', function() use ($childController, $guardianMiddleware) {
    $guardianMiddleware(); // Apply guardian middleware
    $childController->viewChild();
});


$router->map('GET', '/logout', [$guardianController, 'logout']);


// Admin

$router->map('GET', '/admin', [$authController, 'showLoginForm']);
$router->map('GET', '/admin/login', [$authController, 'showLoginForm']);
$router->map('GET', '/admin/logout', [$authController, 'logout']);
$router->map('POST', '/admin/login', [$authController, 'login']);
$router->map('GET', '/admin/signup', [$authController, 'showSignupForm']);
$router->map('POST', '/admin/signup', [$authController, 'processSignup']);
$router->map('GET', '/admin/dashboard', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->dashboard();
});

$router->map('GET', '/admin/users', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->users();
});

$router->map('GET', '/admin/lessons', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->lessonDashboard();
});
$router->map('POST', '/admin/addlesson', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->addLesson();
});
$router->map('POST', '/admin/updatelesson', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->updateLesson();
});
$router->map('GET', '/admin/contacts', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->contactMessages();
});
$router->map('GET', '/admin/achievements', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->achievements();
});
$router->map('POST', '/admin/achievements/add', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->addAchievement();
});
$router->map('POST', '/admin/achievements/edit', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->updateAchievement();
});
$router->map('POST', '/admin/achievements/delete/[i:id]', function($id) use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware if needed
    $adminController->deleteAchievement($id);
});
$router->map('GET', '/admin/lessons/delete/[i:id]', function($id) use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->deleteLesson($id);
});
$router->map('GET', '/admin/messages/delete/[i:id]', function($id) use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->deleteContactMessage($id);
});

$router->map('GET', '/admin/tests', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->testDashboard();
});
$router->map('POST', '/admin/add-test', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->addTest();
});
$router->map('POST', '/admin/add-question', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->addQuestion();
});
$router->map('POST', '/admin/add-answer', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->addAnswer();
});
$router->map('POST', '/admin/edit-question', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->editQuestion();
});
$router->map('POST', '/admin/delete-question', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->deleteQuestion();
});
$router->map('POST', '/admin/edit-answer', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->editAnswer();
});
$router->map('POST', '/admin/delete-answer', function() use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->deleteAnswer();
});
$router->map('GET', '/admin/test-details/[i:id]', function($id) use ($adminController, $adminMiddleware) {
    $adminMiddleware(); // Apply middleware
    $adminController->showTestDetails($id);
});