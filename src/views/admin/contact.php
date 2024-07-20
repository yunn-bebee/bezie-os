<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../src/assets/css/style.css">
</head>
<body class="bg-indigo-400 h-screen font-sans">
    <div class="flex h-full">
        <?php require_once 'src/views/admin/sidebar.php';?>
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-semibold mb-6 font text-yellow-400 text_shadow"> <i class="fas fa-envelope"></i> Contact Messages</h1>
            <div class="bg-white p-6 rounded-lg black_border overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="font">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Message</th>
                            <th class="py-2 px-4 border-b">Created At</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr class="font-mono">
                                <td class="py-2 px-4 border-b font-mono text-lg"><?php echo $message['id']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg"><?php echo $message['name']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg"><?php echo $message['email']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg"><?php echo $message['message']; ?></td>
                                <td class="py-2 px-4 border-b font-mono text-lg"><?php echo $message['created_at']; ?></td>
                                <td class="py-2 px-4 border-b">
                                    <a href="mailto:<?php echo $message['email']; ?>" class="bg-blue-500 hover:bg-blue-600 font text-white px-4 py-2 black_border rounded mr-2">Reply</a>
                                    <a href="/admin/messages/delete/<?php echo $message['id']; ?>" class="bg-red-500 hover:bg-red-600 font text-white px-4 py-2  black_border  rounded">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../src/assets/js/script.js"></script>
</body>
</html>
