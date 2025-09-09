<?php 
require 'database.php';
require 'student.php';

$db = (new database())->getConnection();
$student = new student($db);

$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if($student->login($email, $password)){
    header('Location: index.php');
    exit;
  } else {
    $message = 'Invalid email or password';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
  <div class="login-container">
    <h2 class="text-center mb-4">Login</h2>
    <?php if($message): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" placeholder="Enter Email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" placeholder="Enter password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
      <a href="Register.php">Register</a>
    </div>
  </div>
</body>
</html>