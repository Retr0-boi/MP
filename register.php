<!DOCTYPE html>
<html>
<head>
  <title>GRT Register</title>
  <link rel="stylesheet" type="text/css" href="auth.css">
</head>
<body>
  <div class="container">
    <h1>REGISTER</h1>
    <form  method="POST">
      <input type="text" placeholder="Username" name="username" required>
      <input type="email" placeholder="Email" name="email" required>
      <input type="password" placeholder="Password" name="password" required>
      <button type="submit" name="register">Create Account</button>
    </form>
    <p class="create-account">Already have an account? <a href="login.php">Log in</p></a>
  </div>
</body>
</html>
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
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform additional validation and sanitization of user inputs here

    // Encrypt the password       

    // Insert the user data into the database
    $sql = "INSERT INTO users (username,email,password) VALUES ('$username','$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>      