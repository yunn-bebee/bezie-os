<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Details - <?php echo htmlspecialchars($testDetails['title']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../src/assets/css/style.css">
</head>
<body class="bg-indigo-400 h-screen font-mono">
    <div class="flex h-full">
        <?php require_once 'src/views/admin/sidebar.php'; ?>
        <div class="flex-1 p-6">
            <div class="flex items-center justify-between w-full">
              
                <h1 class="text-3xl font-semibold mb-6 text-yellow-200 text_shadow font">  <a href="/admin/tests"><i class="fas fa-sign-out-alt"></i></a> &nbsp;<i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($testDetails['title']); ?></h1>
                <button type="button" onclick="openModal('addQuestionModal')" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Add Question</button>
            </div>
            <br>
            <hr>
      <div class="flex justify-between items-baseline">  
            <div class="mt-4 mb-6">
                <p class="text-xl text-white font"><strong class="font text-sky-300 text_shadow">Subject:</strong> <?php echo htmlspecialchars($testDetails['subject_name']); ?></p>
                <p class="text-xl text-white font"><strong class="font text-sky-300 text_shadow">Level:</strong> <?php echo htmlspecialchars($testDetails['level_name']); ?></p>
                <p class="text-xl text-white font"><strong class="font text-sky-300 text_shadow">Description:</strong> <?php echo htmlspecialchars($testDetails['description']); ?></p>
            </div>
            <button type="button" onclick="openModal('addQuestionModal')" class="bg-sky-400 font black_border text-black px-4 py-2 rounded">Edit test details</button>
         
        </div>
            <div class="mt-4 mb-6">
                <h2 class="text-2xl font-bold text-yellow-200 font text_shadow pb-2 pl-5">Questions</h2>
                <?php if (!empty($testQuestions)): ?>
                    <ol class="list-decimal ml-5 text-3xl  font-bold font">
                        <?php foreach ($testQuestions as $questionId => $question): ?>
                            <li class="mb-4 text-black font-mono text-lg bg-white rounded-lg black_border  p-10 m-1 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-semibold font"><?php echo htmlspecialchars($question['question_text']); ?></p>
                                    <div class="">  
                                        <button type="button" onclick="openEditQuestionModal('<?php echo $questionId; ?>', '<?php echo htmlspecialchars(addslashes($question['question_text'])); ?>')" class="text-pink-500 p-2 font  hover:text-gray-200">
                                            <i class="fas fa-edit"></i> Edit Question
                                        </button>
                                        <button type="button" onclick="openAddAnswerModal('<?php echo $questionId; ?>','<?php echo $id; ?>')" class="bg-yellow-400 p-2 black_border roumded-md text-black hover:text-gray-200">
                                            <i class="fas fa-plus"></i> Add Answer 
                                        </button>
                                    </div>
                                </div>
                                <?php if (!empty($question['answers']) || $question['answers']==[]): ?>
                                    <ul class="ml-4 list-decimal">
                                        <?php foreach ($question['answers'] as $answer):
                                              if(!empty($answer['answer_id'])): ?>
                                          
                                            <li class="mb-2 flex items-center">
                                                <input type="radio" name="correct_answer_<?php echo $questionId; ?>" <?php if ($answer['is_correct']) echo 'checked'; ?> disabled>
                                                <span class="ml-2"><?php echo htmlspecialchars($answer['answer_text']); ?></span>
                                                <button type="button" onclick="openEditAnswerModal('<?php echo $answer['answer_id']; ?>', '<?php echo htmlspecialchars(addslashes($answer['answer_text'])); ?>', '<?php echo $answer['is_correct']; ?>')" class="ml-4 text-pink-400 hover:text-gray-200">
                                                    <i class="fas fa-edit"></i> Edit Answer
                                                </button>
                                            </li>
                                        <?php  else: ?>
                                            <p class="text-black font-mono ml-4">No answers available for this question.</p>
                                    <?php break; endif; endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-white font-mono ml-4">No answers available for this question.</p>
                                <?php endif; ?>
                                <button type="button" onclick="openDeleteQuestionModal('<?php echo $questionId; ?>', '<?php echo htmlspecialchars(addslashes($question['question_text'])); ?>')" class="text-red-500 font-mono absolute right-20  hover:text-gray-200">
                                    <i class="fas fa-trash-alt"></i> Delete Question
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php else: ?>
                    <p class="text-white font-mono">No questions available for this test.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="/src/assets/js/script.js"></script>
    <?php require_once 'src\views\admin\components\addtestquestion.php'; ?>
    <?php require_once 'src\views\admin\components\addanswer.php'; ?>
    <?php require_once 'src\views\admin\components\editquestion.php'; ?>
    <?php require_once 'src\views\admin\components\editanswer.php'; ?>
    <?php require_once 'src\views\admin\components\deletequestion.php'; ?>
    <?php require_once 'src\views\admin\components\deleteanswer.php'; ?>


<script>
    function openAddAnswerModal(questionId ,testId) {
        document.getElementById('addAnswerTestId').value = testId;
    document.getElementById('addAnswerQuestionId').value = questionId;
    openModal('addAnswerModal');
}

    function openEditQuestionModal(questionId, questionText) {
            document.getElementById('editQuestionId').value = questionId;
            document.getElementById('editQuestionText').value = questionText;
            openModal('editQuestionModal');
        }

        function openEditAnswerModal(answerId, answerText, isCorrect) {
            document.getElementById('editAnswerId').value = answerId;
            document.getElementById('editAnswerText').value = answerText;
            document.getElementById('editIsCorrect').checked = isCorrect == '1';
            openModal('editAnswerModal');
        }

        function addAnswerField() {
            const container = document.getElementById('answersContainer');
            const newAnswerField = document.createElement('input');
            newAnswerField.type = 'text';
            newAnswerField.name = 'answers[]';
            newAnswerField.className = 'border rounded w-full p-2 mb-1';
            newAnswerField.placeholder = 'Answer ' + (container.children.length + 1);
            newAnswerField.required = true;
            container.appendChild(newAnswerField);
        }
        function openDeleteQuestionModal(questionId, questionText) {
    document.getElementById('deleteQuestionId').value = questionId;
    document.getElementById('deleteQuestionText').innerText = questionText;
    openModal('deleteQuestionModal');
}
function openDeleteAnswerModal(answerId) {
    document.getElementById('deleteAnswerId').value = answerId;
    openModal('deleteAnswerModal');
}

</script>

</body>
</html>