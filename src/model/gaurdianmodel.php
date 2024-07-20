<?php
class GuardianModel
{
    private $conn;
    private $table_name = "guardians";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Save guardian details to the database.
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @param string $date_of_birth
     * @param int $agree_terms
     * @return bool
     */
    public function saveGuardian($first_name, $last_name, $email, $password, $date_of_birth)
    {
        // Check if email is already taken
        if ($this->isEmailTaken($email)) {
            return false; // Email is already taken
        }

        // Example: Using prepared statements for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO $this->table_name (first_name, last_name, email, password, date_of_birth) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $date_of_birth);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    /**
     * Check if email is already taken.
     *
     * @param string $email
     * @return bool
     */
    public function isEmailTaken($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM $this->table_name WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Get guardian by email.
     *
     * @param string $email
     * @return array|null
     */
    public function getGuardianByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    /**
     * Update guardian's password.
     *
     * @param string $email
     * @param string $new_password
     * @return bool
     */
    public function updatePassword($email, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE $this->table_name SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    
    /**
     * Delete guardian by email.
     *
     * @param string $email
     * @return bool
     */
    public function deleteGuardianByEmail($email)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table_name WHERE email = ?");
        $stmt->bind_param("s", $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function setRememberToken($id, $token)
    {
        $query = "UPDATE " . $this->table_name . " SET remember_token = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $token = htmlspecialchars(strip_tags($token));
        $stmt->bind_param("si", $token, $id);

        return $stmt->execute();
    }

    public function getGuardianByRememberToken($token)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE remember_token = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    // children
    function getLessonProgress($guardianId) {
  
        $conn = getDbConnection();
    
        $sql = "
        SELECT 
            c.id as child_id, 
            c.name as child_name, 
            s.name as subject_name, 
            COUNT(lp.id) as lessons_completed,
            (SELECT COUNT(*) FROM lessons l2 WHERE l2.subject_id = s.id AND l2.level_id = (SELECT level_id FROM lessons WHERE id = lp.lesson_id)) as total_lessons
        FROM 
            children c
        JOIN 
            lesson_progress lp ON c.id = lp.child_id
        JOIN 
            lessons l ON lp.lesson_id = l.id
        JOIN 
            subjects s ON l.subject_id = s.id
        WHERE 
            c.guardian_id = ?
        GROUP BY 
            c.id, s.name
        ";
      
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $guardianId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $progressData = [];
    
        while ($row = $result->fetch_assoc()) {
            $progressData[] = $row;
        }
    
        $stmt->close();
        $conn->close();
    
        return $progressData;
    }
    
   
}
