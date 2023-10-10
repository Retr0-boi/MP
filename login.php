<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mygymroutine';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!empty($_SESSION['SUID'])) {
  $SID = $_SESSION['SUID'];
  header('location:homepage.php');
}
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    //UNHASHED
    if ($password == $row['password']) {
      $_SESSION['SUID'] = $row['UID'];

      header("Location: dashboard.php");
      exit;
    } else {
      $isPasswordCorrect = 0;
    }
  } else {
    $isPasswordCorrect = 0;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>GRT Login</title>
  <link rel="stylesheet" type="text/css" href="auth.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="login.js"></script> -->
</head>

<body>
  <div class="container">
    <h1>LOGIN</h1>
    <!-- <form id="login-form" action="login.php" method="POST"> -->
    <form id="login-form" method="POST">

      <input type="email" placeholder="Email" name="email" required>
      <input type="password" placeholder="Password" name="password" required>
      <button type="submit" name="login">Login</button>
      <div id="error-message">
        <?php
        if (isset($_POST['login']) && isset($isPasswordCorrect))
          echo '<p>Invalid Email or Password!</p>';
        ?>
      </div>
    </form>
    <p class="create-account">Don't have an account? <a href="register.php">Create an account</a></p>
  </div>
</body>

</html>