<?php 
require_once 'src/controllers/admincontroller.php';
$adminController = new AdminController(); 

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$subjectFilter = isset($_GET['subject']) ? $_GET['subject'] : '';
$levelFilter = isset($_GET['level']) ? $_GET['level'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$lessons = $adminController->getAllLessons($page, $limit);
$subjects = $adminController->getAllSubjects();
$levels = $adminController->getAllLevels();
$totalLessons = $adminController->getTotalLessonsCount($subjectFilter, $levelFilter, $searchQuery);
$totalPages = ceil($totalLessons / $limit);

// Check if the success message cookie is set
if (isset($_COOKIE['signup_error'])) {
    $message = $_COOKIE['signup_error'];
    echo "<script>alert('$message');</script>";
    setcookie('signup_error', '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessons Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css">
</head>
<body class="bg-indigo-400 h-screen font-sans">
    <div class="flex h-full">
        <?php require_once 'src/views/admin/sidebar.php'; ?>
        <div class="flex-1 p-6">
            <div class="flex items-center justify-between w-full">
                <h1 class="text-3xl font-semibold mb-6 text-yellow-200 text_shadow font"><i class="fas fa-book"></i> All Lessons</h1>
                <button type="button" onclick="openModal('addLessonModal')" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Add lessons</button>
            </div>
            <br>
            <hr>
            <div class="mt-4 mb-6">
                <form method="GET" action="">
                    <div class="flex space-x-4 flex-wrap max-sm:justify-between">
                        <div class="max-sm:w-3/6">
                            <label for="subjectFilter" class="block text-gray-200 font-mono">Filter by Subject:</label>
                            <select id="subjectFilter" name="subject" class="border rounded p-2 font w-full">
                                <option value="">All Subjects</option>
                                <?php foreach ($subjects as $subject): ?>
                                    <option value="<?php echo htmlspecialchars($subject['id']); ?>" <?php if ($subjectFilter == $subject['id']) echo 'selected'; ?>><?php echo htmlspecialchars($subject['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="max-sm:w-2/6">
                            <label for="levelFilter" class="block text-gray-200 font-mono">Filter by Level:</label>
                            <select id="levelFilter" name="level" class="border rounded p-2 font w-full">
                                <option value="">All Levels</option>
                                <?php foreach ($levels as $level): ?>
                                    <option value="<?php echo htmlspecialchars($level['id']); ?>" <?php if ($levelFilter == $level['id']) echo 'selected'; ?>><?php echo htmlspecialchars($level['level_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex-grow">
                            <label for="search" class="block text-gray-200 font-mono">Search:</label>
                            <input type="text" id="search" name="search" class="border rounded p-2 w-full font" placeholder="Search for lessons..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-yellow-500 font text-black px-4 py-2 rounded black_border">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <h2 class="text-xl text-white font-mono">
                    Showing <?php echo count($lessons); ?> lessons 
                    <?php if (!empty($subjectFilter)): ?> filtered by Subject: <?php echo htmlspecialchars($subjects[array_search($subjectFilter, array_column($subjects, 'id'))]['name']); ?><?php endif; ?>
                    <?php if (!empty($levelFilter)): ?> filtered by Level: <?php echo htmlspecialchars($levels[array_search($levelFilter, array_column($levels, 'id'))]['level_name']); ?><?php endif; ?>
                    <?php if (!empty($searchQuery)): ?> filtered by Search: <?php echo htmlspecialchars($searchQuery); ?><?php endif; ?>
                </h2>
                <p class="text-gray-200"><?php echo $totalLessons; ?> results</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <?php foreach ($lessons as $lesson): ?>
                    <?php require "src/views/admin/components/lessoncard.php"; ?>
                    <?php require "src/views/admin/editLesson.php"; ?>
                <?php endforeach; ?>
            </div>
            <div class="mx-auto w-1/3 max-md:w-2/3 max-sm:w-full pb-20 flex items-center">
                <?php if ($page > 1): ?>
                    <a href="?page=1<?php echo $adminController->buildQueryString($subjectFilter, $levelFilter, $searchQuery); ?>" class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">First</a>
                    <a href="?page=<?php echo $page - 1; ?><?php echo $adminController->buildQueryString($subjectFilter, $levelFilter, $searchQuery); ?>" class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Previous</a>
                <?php endif; ?>

                <span class="mx-2 font">Page <input type="number" min="1" max="<?php echo $totalPages; ?>" value="<?php echo htmlspecialchars($page); ?>" class="w-16 text-center border rounded" onchange="goToPage(this.value);" /> of <?php echo $totalPages; ?></span>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?><?php echo $adminController->buildQueryString($subjectFilter, $levelFilter, $searchQuery); ?>" class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Next</a>
                    <a href="?page=<?php echo $totalPages; ?><?php echo $adminController->buildQueryString($subjectFilter, $levelFilter, $searchQuery); ?>" class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Last</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
    function goToPage(page) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('page', page);
        // Set other parameters like subject, level, and search if needed
        window.location.search = urlParams.toString();
    }
</script>

    <?php require "src/views/admin/addLesson.php"; ?>
</body>
</html>
