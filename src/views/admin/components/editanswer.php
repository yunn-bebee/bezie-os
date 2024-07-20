   <!-- Edit Answer Modal -->
   <div id="editAnswerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md black_border">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Edit Answer</h2>
                <button onclick="closeModal('editAnswerModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editAnswerForm" action="/admin/edit-answer" method="POST">
                <input type="hidden" name="answer_id" id="editAnswerId">
                <input type="hidden" name="question_id" id="editAnswerQuestionId">
                <input type="hidden" name="test_id" value="<?php echo $id; ?>">
                <div class="mb-4">
                    <label for="editAnswerText" class="block text-gray-700 font-bold mb-2">Answer Text</label>
                    <input type="text" id="editAnswerText" name="answer_text" class="border rounded w-full p-2" required>
                </div>
                <div class="mb-4">
                    <label for="editIsCorrect" class="block text-gray-700 font-bold mb-2">Correct Answer</label>
                    <input type="checkbox" id="editIsCorrect" name="is_correct">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editAnswerModal')" class="bg-gray-300  font black_border text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
            <button type="button" onclick="openDeleteAnswerModal('<?php echo $answer['answer_id']; ?>')" class="text-red-500 p-2 font hover:text-gray-900">
    <i class="fas fa-trash-alt"></i> Delete Answer
</button>

        </div>
    </div>