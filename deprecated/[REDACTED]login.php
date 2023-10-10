<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mygymroutine';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // UNHASHEDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
        if ($password == $row['password']) {
            echo 'success';
        } else {
            echo 'invalid pass';
        }
    } else {
        echo 'invalid email';
    }
}

$conn->close();
?>

