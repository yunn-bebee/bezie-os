<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css">
   
</head>
<body class="bg-indigo-400 h-screen font-sans">
    <div class="flex h-full">
    <?php  require_once 'src/views/admin/sidebar.php';?>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-semibold mb-6 font text-yellow-400 text_shadow"> <i class="fas fa-users"></i> User Management</h1>
            <div class="bg-white p-6 rounded-lg black_border overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="font">
                            <th class="py-2 px-4 border-b">Guardian ID</th>
                            <th class="py-2 px-4 border-b">First Name</th>
                            <th class="py-2 px-4 border-b">Last Name</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Signup Date</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guardians as $guardian): ?>
                            <tr>
                                <td class="py-2 px-4 border-b font-mono text-lg "><?php echo $guardian['guardian_id']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg "><?php echo $guardian['guardian_firstname']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg "><?php echo $guardian['guardian_lastname']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg "><?php echo $guardian['guardian_email']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg "><?php echo $guardian['guardian_signup_date']; ?></td>
                                <td class="py-2 px-4 border-b">
                                    <button type="button" onclick="openModal('viewchildModal<?php echo $guardian['guardian_id']; ?>')" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Show Children</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <?php foreach ($guardians as $guardian): ?>
        <!-- Modal -->
        <div id="viewchildModal<?php echo $guardian['guardian_id']; ?>" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center z-50 flex hidden">
            <div class="bg-white p-6 rounded-lg black_border relative">
                <button type="button" onclick="closeModal('viewchildModal<?php echo $guardian['guardian_id']; ?>')" class="absolute top-0 right-0 mt-2 mr-2 px-2 bg-pink-400 rounded black_border text-black hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-2xl font-semibold mb-4 p-2 font">Children of Guardian ID <?php echo $guardian['guardian_id']; ?></h2>
                <?php
                    $conn = getDbConnection();
                    $model = new AdminModel($conn);
                    $children = $model->getChildrenByGuardianId($guardian['guardian_id']);
                ?>
                <?php if (!empty($children)): ?>
                    <table class="min-w-full text-lg ">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b font text-gray-900">Child ID</th>
                                <th class="py-2 px-4 border-b font text-gray-900">Name</th>
                                <th class="py-2 px-4 border-b font text-gray-900">Birthdate</th>
                                <th class="py-2 px-4 border-b font text-gray-900">Gender</th>
                                <th class="py-2 px-4 border-b font text-gray-900">Avatar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($children as $child): ?>
                                <tr>
                                    <td class="py-2 px-4 border-b font-mono"><?php echo $child['child_id']; ?></td>
                                    <td class="py-2 px-4 border-b font-mono"><?php echo $child['child_name']; ?></td>
                                    <td class="py-2 px-4 border-b font-mono"><?php echo $child['child_birthdate']; ?></td>
                                    <td class="py-2 px-4 border-b font-mono"><?php echo $child['child_gender']; ?></td>
                                    <td class="py-2 px-4 border-b font-mono">
                                        <img src="../<?php echo $child['child_avatar']; ?>" alt="Avatar" class="w-8 h-8 rounded-full">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-gray-900 font-mono">There are no children for this guardian.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    
<script src="../src/assets/js/script.js"></script>
<script src="../src/assets/js/jquery.js"></script>

</body>
</html>
