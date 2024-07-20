  <!-- Edit Question Modal -->
  <div id="editQuestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg black_border p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Edit Question</h2>
                <button onclick="closeModal('editQuestionModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editQuestionForm" action="/admin/edit-question" method="POST">
            <input type="hidden" name="test_id" value="<?php echo $id; ?>">
                <input type="hidden" name="question_id" id="editQuestionId">
                <div class="mb-4">
                    <label for="editQuestionText" class="block text-gray-700 font-bold mb-2">Question Text</label>
                    <textarea id="editQuestionText" name="question_text" class="border rounded w-full p-2" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editQuestionModal')" class="bg-gray-300  font black_border text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-pink-500  font black_border text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>