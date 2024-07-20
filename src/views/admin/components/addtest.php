<!-- Modal for adding a test -->
<?php
$subjects = $adminController->getAllSubjects();
$levels = $adminController->getAllLevels();
?> 
<div id="addTestModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-md max-w-md w-full">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Add Test</h2>
            <button onclick="closeAddTestModal()" class="text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3.293 4.293a1 1 0 011.414 0L10 8.586l5.293-5.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <form id="addTestForm" method="POST" action="/admin/add-test">
            <div class="mb-4">
            <label for="subject_id" class="block text-sm font-semibold mb-2">Subject:</label>
                <select name="subject_id" id="subject_id" class="w-full px-4 py-2 border rounded border-gray-300 focus:border-blue-500 focus:outline-none" required>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?php echo htmlspecialchars($subject['id']); ?>">
                            <?php echo htmlspecialchars($subject['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="level_id" class="block text-sm font-semibold mb-2">Level:</label>
                <select name="level_id" id="level_id" class="w-full px-4 py-2 border rounded border-gray-300 focus:border-blue-500 focus:outline-none" required>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?php echo htmlspecialchars($level['id']); ?>">
                            <?php echo htmlspecialchars($level['level_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="openModal('addTestModal')" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Add Test</button>
          
            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded border-gray-300 focus:border-blue-500 focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold mb-2">Description:</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded border-gray-300 focus:border-blue-500 focus:outline-none" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddTestModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Test</button>
            </div>
        </form>
    </div>
</div>
