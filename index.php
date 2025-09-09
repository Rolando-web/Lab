<?php
require_once 'student.php';
$student = new student();
$students = $student->readALL();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Create</title>
</head>
<body class="container mt-5">
  
  <h1 class="mb-4">Student Records</h1>
  <a href="create.php" class="btn btn-success mb-3">Add New Student</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($students as $student): ?>
      <tr>
        <td><?php echo $student['id'];?></td>
        <td><?php echo $student['name']; ?></td>
        <td><?php echo $student['email']; ?></td>
        <td><?php echo $student['course']; ?></td>
        <td>
          <a href="update.php?id=<?php echo $student['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
          <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="login.php">Logout</a>

</body>
</html>