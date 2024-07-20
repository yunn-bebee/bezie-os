<?php

require_once 'src/model/adminModel.php';
require_once 'src/model/lessonModel.php';
require_once 'src/model/Contact.php';
require_once 'src/model/achievementModel.php';
require_once 'src/model/testmodel.php';

class AdminController {
    private $model;
    private $lmodel;
    private $contact;
    private $achievement;
    private $testModel;

    public function __construct() {
        $conn = getDbConnection();
        $this->model = new AdminModel($conn);
        $this->lmodel = new LessonModel($conn);
        $this->contact = new Contact($conn);
        $this->achievement = new AchievementModel($conn);
        $this->testModel = new TestModel($conn);
    }

    public function dashboard() {
        $totalUsers = $this->model->getTotalUsers();
        $newSignups = $this->model->getNewSignups();
        $totalLessons = $this->model->getTotalLessons();
        require 'src/views/admin/dashboard.php';
    }

    public function getAllSubjects() {
        return $this->lmodel->getAllSubjects();
    }

    public function getAllLevels() {
        return $this->lmodel->getAllLevels();
    }

    public function lessonDashboard() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $lessons = $this->getAllLessons($page);
        $totalLessonsCount = $this->getTotalLessonsCount($_GET['subject'] ?? '', $_GET['level'] ?? '', $_GET['search'] ?? '');
        require 'src/views/admin/lesson.php';
    }

    public function users() {
        $guardians = $this->model->getAllGuardians();
        require 'src/views/admin/userview.php';
    }

    public function showAddLessonForm() {
        $subjects = $this->lmodel->getAllSubjects();
        $levels = $this->lmodel->getAllLevels();
        require_once 'src/views/admin/addlesson.php';
    }

    public function addLesson() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subjectId = $_POST['subject_id'];
            $levelId = $_POST['level_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $video_url = isset($_POST['video_url']) ? $_POST['video_url'] : null;
            $thumbnail_url = isset($_POST['thumbnail_url']) ? $_POST['thumbnail_url'] : null;

            if (empty($subjectId) || empty($levelId) || empty($title) || empty($description)) {
                echo "All fields except video and thumbnail URLs are required.";
                return;
            }

            try {
                $this->lmodel->addLesson($subjectId, $levelId, $title, $description, $video_url, $thumbnail_url);
                setcookie('signup_error', 'Lesson added successfully', time() + 3600, '/');
                header("Location: /admin/lessons");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $subjects = $this->lmodel->getAllSubjects();
            $levels = $this->lmodel->getAllLevels();
            include 'views/admin/addLesson.php';
        }
    }

    public function getTotalLessonsCount($subjectFilter = '', $levelFilter = '', $searchQuery = '') {
        return $this->lmodel->fetchTotalLessonsCount($subjectFilter, $levelFilter, $searchQuery);
    }
    public function buildQueryString($subjectFilter, $levelFilter, $searchQuery) {
        $queryString = '';
    
        if (!empty($subjectFilter)) {
            $queryString .= '&subject=' . urlencode($subjectFilter);
        }
        if (!empty($levelFilter)) {
            $queryString .= '&level=' . urlencode($levelFilter);
        }
        if (!empty($searchQuery)) {
            $queryString .= '&search=' . urlencode($searchQuery);
        }
    
        return $queryString;
    }
    
    public function getAllTests($page, $limit, $subjectFilter = '', $levelFilter = '', $searchQuery = '') {
        $offset = ($page - 1) * $limit;
        return $this->testModel->getAllTests($subjectFilter, $levelFilter, $searchQuery, $limit, $offset);
    }
    public function getTotalTestsCount($subjectFilter = '', $levelFilter = '', $searchQuery = '') {
        return $this->testModel->getTotalTestsCount($subjectFilter, $levelFilter, $searchQuery);
    }
    public function getAllLessons($page = 1, $limit = 10) {
        $subject = $_GET['subject'] ?? '';
        $level = $_GET['level'] ?? '';
        $search = $_GET['search'] ?? '';
        $offset = ($page - 1) * $limit;
        return $this->lmodel->getLessons($subject, $level, $search, $limit, $offset);
    }

    public function updateLesson() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lessonId = $_POST['lesson_id'];
            $subjectId = $_POST['subject_id'];
            $levelId = $_POST['level_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $video_url = isset($_POST['video_url']) ? $_POST['video_url'] : null;
            $thumbnail_url = isset($_POST['thumbnail_url']) ? $_POST['thumbnail_url'] : null;

            if (empty($subjectId) || empty($levelId) || empty($title) || empty($description)) {
                echo "All fields except video and thumbnail URLs are required.";
                return;
            }

            try {
                $this->lmodel->updateLesson($lessonId, $subjectId, $levelId, $title, $description, $video_url, $thumbnail_url);
                setcookie('signup_error', 'Lesson updated successfully', time() + 3600, '/');
                header("Location: /admin/lessons");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function deleteLesson($lessonId) {
        try {
            $this->lmodel->deleteLesson($lessonId);
            setcookie('signup_error', 'Lesson deleted successfully', time() + 3600, '/');
            header("Location: /admin/lessons");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function contactMessages() {
        // Fetch all contact messages
        $messages = $this->contact->getAllMessages();
        require 'src/views/admin/contact.php'; // Display contact messages view
    }

    public function deleteContactMessage($id) {
        if ($this->contact->deleteMessage($id)) {
            // Message deleted successfully
            setcookie('signup_error', 'Contact message deleted successfully', time() + 3600, '/');
            header('Location: /admin/contacts'); // Redirect to contact messages page
            exit;
        } else {
            echo "Failed to delete contact message.";
        }
    }   
    public function achievements() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12; // Set your desired limit per page
    
        $achievements = $this->getAllAchievements($page, $limit);
        $totalAchievements = $this->getTotalAchievementsCount();
        $totalPages = ceil($totalAchievements / $limit);
    
        require 'src/views/admin/achievements.php';
    }
    

    public function getAllAchievements($page, $limit) {
        return $this->achievement->getAllAchievements($page, $limit);
    }

    public function getTotalAchievementsCount() {
        return $this->achievement->getTotalAchievementsCount();
    }

    public function addAchievement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission
            $title = $_POST['title'];
            $description = $_POST['description'];
            $badge_picture_url = $_POST['badge_picture_url']; // Assuming you have a form field for badge picture URL

            // Validate input (example)
            if (empty($title) || empty($description) || empty($badge_picture_url)) {
                echo "All fields are required.";
                return;
            }

            try {
                $this->achievement->addAchievement($title, $description, $badge_picture_url);
                setcookie('achievement_message', 'Achievement added successfully', time() + 3600, '/');
                header("Location: /admin/achievements");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function updateAchievement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission for updating achievement
            $id  = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $badge_picture_url = $_POST['badge_picture_url']; // Assuming you have a form field for badge picture URL

            // Validate input (example)
            if (empty($title) || empty($description) || empty($badge_picture_url)) {
                echo "All fields are required.";
                return;
            }

            try {
                $this->achievement->updateAchievement($id, $title, $description, $badge_picture_url);
                setcookie('achievement_message', 'Achievement updated successfully', time() + 3600, '/');
                header("Location: /admin/achievements");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function deleteAchievement($id) {
        try {
            $this->achievement->deleteAchievement($id);
            setcookie('achievement_message', 'Achievement deleted successfully', time() + 3600, '/');
            header("Location: /admin/achievements");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function testDashboard() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $subjectFilter = isset($_GET['subject']) ? $_GET['subject'] : '';
        $levelFilter = isset($_GET['level']) ? $_GET['level'] : '';
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        $tests = $this->testModel->getAllTests($subjectFilter, $levelFilter, $searchQuery, $limit, ($page - 1) * $limit);
        $totalTests = $this->testModel->getTotalTestsCount($subjectFilter, $levelFilter, $searchQuery);
        $totalPages = ceil($totalTests / $limit);

        require 'src\views\admin\testDashboard.php';
    }

    public function addTest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subjectId = $_POST['subject_id'];
            $levelId = $_POST['level_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            if (empty($subjectId) || empty($levelId) || empty($title) || empty($description)) {
                echo "All fields are required.";
                return;
            }

            try {
                $this->testModel->addTest($subjectId, $levelId, $title, $description);
                setcookie('test_message', 'Test added successfully', time() + 3600, '/');
                header("Location: /admin/tests");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            require 'src/views/admin/addTest.php';
        }
    }
    
    // Method to show test details
    public function showTestDetails($testId) {
        $id = $testId;
        $testDetails = $this->testModel->getTestDetails($testId);
        $testQuestions = $this->testModel->getTestQuestions($testId);
        require 'src\views\admin\testDetails.php';
    }

    public function getTestDetails($testId){
        return $this->testModel->getTestDetails($testId);
    }
    public function addQuestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $testId = $_POST['test_id'];
            $questionText = $_POST['question_text'];
            $answers = $_POST['answers'];
            $correctAnswer = $_POST['correct_answer'];
    
            if (empty($testId) || empty($questionText) || empty($answers) || empty($correctAnswer)) {
                echo "Test ID, question, and answers are required.";
                return;
            }
    
            try {
                // Add the question and get the question ID
                $questionId = $this->testModel->addQuestion($testId, $questionText);
    
                // Add answers and mark the correct one
                foreach ($answers as $index => $answer) {
                    $isCorrect = ($answer == $correctAnswer) ? 1 : 0;
                    $this->testModel->addAnswer($questionId, $answer, $isCorrect);
                }
    
                setcookie('question_message', 'Question added successfully', time() + 3600, '/');
                header("Location: /admin/test-details/".$testId);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    

    public function addAnswer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $questionId = $_POST['question_id'];
            $answer = $_POST['answer'];
            $isCorrect = isset($_POST['is_correct']) ? 1 : 0;
            $testId = $_POST['test_id'];
    
            if (empty($questionId) || empty($answer)) {
                echo "Question ID and answer are required.";
                return;
            }
    
            try {
                // If the answer is marked as correct, update other answers' is_correct to 0
                if ($isCorrect) {
                    $this->testModel->resetCorrectAnswers($questionId);
                }
                
                $this->testModel->addAnswer($questionId, $answer, $isCorrect);
                setcookie('answer_message', 'Answer added successfully', time() + 3600, '/');
                header("Location: /admin/test-details/".$testId);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
    public function editQuestion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $questionId = $_POST['question_id'];
            $questionText = $_POST['question_text'];
    
            if (empty($questionId) || empty($questionText)) {
                echo "Question ID and question text are required.";
                return;
            }
    
            try {
                $this->testModel->updateQuestion($questionId, $questionText);
                setcookie('question_message', 'Question updated successfully', time() + 3600, '/');
                $testId = $_POST['test_id'];
                header("Location: /admin/test-details/".$testId);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    public function editAnswer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $answerId = $_POST['answer_id'];
            $answerText = $_POST['answer_text'];
            $isCorrect = isset($_POST['is_correct']) ? 1 : 0;
    
            if (empty($answerId) || empty($answerText)) {
                echo "Answer ID and answer text are required.";
                return;
            }
    
            try {
                $this->testModel->updateAnswer($answerId, $answerText, $isCorrect);
    
                if ($isCorrect) {
                    // Update other answers of the same question to be not correct
                    $questionId = $this->testModel->getQuestionIdByAnswerId($answerId);
                    $this->testModel->resetOtherCorrectAnswers($questionId, $answerId);
                }
    
                setcookie('answer_message', 'Answer updated successfully', time() + 3600, '/');
                $testId = $_POST['test_id'];
                header("Location: /admin/test-details/".$testId);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    public function deleteQuestion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $questionId = $_POST['question_id'];
    
            if ($this->testModel->deleteQuestionAndAnswers($questionId)) {
                // Redirect or return success response
                header("Location: /admin/test-details/" . $_POST['test_id']);
                exit();
            } else {
                // Handle error
                echo "Error deleting question and its answers.";
            }
        }
    }
    
    public function deleteAnswer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $answerId = $_POST['answer_id'];
    
            if ($this->testModel->deleteAnswer($answerId)) {
                // Redirect or return success response
                header("Location: /admin/test-details/" . $_POST['test_id']);
                exit();
            } else {
                // Handle error
                echo "Error deleting answer.";
            }
        }
    }
    
    public function getTestQuestions($test_id){
      return  $this->testModel-> getTestQuestions($test_id);

    }
    public function displayTestResults($page = 1) {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $testResults = $this->testModel->getAllTestResults($limit, $offset);
        include 'views/admin/test_results.php';
    }

    public function deleteTestResult($id) {
        $this->testModel->deleteTestResult($id);
        header('Location: /admin/test-results');
    }

    public function certifyChildren() {
        $eligibleChildren = $this->testModel->getCertificationEligibleChildren();
        foreach ($eligibleChildren as $child) {
            $this->testModel->certifyChild($child['child_id']);
        }
        setcookie('certification_message', 'Children certified successfully', time() + 3600, '/');
        header('Location: /admin/test-results');
    }

}


