<?php

require_once 'config.php';

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    public function __construct(){
      $this->connect();
    }

    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . 
            $this->dbname, $this->user, $this->pass);
        }catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->conn;
    }
}

?>