<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Lessons</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/src/assets/css/style.css">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

</head>

<body class="overflow-hidden w-screen h-screen bg-sky-300">
    <?php
    // Check if the success message cookie is set
    if (isset($_COOKIE['signup_error'])) {
        // Display the success message in an alert box
        $message = $_COOKIE['signup_error'];
        echo "<script>alert('$message');</script>";

        // Remove the cookie after displaying the message (optional)
        setcookie('signup_error', '', time() - 3600, '/');
    }
    ?>
    <?php require_once 'src\views\user\child\components\icons.php'; ?>

    <div
        class="border border_black  bg-yellow-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
        <div class="border-zinc-400 border-4">
            <?php $name = $child['name']; ?>
            <?php require 'src\views\components\windowtab.php'; ?>

            <!-- Content Area with Overflow Scroll -->
            <div class="mt-[52px]  pt-10 overflow-y-scroll h-[80vh] w-full">
                <!-- Header -->
                <div class=" max-w-5xl mx-auto flex justify-between items-center">
                    <h1 class="text-3xl  font-bold text-pink-500 text_shadow mb-6 font"> Hello
                        <?php echo $child['name']; ?>
                    </h1>
                    <h4 class="">recent lessons</h4>
                </div>

                <?php if (!empty($mostRecentLessons)):

                    $maxLessons = min(count($mostRecentLessons), 3); // Get up to 3 lessons
                    ?>

                    <div class="max-w-5xl mx-auto">
                        <div id="default-carousel" class="relative rounded-lg overflow-hidden black_border"
                            data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-80 md:h-96" data-carousel-inner>
                                <?php for ($i = 0; $i < $maxLessons; $i++): ?>
                                    <div class="duration-700 ease-in-out <?= $i === 0 ? 'block' : 'hidden' ?>" data-carousel-item>
                                        <img src="<?= htmlspecialchars($mostRecentLessons[$i]['thumbnail_url']) ?>"
                                            class="object-cover w-full h-full"
                                            alt="<?= htmlspecialchars($mostRecentLessons[$i]['title']) ?>">
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center bg-white bg-opacity-50">
                                            <h2 class="text-2xl font-bold text-black font md:text-2xl">
                                                <?= htmlspecialchars($mostRecentLessons[$i]['title']) ?>
                                            </h2>
                                            <a class="mt-4 px-4 py-2 bg-pink-500 text-white rounded-md font hover:bg-pink-600 black_border"
                                                href="/child/dashboard/<?php echo $childId; ?>/lesson/<?= htmlspecialchars($mostRecentLessons[$i]['id']) ?> ">
                                                Continue Lesson
                                            </a>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <!-- Slider indicators -->
                            <div class="flex absolute bottom-5 left-1/2 z-30 -translate-x-1/2 space-x-2"
                                data-carousel-indicators>
                                <?php for ($i = 0; $i < $maxLessons; $i++): ?>
                                    <button type="button"
                                        class="w-3 h-3 rounded-full bg-gray-700 hover:bg-gray-900 focus:outline-none focus:bg-gray-400 transition"
                                        aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"
                                        data-carousel-slide-to="<?= $i ?>"></button>
                                <?php endfor; ?>
                            </div>
                            <!-- Slider controls -->
                            <button type="button"
                                class="flex absolute top-1/2 left-3 z-40 items-center justify-center w-10 h-10 bg-yellow-300/50 rounded-md black_border hover:bg-yellow-300 focus:outline-none transition"
                                data-carousel-prev>
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button type="button"
                                class="flex absolute top-1/2 right-3 z-40 items-center justify-center w-10 h-10 bg-yellow-300/50 rounded-md black_border hover:bg-yellow-300 focus:outline-none transition"
                                data-carousel-next>
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>


                        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
                    </div>

                <?php endif; ?>


                <!-- Subject Buttons -->
                <div class="subject-buttons flex justify-center mt-8 mb-4">
                    <?php foreach ($subjects as $subject): ?>
                        <button
                            class="subject-button bg-purple-500 hover:bg-purple-700 font black_border text-white font-bold py-2 px-4 rounded-lg mr-4"
                            data-subject-id="<?= $subject['id'] ?>">
                            <?= htmlspecialchars($subject['name']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Dynamic Subject Heading -->
                <h2 id="subject-heading" class="text-2xl font-bold text-center mb-6"></h2>

                <!-- Container for Lessons -->
                <div class="h-full w-full mx-auto mb-20 flex flex-wrap justify-center">
                    <!-- Lessons by Subject -->
                    <?php foreach ($subjects as $subject): ?>
                        <div class="lessons-by-subject" data-subject-id="<?= $subject['id'] ?>">
                            <?php foreach ($lessons as $lesson): ?>
                                <?php if ($lesson['subject_id'] == $subject['id']): ?>
                                    <?php
                                    // Check if the lesson has a start_time (indicating it has been started)
                                    $isInProgress = isset($lesson['start_time']);
                                    $isLocked = $isInProgress ? '' : 'locked';
                                    ?>
                                    <div class="lesson-card bg-white p-6 rounded-lg mb-4 black_border <?= $isLocked ?>">
                                        <div class="relative h-64 w-full flex items-end justify-start text-left bg-cover bg-center"
                                            style="background-image: url('<?= htmlspecialchars($lesson['thumbnail_url']) ?>');">
                                            <div
                                                class="absolute top-0 mt-20 right-0 bottom-0 left-0 bg-gradient-to-b from-transparent to-gray-900">
                                            </div>
                                            <div class="absolute top-0 right-0 left-0 mx-5 mt-2 flex justify-between items-center">
                                                <a href="#"
                                                    class="text-xs bg-indigo-600 text-white px-5 py-2 uppercase hover:bg-white hover:text-indigo-600 transition ease-in-out duration-500"><?= htmlspecialchars($lesson['subject_name']) ?></a>
                                            </div>
                                            <main class="p-5 z-10">
                                                <a href="#"
                                                    class="text-md tracking-tight font-medium leading-7 font-regular text-white hover:underline"><?= htmlspecialchars($lesson['title']) ?></a>
                                            </main>
                                        </div>
                                        <p class="text-gray-600 mt-4"><?= htmlspecialchars($lesson['description']) ?></p>
                                        <p class="text-gray-700 mt-2"><strong>Level:</strong>
                                            <?= htmlspecialchars($lesson['level_name']) ?></p>
                                        <p class="text-gray-700"><strong>Duration:</strong>
                                            <?= gmdate("H:i:s", $lesson['duration']) ?></p>
                                        <div class="flex justify-between mt-4">
                                            <?php if ($isInProgress): ?>
                                                <a type="button"
                                                    class="bg-purple-500 border-l-gray-200 border-t-white border hover:bg-indigo-900 text-white font-bold rounded-md py-2 px-4 font black_border"
                                                    href="/child/dashboard/<?php echo $childId; ?>/lesson/<?= htmlspecialchars($lesson['id']) ?> ">Continue</a>
                                            <?php else: ?>
                                                <button type="button"
                                                    class="bg-gray-400 text-gray-700 font-bold rounded-md py-2 px-4 font black_border pointer"
                                                    onclick="openModal('lockedForm')">Locked</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="p-20">end of lesson</div>
            </div> <!-- End of container -->

        </div> <!-- End of border-gray-400 -->
    </div> <!-- End of bg-yellow-200 -->

    <!-- Include custom scripts -->
    <script src="/src/assets/js/script.js"></script>
    <script src="/src/assets/js/lessonfilter.js"></script>

    <?php require 'src\views\user\child\components\taskbar.php'; ?>
    <?php require 'src\views\user\child\components\lockedpopup.php'; ?>

    <script>    // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Get all subject buttons
            const subjectButtons = document.querySelectorAll('.subject-button');

            // Get all lessons grouped by subject IDs
            const lessonsBySubject = document.querySelectorAll('.lessons-by-subject');

            // Get the subject heading element
            const subjectHeading = document.getElementById('subject-heading');

            // Function to show lessons based on selected subject
            function showLessons(subjectId) {
                // Hide all lessons
                lessonsBySubject.forEach(function (lessons) {
                    lessons.classList.remove('active');
                    lessons.classList.add('hidden');
                });

                // Show lessons for the selected subject
                const selectedLessons = document.querySelector(`.lessons-by-subject[data-subject-id="${subjectId}"]`);
                if (selectedLessons) {
                    selectedLessons.classList.add('active');
                    selectedLessons.classList.remove('hidden');
                }

                // Update the subject heading
                const selectedSubjectButton = document.querySelector(`.subject-button[data-subject-id="${subjectId}"]`);
                if (selectedSubjectButton) {
                    subjectHeading.textContent = selectedSubjectButton.textContent + " Lessons";
                } else {
                    subjectHeading.textContent = "";
                }
            }

            // Add click event listeners to subject buttons
            subjectButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const subjectId = button.getAttribute('data-subject-id');
                    showLessons(subjectId);
                });
            });

        });



    </script>

</body>

</html>