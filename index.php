<?php
// Start session
session_start();

require_once 'init.php';
// Include configuration
require_once 'database/config.php';
// Include necessary files

require_once 'route/web.php';
require_once 'src\controllers\homecontroller.php';

$homeController = new HomeController();

// Match current request URL against defined routes
$match = $router->match();

// Call method from appropriate controller based on matching route
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // Handle 404 - Not Found
    http_response_code(404);
    $homeController -> error();
}
?>


<script src="src/assets/js/script.js"></script>
<script src="src/assets/js/jquery.js"></script>
