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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Use md5 hashing for the password

    // You should perform additional validation and sanitization of user inputs here
    // Ensure that $username, $email, and $password are safe to use in SQL queries

    // Check if the user with the same email already exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $res = $conn->query($check);
    
    if($res->num_rows > 0){
        echo "<script>alert('User already exists');</script>";
    } else {
        // Insert the user data into the database
        $sql = "INSERT INTO users (username, email, password, date) VALUES ('$username', '$email', '$password', CURDATE())";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>