<div id="editChildModal<?php echo $child['id']; ?>" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
    <div class="modal-content bg-orange-200 p-6 rounded-lg black_border h-[90%] overflow-scroll">
        <h2 class="text-2xl font-semibold mb-4">Edit Child Profile</h2>
        <?php if (isset($_COOKIE['form_error'])): ?>
            <div class="mb-4 text-red-500"><?php echo htmlspecialchars($_COOKIE['form_error']); ?></div>
            <?php 
            // Clear the cookie after displaying the error
            setcookie('form_error', '', time() - 3600, '/');  
            ?>
        <?php endif; ?>
        <form action="/child/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="child_id" value="<?php echo htmlspecialchars($child['id']); ?>">
            <!-- Hidden field to store current avatar -->
            <input type="hidden" name="current_avatar" value="<?php echo htmlspecialchars($child['avatar']); ?>">

            <!-- Display current child data in the form fields -->
            <div class="mb-4">
                <label for="edit_child_name" class="block text-gray-700">Name</label>
                <input type="text" id="edit_child_name" name="child_name" value="<?php echo htmlspecialchars($child['name']); ?>" class="w-full border border-gray-300 p-2 rounded mt-2" required>
            </div>
            <div class="mb-4">
                <label for="edit_child_dob" class="block text-gray-700">Date of Birth</label>
                <input type="date" id="edit_child_dob" name="child_dob" value="<?php echo htmlspecialchars($child['dob']); ?>" class="w-full border border-gray-300 p-2 rounded mt-2" required>
            </div>
            <div class="mb-4">
                <label for="edit_child_age" class="block text-gray-700">Age</label>
                <input type="text" id="edit_child_age" name="child_age" value="<?php echo htmlspecialchars($child['age']); ?>" class="w-full border border-gray-300 p-2 rounded mt-2" required>
            </div>

            <div class="mb-4">
                <label for="edit_child_gender" class="block text-gray-700">Gender</label>
                <select id="edit_child_gender" name="child_gender" class="w-full border border-gray-300 p-2 rounded mt-2" required>
                    <option value="male" <?php if ($child['gender'] === 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($child['gender'] === 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($child['gender'] === 'other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="edit_child_avatar" class="block text-gray-700">Avatar</label>
                <div class="w-full p-2 rounded mt-2 flex justify-evenly items-center">
                    <input type="file" id="edit_child_avatar" name="child_avatar" accept="image/*" class="w-full border text-center border-gray-300 p-2 rounded mt-2">
                    <?php if ($child['avatar']) : ?>
                        <img src="<?php echo htmlspecialchars($child['avatar']); ?>" alt="Current Avatar" class="mt-2 w-16 h-16 rounded-full">
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-pink-500 black_border font text-white px-4 py-2 rounded font-semibold">Save Changes</button>
                <button type="button" onclick="closeModal('editChildModal<?php echo htmlspecialchars($child['id']); ?>')" class="ml-4 bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold">Cancel</button>
            </div>
        </form>
    </div>
</div>
