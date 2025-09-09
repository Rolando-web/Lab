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

    public function update($id, $name, $email, $course) {
        $sql = "UPDATE " . $this->table_name . " SET id = :id, name = :name, email = :email, course = :course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'course' => $course, 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

      public function register( $email, $password){
    echo '<script>alert("Registration successful!.");</script>';
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO register(email, password) VALUES(:email, :password)";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute(['email' => $email, 'password' => $hash_password]);
}

    public function login($email, $password){
      $query = "SELECT * FROM register WHERE email = :email LIMIT 1";
      $stmt = $this->conn->prepare($query);
      $stmt->execute(['email' => $email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if($user && password_verify($password, $user['password'])){
        $_SESSION['register_email'] = $user['email'];
        return true;
      }
      return false;
    }
    public function isLoggedIn(){
      return isset($_SESSION['register_email']);
    }

    public function user(){
      return $_SESSION['register_email'] ?? null;
    }

    public function logout(){
      session_destroy();
    }
}
?>

