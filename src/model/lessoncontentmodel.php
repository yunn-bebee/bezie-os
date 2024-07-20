<?php

class LessonContentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addLessonContent($lessonId, $content, $order) {
        $query = "INSERT INTO LessonContents (lesson_id, content, content_order) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isi', $lessonId, $content, $order);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public  function getLessonContents($lessonId) {
        $query = "SELECT * FROM LessonContents WHERE lesson_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $lessonId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateLessonContent($contentId, $content, $order) {
        $query = "UPDATE LessonContents SET content = ?, content_order = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $content, $order, $contentId);
        $stmt->execute();
    }

    public function deleteLessonContent($contentId) {
        $query = "DELETE FROM LessonContents WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $contentId);
        $stmt->execute();
    }
}

?>