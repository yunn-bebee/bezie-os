<!-- Delete Question Modal -->
<div id="deleteQuestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Delete Question</h2>
            <button onclick="closeModal('deleteQuestionModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-700">Are you sure you want to delete the question:</p>
        <p id="deleteQuestionText" class="text-gray-700 font-semibold mt-2"></p>
        <form id="deleteQuestionForm" action="/admin/delete-question" method="POST">
            <input type="hidden" name="question_id" id="deleteQuestionId">
            <input type="hidden" name="test_id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('deleteQuestionModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
            </div>
        </form>
    </div>
</div>
