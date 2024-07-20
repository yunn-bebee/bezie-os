<?php
class Contact {
    private $conn;
    private $table_name = "contacts";

    public $id;
    public $name;
    public $email;
    public $message;
    public $created_at;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=?, email=?, message=?";
        
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));
        
        $stmt->bind_param("sss", $this->name, $this->email, $this->message);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getAllMessages() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $result = $this->conn->query($query);

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        return $messages;
    }

    public function deleteMessage($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
   
}
?>
