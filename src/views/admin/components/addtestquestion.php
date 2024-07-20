
<div id="addQuestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg  p-6 w-full max-w-md font black_border">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Add Question</h2>
            <button onclick="closeModal('addQuestionModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="addQuestionForm" action="/admin/add-question" method="POST">
            <input type="hidden" name="test_id" value="<?php echo $id; ?>">
            <div class="mb-4">
                <label for="questionText" class="block text-gray-700 font-bold mb-2">Question Text</label>
                <textarea id="questionText" name="question_text" class="border rounded w-full p-2" required></textarea>
            </div>
            <div id="answersContainer" class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Answers</label>
                <div class="mb-2">
                    <input type="text" name="answers[]" class="border rounded w-full p-2 mb-1" placeholder="Answer 1" required>
                    <input type="text" name="answers[]" class="border rounded w-full p-2 mb-1" placeholder="Answer 2" required>
                    <input type="text" name="answers[]" class="border rounded w-full p-2 mb-1" placeholder="Answer 3" required>
                    <input type="text" name="answers[]" class="border rounded w-full p-2 mb-1" placeholder="Answer 4" required>
                </div>
                <button type="button" onclick="addAnswerField()" class="bg-yellow-500 text-black  font black_border px-4 py-2 rounded">Add Another Answer</button>
            </div>
            <div class="mb-4">
                <label for="correctAnswer" class="block text-gray-700 font-bold mb-2">Correct Answer</label>
                <input type="text" id="correctAnswer" name="correct_answer" class=" border rounded w-full p-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addQuestionModal')" class=" font black_border bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>