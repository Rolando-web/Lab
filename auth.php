<?php 
require 'database.php';
session_start();

class auth{

  private $conn;

  public function __construct($db){
    $this->conn = $db;
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