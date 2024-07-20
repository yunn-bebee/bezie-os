

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezie-os</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
    <style>
        .clock-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .clock-time, .clock-date {
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .clock-time {
            font-weight: bold;
        }
        /* Custom styles for Windows 98 theme */
        body {
            font-family: 'Tahoma', sans-serif;
        }
        .taskbar {
            background: linear-gradient(to bottom, #BFBFBF, #F0F0F0);
            border-top: 2px solid #FFF;
            border-left: 2px solid #FFF;
            border-right: 2px solid #404040;
            border-bottom: 2px solid #404040;
        }
        .taskbar button, .icond {
            background-color: #E0E0E0;
            color: black;
            border: 2px solid #808080;
            border-left: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
            box-shadow: 4px 4px 1px rgb(0, 0, 0), inset 1px 1px 0 #ffffff, inset -1px -1px 0 #808080;
        }
        .taskbar button:active, .icond:active {
            border: 2px solid #808080;
            border-left: 2px solid #000000;
            border-top: 2px solid #000000;
            box-shadow: inset -1px -1px 0 #ffffff, inset 1px 1px 0 #000000;
        }
        .taskbar .fas {
            color: black;
        }
        .notification-dropdown {
            background-color: #E0E0E0;
            border: 2px solid #808080;
            border-left: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
            box-shadow: 1px 1px 0 #ffffff, -1px -1px 0 #808080;
            position: absolute;
            bottom: 100%;
            right: 0;
            width: 200px;
            max-height: 300px;
            overflow-y: auto;
            display: none; /* Hidden by default */
            z-index: 1000;
        }
        .notification-dropdown ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .notification-dropdown li {
            padding: 8px;
            border-bottom: 1px solid #808080;
        }
        .notification-dropdown li:last-child {
            border-bottom: none;
        }
        .notification-dropdown p {
            padding: 8px;
            text-align: center;
        }
        .notification-container:hover .notification-dropdown {
            display: block; /* Show dropdown on hover */
        }
        .mobile-menu {
            background-color: #C0C0C0;
            border: 2px solid #808080;
            border-left: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
            box-shadow: 1px 1px 0 #ffffff, -1px -1px 0 #808080;
        }
        .ic {
            background-color: #facc15 !important;
        }
        .mobile-menu li {
            background-color: #E0E0E0;
            color: black;
            border: 2px solid #808080;
            border-left: 2px solid #ffffff;
            border-top: 2px solid #ffffff;
            box-shadow: inset 1px 1px 0 #ffffff, inset -1px -1px 0 #808080;
        }
        .mobile-menu li:hover {
            background-color: #A0A0A0;
        }
        .mobile-menu a {
            color: black;
        }
    </style>
</head>
<body>
    <button id="fullscreenButton" class="icond p-1 px-2 rounded-md fixed bottom-20 right-0 font-semibold text-2xl mr-2">
        <i class="fa-solid fa-expand"></i>
    </button>

    <!-- Taskbar -->
    <div class="taskbar font-mono fixed bottom-0 w-screen shadow-inner flex items-center justify-between p-2">
        <div class="">
            <button class="px-2 ic py-1 rounded-full bg-yellow-400" onclick="openModal('shutdownModal')">
                <i class="fa fa-power-off"></i>
            </button>
            <button class="px-5 py-1 rounded-md mobile-menu" onclick="togglehidden('mobile-menu')">Menu</button>
        </div>
        <div class="flex items-center">
            <div id="clock" class="clock-container mr-4"></div>
            <div class="notification-container">
                <i class="fas fa-bell inline-block text-2xl font-extrabold"></i>
                <span class="notification-count">
                    <?php if (count($notifications) > 0): ?>
                        <?= count($notifications); ?>
                    <?php endif; ?>
                </span>
                <div class="notification-dropdown">
                    <?php if (count($notifications) > 0): ?>
                        <ul>
                            <?php foreach ($notifications as $notification): ?>
                                <li><?= htmlspecialchars($notification['message']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No notifications</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div id="shutdownModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-8 rounded-md black_border flex items-center flex-col absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="flex items-center flex-col">
                <!-- Profile Picture -->
                <img src="../../<?php echo htmlspecialchars($child['avatar']); ?>" alt="Avatar" class="w-16 h-16 rounded-full mr-4">
                <!-- Name -->
                <div>
                    <h4 class="text-2xl font-semibold text-center font"><?php echo htmlspecialchars($child['name']); ?></h4>
                </div>
                <p class="text-lg font-mono mb-4 text-gray-600">Leaving so soon? Come back later!</p>
            </div>
            <a href="/dashboard" id="confirmShutdown" class="mt-4 bg-yellow-400 text-black font black_border px-4 py-2 rounded-md mx-auto">Yes, shut down</a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="absolute left-2 bottom-14 hidden p-3 rounded-md z-50 duration-300 mobile-menu" id="mobile-menu">    
        <ul class="text-left">
            <!-- Additional links for the child dashboard -->
            <li class="px-12 py-2 my-1 shadow-inner rounded-md">
                <a href="/child/dashboard/<?php echo $childId; ?>" class="px-5 py-2 font-semibold">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="px-12 py-2 my-1 shadow-inner rounded-md">
                <a href="/child/dashboard/<?php echo $childId; ?>/lessons" class="px-5 py-2 font-semibold">
                    <i class="fas fa-book-open"></i> Lessons
                </a>
            </li>
            <li class="px-12 py-2 my-1 shadow-inner rounded-md">
                <a href="./achievements.html" class="px-5 py-2 font-semibold">
                    <i class="fas fa-trophy"></i> Achievements
                </a>
            </li>
            <li class="px-12 py-2 my-1 shadow-inner rounded-md">
                <a href="./tests.html" class="px-5 py-2 font-semibold">
                    <i class="fas fa-pencil-alt"></i> Tests
                </a>
            </li>
        </ul>  
    </div>

    <script src="src/assets/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = now.getFullYear();
                const timeString = `${hours}:${minutes}:${seconds}`;
                const dateString = `${day}/${month}/${year}`;
                document.getElementById('clock').innerHTML = `
                    <div class="clock-time">${timeString}</div>
                    <div class="clock-date">${dateString}</div>
                `;
            }

            function shutdown() {
                document.getElementById('shutdownModal').classList.remove('hidden');
            }

            document.getElementById('confirmShutdown').addEventListener('click', function() {
                alert("Shutting down...");
                setTimeout(function() {
                    alert("See you later! Exiting the website...");
                    window.close(); // Close the window
                }, 2000); // Delay for 2 seconds before exiting
            });

            function sleep() {
                alert("Entering sleep mode...");
                // Add your sleep logic here
            }

            setInterval(updateClock, 1000); // Update clock every second
            updateClock(); // Initial call to display clock immediately

            var fullscreenButton = document.getElementById('fullscreenButton');

            fullscreenButton.addEventListener('click', function () {
                if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
                    exitFullscreen();
                } else {
                    enterFullscreen();
                }
            });

            function enterFullscreen() {
                var element = document.documentElement; // Fullscreen the entire document
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.webkitRequestFullscreen) { /* Safari */
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) { /* IE11 */
                    element.msRequestFullscreen();
                }
            }

            function exitFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE11 */
                    document.msExitFullscreen();
                }
            }
        });   
    </script>
</body>
</html>
