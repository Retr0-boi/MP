<?php
// Establish a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate options for muscle groups
$sql = "SELECT * FROM musclegroup";
$result = $conn->query($sql);

$muscleGroups = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $muscleGroups[] = $row;
    }
}

// Generate options for equipment
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);

$equipment = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $equipment[] = $row;
    }
}

$conn->close();

$options = [
    "muscleGroups" => $muscleGroups,
    "equipment" => $equipment
];

header("Content-Type: application/json");
echo json_encode($options);
?>