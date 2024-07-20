<?php
require_once 'src/controllers/admincontroller.php';



$adminController = new AdminController();

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 12;

$achievements = $adminController->getAllAchievements($page, $limit);
$totalAchievements = $adminController->getTotalAchievementsCount();
$totalPages = ceil($totalAchievements / $limit);

// Handle form submissions for add, edit, and delete operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $adminController->addAchievement($_POST['title'], $_POST['description'], $_POST['badge_picture_url']);
    } elseif (isset($_POST['edit'])) {
        $adminController->updateAchievement($_POST['id'], $_POST['title'], $_POST['description'], $_POST['badge_picture_url']);
    } elseif (isset($_POST['delete'])) {
        $adminController->deleteAchievement($_POST['id']);
    }
    header('Location: achievements.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css">
</head>

<body class="bg-indigo-400 h-screen font-sans">
    <!-- Sidebar and main content -->
    <div class="flex h-full">
        <!-- Sidebar -->
        <?php require_once 'src/views/admin/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Page Title and Add Achievement Button -->
            <div class="flex items-center justify-between w-full">
                <h1 class="text-3xl font-semibold mb-6 text-yellow-200 text_shadow font"><i class="fas fa-trophy"></i>
                    All Achievements</h1>
                <button type="button" onclick="openModal('addAchievementModal')"
                    class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Add Achievement</button>
            </div>
            <br>
            <hr>

            <!-- Showing Achievements and Pagination -->
            <div class="mt-4 mb-6">
                <h2 class="text-xl text-white font-mono">Showing <?php echo count($achievements); ?> achievements</h2>
                <p class="text-gray-200"><?php echo $totalAchievements; ?> results</p>
            </div>

            <!-- Achievements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <?php foreach ($achievements as $achievement): ?>
                    <!-- Achievement Card -->
                    <div class="bg-white p-4 rounded-md black_border">
                        <h3 class="text-xl font-bold"><?php echo htmlspecialchars($achievement['title']); ?></h3>
                        <p><?php echo htmlspecialchars($achievement['description']); ?></p>
                        <img src="<?php echo htmlspecialchars($achievement['badge_picture_url']); ?>" alt="Badge"
                            class="mt-2 w-16 h-16">
                        <div class="mt-4 flex justify-between">
                            <!-- Edit Button -->
                            <button type="button"
                                onclick="openModal('editAchievementModal-<?php echo $achievement['id']; ?>')"
                                class="bg-yellow-500 text-black px-4 py-2 rounded black_border">Edit</button>
                            <!-- Delete Form -->
                            <form action="/admin/achievements/delete/<?php echo $achievement['id']; ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $achievement['id']; ?>">
                                <button type="submit" name="delete"
                                    class="bg-red-500 text-white px-4 py-2 rounded black_border">Delete</button>
                            </form>

                        </div>
                    </div>
                    <!-- Edit Achievement Modal -->
                    <?php require "src/views/admin/components/editachievement.php"; ?>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Controls -->
            <div class="mx-auto w-1/3 max-md:w-2/3 max-sm:w-full pb-20 flex items-center">
                <?php if ($page > 1): ?>
                    <a href="?page=1"
                        class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">First</a>
                    <a href="?page=<?php echo $page - 1; ?>"
                        class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Previous</a>
                <?php endif; ?>

                <span class="mx-2 font">Page <input type="number" min="1" max="<?php echo $totalPages; ?>"
                        value="<?php echo htmlspecialchars($page); ?>" class="w-16 text-center border rounded"
                        onchange="goToPage(this.value);" /> of <?php echo $totalPages; ?></span>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>"
                        class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Next</a>
                    <a href="?page=<?php echo $totalPages; ?>"
                        class="px-4 py-2 font-extrabold mx-2 my-3 bg-yellow-200 black_border font text-gray-700 rounded">Last</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Add Achievement Modal -->
     <?php require "src/views/admin/components/addachievement.php"; ?>
     <script src="../src/assets/js/script.js"></script>
</body>

</html>