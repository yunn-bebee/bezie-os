
<div id="childModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-orange-200 p-8 rounded-md max-w-lg w-full relative black_border">
        <h2 class="text-2xl mb-4 font font-extrabold">Add Child</h2>
        <?php if (isset($_COOKIE['form_error'])): ?>
            <div class="mb-4 text-red-500"><?php echo htmlspecialchars($_COOKIE['form_error']); ?></div>
            <?php 
          
            setcookie('form_error', '', time() - 3600, '/');  
            ?>
        <?php endif; ?>
        <form id="childForm" action="/child/add" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="child-name" class="block text-gray-700 font">Child Name</label>
                <input type="text" id="child-name" name="child_name" class="border rounded p-2 w-full" required />
            </div>
            <div class="mb-4">
                <label for="child-dob" class="block text-gray-700 font">Date of Birth</label>
                <input type="date" id="child-dob" name="child_dob" class="border rounded p-2 w-full" required />
            </div>
            <div class="mb-4">
                <label for="child-gender" class="block text-gray-700 font">Gender</label>
                <select id="child-gender" name="child_gender" class="border rounded p-2 w-full" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="child-avatar" class="block text-gray-700 font">Profile Avatar</label>
                <input type="file" id="child-avatar" name="child_avatar" class="border rounded p-2 w-full" />
            </div>
            <div class="flex justify-evenly w-full">
                <button type="button" onclick="closeModal('childModal')" class="font bg-gray-300 text-black px-4 py-2 rounded mr-2 black_border">Cancel</button>
                <button type="submit" class="bg-yellow-500 font text-black px-4 py-2 rounded black_border">Add Child</button>
            </div>
        </form>
    </div>
</div>


