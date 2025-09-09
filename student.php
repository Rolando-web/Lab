<?php
//get the database connection
require_once 'database.php';

class student {
    private $conn;
    private $table_name = 'student';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($id, $name, $email, $course) {
        $sql = "INSERT INTO " . $this->table_name . " (id, name, email, course) VALUES(:id, :name, :email, :course)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'course' => $course]);
    }

    public function readALL() {
        $sql = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID($id) {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $first_name, $last_name, $email) {
        $sql = "UPDATE " . $this->table_name . " SET id = :id, name = :name, email = :email, course = :course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'course' => $course, 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>

