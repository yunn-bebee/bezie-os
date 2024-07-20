<?php



class TestModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllTests($subjectFilter = '', $levelFilter = '', $searchQuery = '', $limit = 10, $offset = 0) {
        $sql = "SELECT t.*, 
                       (SELECT COUNT(*) FROM test_questions WHERE test_id = t.id) as question_count 
                FROM tests t WHERE 1";
        
        if (!empty($subjectFilter)) {
            $sql .= " AND subject_id = " . intval($subjectFilter);
        }
        if (!empty($levelFilter)) {
            $sql .= " AND level_id = " . intval($levelFilter);
        }
        if (!empty($searchQuery)) {
            $sql .= " AND title LIKE '%" . $this->conn->real_escape_string($searchQuery) . "%'";
        }
        
        $sql .= " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
        
        $result = $this->conn->query($sql);
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalTestsCount($subjectFilter = '', $levelFilter = '', $searchQuery = '') {
        $sql = "SELECT COUNT(*) as count FROM tests WHERE 1";
        
        if (!empty($subjectFilter)) {
            $sql .= " AND subject_id = " . intval($subjectFilter);
        }
        if (!empty($levelFilter)) {
            $sql .= " AND level_id = " . intval($levelFilter);
        }
        if (!empty($searchQuery)) {
            $sql .= " AND title LIKE '%" . $this->conn->real_escape_string($searchQuery) . "%'";
        }
        
        $result = $this->conn->query($sql);
        
        return $result->fetch_assoc()['count'];
    }

    public function addTest($subjectId, $levelId, $title, $description) {
        $stmt = $this->conn->prepare("INSERT INTO tests (subject_id, level_id, title, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $subjectId, $levelId, $title, $description);
        $stmt->execute();
        $stmt->close();
    }

    public function getTestById($testId) {
        $stmt = $this->conn->prepare("SELECT * FROM tests WHERE id = ?");
        $stmt->bind_param("i", $testId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function updateTest($testId, $subjectId, $levelId, $title, $description) {
        $stmt = $this->conn->prepare("UPDATE tests SET subject_id = ?, level_id = ?, title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("iissi", $subjectId, $levelId, $title, $description, $testId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteTest($testId) {
        $stmt = $this->conn->prepare("DELETE FROM tests WHERE id = ?");
        $stmt->bind_param("i", $testId);
        $stmt->execute();
        $stmt->close();
    }

    public function addQuestion($testId, $questionText) {
        $sql = "INSERT INTO test_questions (test_id, question) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $testId, $questionText);
        if ($stmt->execute()) {
            return $stmt->insert_id; // Return the last inserted ID (question ID)
        } else {
            throw new Exception("Error adding question: " . $this->conn->error);
        }
    }

    // Method to add an answer and mark if it's correct
    public function resetCorrectAnswers($questionId) {
        $sql = "UPDATE test_answers SET is_correct = 0 WHERE question_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$questionId]);
    }
    
    public function addAnswer($questionId, $answer, $isCorrect) {
        $sql = "INSERT INTO test_answers (question_id, answer, is_correct) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$questionId, $answer, $isCorrect]);
    }
    public function resetOtherCorrectAnswers($questionId, $currentAnswerId) {
        $sql = "UPDATE test_answers SET is_correct = 0 WHERE question_id = ? AND id != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$questionId, $currentAnswerId]);
    }
    public function deleteQuestionAndAnswers($questionId) {
        try {
            // Start transaction
            $this->conn->autocommit(FALSE);
    
            // Delete answers associated with the question
            $sql = "DELETE FROM test_answers WHERE question_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $questionId);
            $stmt->execute();
    
            // Delete the question
            $sql = "DELETE FROM test_questions WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $questionId);
            $stmt->execute();
    
            // Commit transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction
            $this->conn->rollback();
            return false;
        } finally {
            // End transaction
            $this->conn->autocommit(TRUE);
        }
    }
    
    public function deleteAnswer($answerId) {
        $sql = "DELETE FROM test_answers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$answerId]);
    }
    
    public function updateQuestion($questionId, $questionText) {
        $sql = "UPDATE test_questions SET question = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$questionText, $questionId]);
    }
    
    public function updateAnswer($answerId, $answerText, $isCorrect) {
        $sql = "UPDATE test_answers SET answer = ?, is_correct = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$answerText, $isCorrect, $answerId]);
    }
    public function getQuestionIdByAnswerId($answerId) {
        $sql = "SELECT question_id FROM test_answers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $answerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['question_id'];
    }
    
    public function getQuestionsByTestId($testId) {
        $stmt = $this->conn->prepare("SELECT * FROM test_questions WHERE test_id = ?");
        $stmt->bind_param("i", $testId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

 

    public function getAnswersByQuestionId($questionId) {
        $stmt = $this->conn->prepare("SELECT * FROM test_answers WHERE question_id = ?");
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTestQuestions($testId) {
        $query = "SELECT q.id, q.question, a.id AS answer_id, a.answer AS answer_text, a.is_correct
                  FROM test_questions q
                  LEFT JOIN test_answers a ON q.id = a.question_id
                  WHERE q.test_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $testId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        $questions = [];
        while ($row = $result->fetch_assoc()) {
            if (!isset($questions[$row['id']])) {
                $questions[$row['id']] = [
                    'question_text' => $row['question'], // Updated to match your table schema
                    'answers' => []
                ];
            }
            $questions[$row['id']]['answers'][] = [
                'answer_id' => $row['answer_id'],
                'answer_text' => $row['answer_text'],
                'is_correct' => $row['is_correct'] // Include whether the answer is correct
            ];
        }
        return $questions;
    }
    public function getTestDetails($testId) {
        $query = "SELECT tests.title, subjects.name AS subject_name, levels.level_name, tests.description 
                  FROM tests 
                  JOIN subjects ON tests.subject_id = subjects.id 
                  JOIN levels ON tests.level_id = levels.id 
                  WHERE tests.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $testId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function getAllTestResults($limit, $offset) {
        $sql = "SELECT ctm.id, ctm.child_id, ctm.test_id, ctm.marks, ctm.is_certified, c.name AS child_name, t.title AS test_title
                FROM children_test_marks ctm
                JOIN children c ON ctm.child_id = c.id
                JOIN tests t ON ctm.test_id = t.id
                LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteTestResult($id) {
        $sql = "DELETE FROM children_test_marks WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function certifyChild($childId) {
        $sql = "UPDATE children SET level = level + 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        $stmt->close();

        $sql = "UPDATE children_test_marks SET is_certified = TRUE WHERE child_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        $stmt->close();
    }

    public function getCertificationEligibleChildren() {
        $sql = "SELECT ctm.child_id, c.name AS child_name
                FROM children_test_marks ctm
                JOIN children c ON ctm.child_id = c.id
                WHERE ctm.marks > 50 AND ctm.is_certified = FALSE";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}
?>
