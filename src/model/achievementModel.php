<?php
class AchievementModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAchievements($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM Achievements LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $offset, $limit); // 'ii' indicates two integers
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    public function getTotalAchievementsCount() {
        $query = "SELECT COUNT(*) as count FROM Achievements";
        $stmt = $this->db->query($query);
        $result = $stmt->fetch_assoc(); // Fetch as associative array
        return $result['count'];
    }
    

    public function addAchievement($title, $description, $badge_picture_url) {
        // Assuming $this->db is your MySQLi connection object
        $query = "INSERT INTO Achievements (title, description, badge_picture_url) VALUES (?, ?, ?)";
        
        $stmt = $this->db->prepare($query);
    
        // Check if preparation was successful
        if ($stmt === false) {
            throw new Exception("MySQLi prepare error: " . $this->db->error);
        }
    
        // Bind parameters and execute query
        $stmt->bind_param("sss", $title, $description, $badge_picture_url);
    
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    
        // Return true on success
        return true;
    }
    

    public function updateAchievement($id, $title, $description, $badge_picture_url) {
        $query = "UPDATE Achievements SET title = ?, description = ?, badge_picture_url = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
    
        // Check if preparation was successful
        if ($stmt === false) {
            throw new Exception("MySQLi prepare error: " . $this->db->error);
        }
    
        // Bind parameters and execute query
        $stmt->bind_param("sssi", $title, $description, $badge_picture_url, $id);
    
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    
        // Return true on success
        return true;
    }
    

    public function deleteAchievement($id) {
    $query = "DELETE FROM Achievements WHERE id = ?";
    $stmt = $this->db->prepare($query);

    // Check if preparation was successful
    if ($stmt === false) {
        throw new Exception("MySQLi prepare error: " . $this->db->error);
    }

    // Bind parameter and execute query
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Return true on success
    return true;
}

}
?>
