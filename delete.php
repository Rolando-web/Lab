<?php
 require_once 'student.php';
  $student = new student();
  $id = $_GET['id'] ?? null;

  if($id){
    $student->delete($id);
  }
  
  header("Location: index.php");

?>