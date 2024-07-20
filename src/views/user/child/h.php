<?php

// Example usage
$guardianId = 4; // replace with the actual guardian ID

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .progress-bar {
            background-color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Lesson Progress for Guardian</h2>
        <div id="progress-container">
            <?php if (!empty($progressData)): ?>
                <?php foreach ($progressData as $progress): ?>
                    <?php 
                        $percentage = ($progress['lessons_completed'] / $progress['total_lessons']) * 100;
                    ?>
                    <div class="mb-4">
                        <h5 class="text-lg font-semibold"><?php echo htmlspecialchars($progress['child_name']); ?> - <?php echo htmlspecialchars($progress['subject_name']); ?></h5>
                        <div class="relative w-full bg-gray-200 rounded h-8">
                            <div class="absolute top-0 left-0 h-full rounded progress-bar" style="width: <?php echo $percentage; ?>%"></div>
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white"><?php echo $progress['lessons_completed']; ?> / <?php echo $progress['total_lessons']; ?> lessons</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No progress data available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>