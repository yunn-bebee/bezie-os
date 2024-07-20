
<?php

class AdminModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function create($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO admins (username, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $email, $hashedPassword);
        return $stmt->execute();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    // Fetch total number of users
    // Fetch all users
    public function getAllGuardiansAndChildren() {
        $stmt = $this->db->prepare("
            SELECT g.id as guardian_id, g.first_name as guardian_firstname,g.last_name as guardian_lastname, g.email as guardian_email, g.created_at as guardian_signup_date,
                   c.id as child_id, c.name as child_name, c.dob as child_birthdate, c.gender as child_gender, c.avatar as child_avatar
            FROM guardians g
            LEFT JOIN children c ON g.id = c.guardian_id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllGuardians() {
        $query = "
            SELECT g.id as guardian_id, g.first_name as guardian_firstname, g.last_name as guardian_lastname, g.email as guardian_email, g.created_at as guardian_signup_date
            FROM guardians g
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $data = [];
    
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        return $data;
    }
    public function getChildrenByGuardianId($guardian_id) {
        $query = "
            SELECT c.id as child_id, c.name as child_name, c.dob as child_birthdate, c.gender as child_gender, c.avatar as child_avatar
            FROM children c
            WHERE c.guardian_id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $guardian_id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $data = [];
    
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        return $data;
    }
        

    public function getTotalUsers() {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM guardians');
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
    public function getTotalLessons() {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM lessons');
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
     // Fetch number of new signups today
     public function getNewSignups() {
        $stmt = $this->db->prepare('SELECT COUNT(*) as new_signups FROM guardians WHERE created_at >= CURDATE()');
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['new_signups'];
    }
    function insertLevel($levelName, $ageGroup) {
        $conn = getDbConnection();
        $sql = "INSERT INTO Levels (level_name, age_group) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $levelName, $ageGroup);
        if ($stmt->execute()) {
            echo "New level created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();
    }
    function insertType($typeName) {
        $conn = getDbConnection();
        $sql = "INSERT INTO Types (type_name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $typeName);
        if ($stmt->execute()) {
            echo "New type created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>
