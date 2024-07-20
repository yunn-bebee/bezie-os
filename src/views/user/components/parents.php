

<div
    class="border border-black bg-yellow-200 font-mono top-5 overflow-hidden h-[88%] max-sm:w-[78%] lg:w-[90%] max-lg:w-[86%] absolute right-5 rounded-md black_border">
    <div class="border-gray-400 border-4">
        <!-- Toolbar with maximize, minimize, close buttons -->
        <div class="bg-gray-400 fixed top-6 max-sm:w-[78%] lg:w-[89.5%] max-lg:w-[84%] border-r-black pb-6 min-h-3 px-1 py-2 flex items-center justify-between"
            style="border-bottom: 3px solid black; box-shadow: 1px 1px 5px 5px rgba(0, 0, 0, 0.066);">
            <div class="name text-large font-extrabold font flex items-center justify-center ">
                <img src="src/assets/c/logofull.png" class="w-full h-9">
                <h1><?php echo $_SESSION['guardian_firstname'] . $_SESSION['guardian_lastname']; ?></h1>
            </div>
            <div class="flex items-center px-2 gap-3">
                <button id="maximize" class="border group border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-window-maximize group-hover:scale-110"></i>
                </button>
                <button id="shorter" class="border group border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-window-restore group-hover:scale-110"></i>
                </button>
                <button id="cross" class="border group border-black px-3 py-1 rounded-md black_border bg-white"><i
                        class="fa fa-times group-hover:scale-110"></i>
                </button>
            </div>
        </div>

        <!-- Content Area with Overflow Scroll -->
        <div class="mt-[52px] overflow-y-scroll h-screen">
            <?php require_once 'src\views\user\components\addchild.php'; ?>
            <?php

            require_once 'src/views/user/components/viewchild.php';
            require_once 'src/views/user/components/reviewmodel.php';
            ?>
            <section id="progress-reports" class="mt-20 font-mono">
                <h3 class="text-2xl font-semibold mb-4 font text-center">Progress Reports</h3>
                <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border">
                    <h4 class="text-lg font-semibold mb-2 font">Math Progress</h4>
                    <p class="text-gray-600 mb-4">Progress: 75%</p>
                    <div class="bg-gray-200 rounded-full h-2 mb-4">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                    <h4 class="text-lg font-semibold mb-2 font">Science Progress</h4>
                    <p class="text-gray-600 mb-4">Progress: 85%</p>
                    <div class="bg-gray-200 rounded-full h-2 mb-4">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                    <h4 class="text-lg font-semibold mb-2 font">English Progress</h4>
                    <p class="text-gray-600 mb-4">Progress: 90%</p>
                    <div class="bg-gray-200 rounded-full h-2 mb-4">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 90%"></div>
                    </div>
                </div>
            </section>

            <section id="parental-controls" class="mt-20">
                <h3 class="text-2xl font-semibold mb-4 font text-center">Parental Controls</h3>
                <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border">
                    <h4 class="text-lg font-semibold mb-2 font">Screen Time Limits</h4>
                    <label for="screen-time" class="block text-gray-600 mb-2">Set daily screen time limit
                        (hours):</label>
                    <input type="number" id="screen-time" name="screen-time" min="1" max="24"
                        class="border rounded p-2 mb-4 w-full shadow-md" />
                    <button class="bg-blue-500 black_border font text-white px-4 py-2 rounded">Set Limit</button>
                </div>
            </section>

            <section id="notifications" class="mt-20">
                <h3 class="text-2xl font-semibold mb-4 font text-center">Notifications</h3>
                <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border">
                    <ul class="space-y-4">
                        <li class="bg-green-100 p-4 rounded shadow-lg">
                            <p class="text-green-700">John has completed the Math Chapter 5</p>
                        </li>
                        <li class="bg-blue-100 p-4 rounded shadow-lg">
                            <p class="text-blue-700">New Science quiz available</p>
                        </li>
                        <li class="bg-yellow-100 p-4 rounded shadow-lg">
                            <p class="text-yellow-700">Subscription will renew in 3 days</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section id="subscription-management" class="mt-20 font-mono">
                <h3 class="text-2xl font-semibold mb-4 font text-center">Subscription Management</h3>
                <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border">
                    <p class="text-gray-600 mb-4">Current Plan: Premium</p>
                    <button class="bg-red-500 black_border font font-extrabold text-white px-4 py-2 rounded">Cancel
                        Subscription
                    </button>
                </div>
            </section>

            <section id="support-resources" class="my-20">
                <h3 class="text-2xl font-semibold mb-4 text-center font">Support and Resources</h3>
                <div class="bg-white p-6 rounded-lg w-11/12 mx-auto black_border">
                    <p class="text-gray-600 mb-4">Access to tutorials, tips, and resources to help children with their
                        learning.</p>
                    <button class="bg-sky-500 black_border font font-extrabold text-white px-4 py-2 rounded">Access
                        Resources
                    </button>
                </div>
            </section>
        </div> <!-- End of overflow-y-scroll -->
    </div> <!-- End of border-gray-400 -->
</div> <!-- End of bg-yellow-200 -->
