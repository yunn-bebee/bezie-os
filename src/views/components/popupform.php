<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="shortcut icon" href="src/assets/c/logofull.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/css/style.css">
</head>
<body class="overflow-hidden bg-sky-300  h-screen">

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

<!-- Reusable Modal -->
<div id="reusableModal" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
    <div class="modal-content bg-orange-200 p-6 rounded-lg black_border h-[90%] overflow-scroll">
        <h2 class="text-2xl font-semibold mb-4" id="modalTitle">Modal Title</h2>
        <div id="modalBody">
            <!-- Dynamic content will be inserted here -->
        </div>
        <div class="flex justify-end mt-6">
            <button type="button" class="bg-pink-500 black_border font text-white px-4 py-2 rounded font-semibold" id="modalSaveButton">Save Changes</button>
            <button type="button" onclick="closeModal('reusableModal')" class="ml-4 bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold">Cancel</button>
        </div>
    </div>
</div>

<script>
function openModal(content, title = 'Modal Title', saveCallback = null) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalBody').innerHTML = content;
    if (saveCallback) {
        document.getElementById('modalSaveButton').onclick = saveCallback;
    }
    document.getElementById('reusableModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
</script>

</body>
</html>
 