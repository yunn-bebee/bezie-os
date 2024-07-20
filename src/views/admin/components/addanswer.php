<!-- Add Answer Modal -->
<div id="addAnswerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg   black_border p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Add Answer</h2>
            <button onclick="closeModal('addAnswerModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="addAnswerForm" action="/admin/add-answer" method="POST">
        <input type="hidden" name="test_id" id="addAnswerTestId" value="">    
        <input type="hidden" name="question_id" id="addAnswerQuestionId" value="">
            <div class="mb-4">
                <label for="answerText" class="block text-gray-700 font-bold mb-2">Answer Text</label>
                <input type="text" id="answerText" name="answer" class="border rounded w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="isCorrect" class="block text-gray-700 font-bold mb-2">Is Correct Answer?</label>
                <input type="checkbox" id="isCorrect" name="is_correct" class="mr-2 leading-tight">
                <span class="text-sm">Check if this is the correct answer</span>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addAnswerModal')" class=" font black_border bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-pink-500  font black_border text-white px-4 py-2 rounded">Add Answer</button>
            </div>
        </form>
    </div>
</div>
