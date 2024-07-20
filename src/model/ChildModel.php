<?php
require_once 'src/model/lessoncontentmodel.php';

class ChildModel
{
    private $db;
    protected $table = 'children'; // Adjust table name as per your database schema

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($guardianId, $childData)
    {
        // Check if guardian has reached the limit of 2 children
        $childrenCount = $this->countChildren($guardianId);
        if ($childrenCount >= 2) {
            return false; // Guardian has reached the maximum children limit
        }

        // Insert new child record
        $query = "INSERT INTO {$this->table} (guardian_id, name, dob, age, level, gender, avatar) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bind_param(
            'issssss',
            $guardianId,
            $childData['name'],
            $childData['dob'],
            $childData['age'],
            $childData['level'],
            $childData['gender'],
            $childData['avatar']
        );

        // Execute the query
        if ($stmt->execute()) {
            return true; // Child created successfully
        } else {
            return false; // Error creating child
        }
    }

    public function getChildren($guardianId)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE guardian_id = ?");
        $stmt->bind_param("i", $guardianId);
        $stmt->execute();
        $result = $stmt->get_result();
        $children = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $children;
    }
    public function addReview($guardianId, $rating, $comment)
    {
        // Insert review into database
        $stmt = $this->db->prepare("INSERT INTO reviews (guardian_id, rating, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $guardianId,$rating, $comment);

        if ($stmt->execute()) {
            return true; // Successful insertion 
        } else {
            return false; // Error inserting data
        }
    }
    public function getChildById($childId)
    {
        $stmt = $this->db->prepare("SELECT * FROM children WHERE id = ?");
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function countChildren($guardianId)
    {
        // Count children associated with a guardian
        $query = "SELECT COUNT(*) AS count FROM {$this->table} WHERE guardian_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $guardianId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }
    public function update($childId, $childData)
    {
        // Update child record
        $query = "UPDATE {$this->table} SET name = ?, dob = ?, age = ?, level = ?, gender = ?, avatar = IFNULL(?, avatar) WHERE id = ?";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bind_param(
            'ssssssi',
            $childData['name'],
            $childData['dob'],
            $childData['age'],
            $childData['level'],
            $childData['gender'],
            $childData['avatar'],
            $childId
        );

        // Execute the query
        if ($stmt->execute()) {
            return true; // Child updated successfully
        } else {
            return false; // Error updating child
        }
    }
    public function setSecurityAnswer($childId, $answer)
    {
        $query = "UPDATE children SET security_answer = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $answer, $childId);
        return $stmt->execute();
    }

    public function verifySecurityAnswer($childId, $answer)
    {
        $query = "SELECT security_answer FROM children WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $childId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['security_answer'] === $answer;
    }

    public function verifyGuardianPassword($guardianId, $password)
    {
        $query = "SELECT password FROM guardians WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $guardianId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return password_verify($password, $result['password']);
    }
    public function getLessonsByLevelAndSubject($levelId, $subjectId, $childId)
    {
        $query = "SELECT Lessons.*, lesson_progress.is_completed
              FROM lessons 
              LEFT JOIN lesson_progress ON Lessons.id = lesson_progress.lesson_id AND lesson_progress.child_id = ?
              WHERE Lessons.level_id = ? AND Lessons.subject_id = ?
              ORDER BY Lessons.created_at DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $childId, $levelId, $subjectId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllSubjects()
    {
        $query = "SELECT id, name FROM Subjects";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getLessonsByLevel($levelId, $childId)
    {
        $query = "SELECT Lessons.*, Videos.video_url, Videos.thumbnail_url, Subjects.name as subject_name, Levels.level_name,
                     LP.start_time, LP.end_time as progress_end_time
              FROM Lessons 
              LEFT JOIN Videos ON Lessons.id = Videos.lesson_id 
              LEFT JOIN Subjects ON Lessons.subject_id = Subjects.id
              LEFT JOIN Levels ON Lessons.level_id = Levels.id
              LEFT JOIN lesson_progress LP ON Lessons.id = LP.lesson_id AND LP.child_id = ?
              WHERE Lessons.level_id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $childId, $levelId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function getFirstLessonIdByLevelAndSubject($levelId, $subjectId) {
        $query = "SELECT id FROM Lessons WHERE level_id = ? AND subject_id = ? ORDER BY id ASC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $levelId, $subjectId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['id'] ?? null;
    }
  
    public function assignFirstLessonIfNone($childId) {
        $child = $this->getChildById($childId);
        $subjects = $this->getAllSubjects();
    
        foreach ($subjects as $subject) {
            $subjectId = $subject['id'];
            $lessonId = $this->getFirstLessonIdByLevelAndSubject($child['level'], $subjectId);
    
            // Check if a valid lesson ID is returned
            if ($lessonId !== NULL) {
                // Check if child has any entries in lesson_progress and Children_Lessons for this lesson
                $lessonProgressExists = $this->lessonProgressExists($childId, $lessonId);
                $childrenLessonsExists = $this->childrenLessonsExists($childId, $lessonId);
    
                if (!$lessonProgressExists && !$childrenLessonsExists) {
                    $this->assignLesson($childId, $lessonId);
                }
            } else {
                // Log or handle the case where no lesson ID is found
                error_log("No valid lesson found for child ID: $childId, subject ID: $subjectId, level: " . $child['level']);
            }
        }
    }
    
    public function getLessonDetails($lessonId, $childId)
{   
    $conn = getDbConnection();
    $lessonModel = new LessonContentModel($conn);
    // Query to fetch lesson details along with all associated content items
    $query = "SELECT Lessons.*, 
                     Videos.video_url, 
                     Videos.thumbnail_url, 
                     Subjects.id as subject_id,  -- Include subject_id
                     Subjects.name as subject_name, 
                     Levels.id as level_id,     -- Include level_id
                     Levels.level_name,
                     LP.start_time, 
                     LP.end_time as progress_end_time
              FROM Lessons 
              LEFT JOIN Videos ON Lessons.id = Videos.lesson_id 
              LEFT JOIN Subjects ON Lessons.subject_id = Subjects.id
              LEFT JOIN Levels ON Lessons.level_id = Levels.id
              LEFT JOIN lesson_progress LP ON Lessons.id = LP.lesson_id AND LP.child_id = ?
              WHERE Lessons.id = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param("ii", $childId, $lessonId);
    $stmt->execute();
    $result = $stmt->get_result();

    $lessonDetails = null;

    // Fetch lesson details
    if ($row = $result->fetch_assoc()) {
        $lessonDetails = [
            'id' => $row['id'],
            'title' => $row['title'],
            // Add other lesson details as needed
            'video_url' => $row['video_url'],
            'thumbnail_url' => $row['thumbnail_url'],
            'subject_id' => $row['subject_id'],      // Include subject_id
            'subject_name' => $row['subject_name'],
            'level_id' => $row['level_id'],          // Include level_id
            'level_name' => $row['level_name'],
            'start_time' => $row['start_time'],
            'progress_end_time' => $row['progress_end_time'],
            'contents' => []
        ];
    }

    // Fetch lesson contents using getLessonContents function
    if ($lessonDetails !== null) {
        $lessonContents = $lessonModel->getLessonContents($lessonId);
        $lessonDetails['contents'] = $lessonContents;
    }

    return $lessonDetails;
}
     
public function getLessonContents($lessonId) {
    $query = "SELECT * FROM LessonContents WHERE lesson_id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $lessonId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    private function lessonProgressExists($childId, $lessonId) {
        $query = "SELECT COUNT(*) AS count FROM lesson_progress WHERE child_id = ? AND lesson_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $childId, $lessonId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }
    private function childrenLessonsExists($childId, $lessonId) {
        $query = "SELECT COUNT(*) AS count FROM Children_Lessons WHERE child_id = ? AND lesson_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $childId, $lessonId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }
        
    public function getMostRecentLessons($childId)
    {
        // Fetch the most recent lessons for the child
        $query = "
            SELECT l.*, v.video_url, v.thumbnail_url, cl.completed
            FROM Lessons l
            JOIN Children_Lessons cl ON l.id = cl.lesson_id
            LEFT JOIN Videos v ON l.id = v.lesson_id
            WHERE cl.child_id = ?
            ORDER BY l.subject_id, l.id ASC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function markLessonAsCompleted($childId, $lessonId)
    {
        $query = "
        UPDATE Children_Lessons
        SET completed = TRUE
        WHERE child_id = ? AND lesson_id = ?
    ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $childId, $lessonId);
        return $stmt->execute();
    }
    public function trackLessonProgress($childId, $lessonId)
    {
        $startTime = time();
        $stmt = $this->db->prepare("INSERT INTO lesson_progress (child_id, lesson_id, start_time) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $childId, $lessonId, $startTime);
        $stmt->execute();
    }

    public function getCompletedLessons($childId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS completed_lessons FROM lesson_progress WHERE child_id = ? AND end_time IS NOT NULL");
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['completed_lessons'];
    }

    public function getTotalLessons($levelId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_lessons FROM lessons WHERE level_id = ?");
        $stmt->bind_param("i", $levelId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_lessons'];
    }

    public function getLessonStartTime($childId, $lessonId)
    {
        $stmt = $this->db->prepare("SELECT start_time FROM lesson_progress WHERE child_id = ? AND lesson_id = ?");
        $stmt->bind_param("ii", $childId, $lessonId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['start_time'];
    }

    public function increaseChildLevel($childId)
    {
        $stmt = $this->db->prepare("UPDATE children SET level = level + 1 WHERE id = ?");
        $stmt->bind_param("i", $childId);
        $stmt->execute();
    }
public function completeLesson($childId, $lessonId)
{
    // Check the lesson start and end time
    $startTime = $this->getLessonStartTime($childId, $lessonId);
    $endTime = time();
    $timeDifference = $endTime - $startTime;

    // Ensure that the start time and end time are at least 2 hours apart
    if ($timeDifference < 2 ) {
        return false; // Not enough time has passed
    }

    // Update the end time and mark the lesson as completed
    $query = "UPDATE lesson_progress lp
JOIN Children_Lessons cl ON lp.child_id = cl.child_id AND lp.lesson_id = cl.lesson_id
SET lp.end_time = ?, -- Replace with your end time value
    cl.completed = TRUE
WHERE lp.child_id = ? -- Replace with your child_id
  AND lp.lesson_id = ?; -- Replace with your lesson_id
";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("iii", $endTime, $childId, $lessonId);
    $stmt->execute();

    // Mark the lesson as completed in Children_Lessons table
    $this->markLessonAsCompleted($childId, $lessonId);

    // Check if there are any more lessons for the subject
    $lesson = $this->getLessonDetails($lessonId, $childId);
    $subjectId = $lesson['subject_id'];
    $levelId = $lesson['level_id'];

    // Get the next lesson ID
    $nextLessonId = $this->getNextLessonId($levelId, $subjectId, $lessonId);

    if ($nextLessonId !== null) {
        // Assign the next lesson
        $this->assignLesson($childId, $nextLessonId);
    } else {
        // Check if all lessons are completed
        $totalLessons = $this->getTotalLessons($levelId);
        $completedLessons = $this->getCompletedLessons($childId);

        if ($completedLessons > $totalLessons) {
            // All lessons completed, handle this case (e.g., increase child's level)
            $this->increaseChildLevel($childId);
        }

         $this->checkAndAssignTests($childId, $subjectId);

    }

    

    return true; // Lesson completed successfully
}

private function getNextLessonId($levelId, $subjectId, $currentLessonId)
{
    // Query to get the next lesson ID based on the current lesson ID, level ID, and subject ID
    $query = "SELECT id FROM Lessons WHERE level_id = ? AND subject_id = ? AND id > ? ORDER BY id ASC LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("iii", $levelId, $subjectId, $currentLessonId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['id'] ?? null;
}

private function assignLesson($childId, $lessonId)
{
    $startTime = time();

    // Insert into lesson_progress table
    $query = "INSERT INTO lesson_progress (child_id, lesson_id, start_time) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("iii", $childId, $lessonId, $startTime);
    $stmt->execute();

    // Insert into Children_Lessons table
    $query = "INSERT INTO Children_Lessons (child_id, lesson_id, completed) VALUES (?, ?, 0)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("ii", $childId, $lessonId);
    $stmt->execute();
}



function checkAndAssignTests($childId, $subjectId) {
    // Fetch child level
    $childLevelQuery = "SELECT level_id FROM children WHERE id = ?";
    $stmt = $this->db->prepare($childLevelQuery);
    $stmt->bind_param("i", $childId);
    $stmt->execute();
    $childLevel = $stmt->get_result()->fetch_assoc()['level_id'];

    // Check if child has completed all lessons for the subject and level
    $completedLessonsQuery = "SELECT COUNT(*) AS remaining_lessons
                              FROM lessons 
                              WHERE subject_id = ? AND level_id = ?
                              AND id NOT IN (SELECT lesson_id FROM child_lessons WHERE child_id = ?)";
    $stmt = $this->db->prepare($completedLessonsQuery);
    $stmt->bind_param("iii", $subjectId, $childLevel, $childId);
    $stmt->execute();
    $remainingLessons = $stmt->get_result()->fetch_assoc()['remaining_lessons'];

    // If all lessons are completed
    if ($remainingLessons == 0) {
        // Assign test to the child
        $assignTestQuery = "INSERT INTO children_test_marks (child_id, test_id, created_at) 
                            SELECT ?, id, NOW() FROM tests 
                            WHERE subject_id = ? AND level_id = ?";
        $stmt = $this->db->prepare($assignTestQuery);
        $stmt->bind_param("iii", $childId, $subjectId, $childLevel);
        $stmt->execute();

        // Create a notification for the child
        $notificationQuery = "INSERT INTO notifications (child_id, message, created_at) VALUES (?, ?, NOW())";
        $message = "You have a new test assigned for subject " . $subjectId . "!";
        $stmt = $this->db->prepare($notificationQuery);
        $stmt->bind_param("is", $childId, $message);
        $stmt->execute();
        return true;
    }
}
private function createNotification($childId, $message)
{
    $notificationQuery = "INSERT INTO notifications (child_id, message, created_at) VALUES (?, ?, NOW())";
    $stmt = $this->db->prepare($notificationQuery);
    $stmt->bind_param("is", $childId, $message);
    $stmt->execute();
}
function getNotifications($childId) {
    $notificationsQuery = "SELECT * FROM notifications WHERE child_id = ? AND seen = 0";
    $stmt = $this->db->prepare($notificationsQuery);
    $stmt->bind_param("i", $childId);
    $stmt->execute();
    $result = $stmt->get_result();
    $notifications = [];
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
    return $notifications;
}
function markNotificationsAsSeen($childId) {
    $updateQuery = "UPDATE notifications SET seen = TRUE WHERE child_id = ? AND seen = FALSE";
    $stmt =$this->db->prepare($updateQuery);
    $stmt->bind_param("i", $childId);
    $stmt->execute();
}

}
