<?php
//get the database connection
require_once 'database.php';

class student {
    private $conn;
    private $table_name = 'tbl_student';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($first_name, $last_name, $email) {
        $sql = "INSERT INTO " . $this->table_name . " (first_name, last_name, email) VALUES(:first_name, :last_name, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
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
        $sql = "UPDATE " . $this->table_name . " SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>

