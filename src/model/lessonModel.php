<?php

class LessonModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getLessons($subject = '', $level = '', $search = '', $limit = 10, $offset = 0) {
        $query = "SELECT Lessons.*, Videos.video_url, Videos.thumbnail_url, Subjects.name as subject_name, Levels.level_name 
                  FROM Lessons 
                  LEFT JOIN Videos ON Lessons.id = Videos.lesson_id 
                  LEFT JOIN Subjects ON Lessons.subject_id = Subjects.id
                  LEFT JOIN Levels ON Lessons.level_id = Levels.id
                  WHERE 1=1";
        
        $bindTypes = '';
        $bindValues = [];
        
        if (!empty($subject)) {
            $query .= " AND Lessons.subject_id = ?";
            $bindTypes .= 'i';
            $bindValues[] = $subject;
        }
        
        if (!empty($level)) {
            $query .= " AND Lessons.level_id = ?";
            $bindTypes .= 'i';
            $bindValues[] = $level;
        }
        
        if (!empty($search)) {
            $query .= " AND Lessons.title LIKE ?";
            $bindTypes .= 's';
            $bindValues[] = '%' . $search . '%';
        }
        
        $query .= " LIMIT ? OFFSET ?";
        $bindTypes .= 'ii';
        $bindValues[] = $limit;
        $bindValues[] = $offset;
    
        $stmt = $this->db->prepare($query);
        
        if (!empty($bindTypes)) {
            $stmt->bind_param($bindTypes, ...$bindValues);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchTotalLessonsCount($subjectFilter, $levelFilter, $searchQuery) {
        $query = "SELECT COUNT(*) as total FROM Lessons WHERE 1=1";
        $params = [];
        $bindTypes = '';
        
        if (!empty($subjectFilter)) {
            $query .= " AND subject_id = ?";
            $bindTypes .= 'i';
            $params[] = $subjectFilter;
        }
    
        if (!empty($levelFilter)) {
            $query .= " AND level_id = ?";
            $bindTypes .= 'i';
            $params[] = $levelFilter;
        }
    
        if (!empty($searchQuery)) {
            $query .= " AND title LIKE ?";
            $bindTypes .= 's';
            $params[] = '%' . $searchQuery . '%';
        }
    
        $stmt = $this->db->prepare($query);
        if (!empty($bindTypes)) {
            $stmt->bind_param($bindTypes, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }
    
    public function addLesson($subjectId, $levelId, $title, $description, $video_url, $thumbnail_url) {
        $query = "INSERT INTO Lessons (subject_id, level_id, title, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiss', $subjectId, $levelId, $title, $description);
        $stmt->execute();
        $lessonId = $stmt->insert_id;

        if ($video_url || $thumbnail_url) {
            $query = "INSERT INTO Videos (lesson_id, video_url, thumbnail_url) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iss', $lessonId, $video_url, $thumbnail_url);
            $stmt->execute();
        }
    }
    
    public function updateLesson($lessonId, $subjectId, $levelId, $title, $description, $video_url, $thumbnail_url) {
        // Update lesson details
        $query = "UPDATE Lessons SET subject_id = ?, level_id = ?, title = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iissi', $subjectId, $levelId, $title, $description, $lessonId);
        $stmt->execute();

        // Check if video and thumbnail URLs are provided
        if ($video_url || $thumbnail_url) {
            // Check if there is already a video entry for this lesson
            $existingVideoQuery = "SELECT id FROM Videos WHERE lesson_id = ?";
            $stmt = $this->db->prepare($existingVideoQuery);
            $stmt->bind_param('i', $lessonId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Update existing video and thumbnail URLs
                $updateVideoQuery = "UPDATE Videos SET video_url = ?, thumbnail_url = ? WHERE lesson_id = ?";
                $stmt = $this->db->prepare($updateVideoQuery);
                $stmt->bind_param('ssi', $video_url, $thumbnail_url, $lessonId);
                $stmt->execute();
            } else {
                // Insert new video and thumbnail URLs
                $insertVideoQuery = "INSERT INTO Videos (lesson_id, video_url, thumbnail_url) VALUES (?, ?, ?)";
                $stmt = $this->db->prepare($insertVideoQuery);
                $stmt->bind_param('iss', $lessonId, $video_url, $thumbnail_url);
                $stmt->execute();
            }
        }
    }
    public function deleteLesson($lessonId) {
        $query = "DELETE FROM Lessons WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $lessonId);
        $stmt->execute();

        $query = "DELETE FROM Videos WHERE lesson_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $lessonId);
        $stmt->execute();
    }

    public function getAllSubjects() {
        $query = "SELECT id, name FROM Subjects";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllLevels() {
        $query = "SELECT id, level_name FROM Levels";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>