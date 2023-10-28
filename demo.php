<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();
$_SESSION['SUID'] = 69;
header("Location: dashboard.php");
exit;
?>