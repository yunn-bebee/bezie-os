
<!-- The Modal -->
<div id="setSecurityQuestionModal<?php echo htmlspecialchars($child['id']); ?>" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
    <div class="modal-content bg-green-200 w-1/3 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Set Security Question</h2>
        <form action="/child/set_security_answer" method="POST">
            <input type="hidden" name="child_id" value="<?php echo htmlspecialchars($child['id']); ?>">
            
            <div class="mb-4">
                <label for="security_question" class="block text-gray-700">Security Question</label>
                <label for="security_answer" class="text-sm font-medium text-gray-700">What is your favorite pet's name?</label>
            
              </div>
            <div class="mb-4">
                <label for="security_answer" class="block text-gray-700">Answer</label>
                <input type="text" id="security_answer" name="security_answer" class="w-full border border-gray-300 p-2 rounded mt-2" required>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded font-semibold">Save</button>
                <button type="button" onclick="closeModal('setSecurityQuestionModal<?php echo htmlspecialchars($child['id']); ?>')" class="ml-4 bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold">Cancel</button>
            </div>
        </form>
    </div>
</div>
