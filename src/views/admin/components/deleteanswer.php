<!-- Delete Answer Modal -->
<div id="deleteAnswerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Delete Answer</h2>
            <button onclick="closeModal('deleteAnswerModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-700 mb-4">Are you sure you want to delete this answer?</p>
        <div class="flex justify-end">
            <form id="deleteAnswerForm" action="/admin/delete-answer" method="POST">
            <input type="hidden" name="test_id" value="<?php echo htmlspecialchars($id); ?>">   
            <input type="hidden" name="answer_id" id="deleteAnswerId">
                <button type="button" onclick="closeModal('deleteAnswerModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Answer</button>
            </form>
        </div>
    </div>
</div>
