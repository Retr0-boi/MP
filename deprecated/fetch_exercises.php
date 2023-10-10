<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Assuming you have a database connection established already
// Include your database connection code here if not already included

// Receive the selected muscle groups and equipment from the AJAX request
$selectedMuscleGroups = $_POST['muscleGroups'];
$selectedEquipment = $_POST['equipment'];

// Perform database query to fetch exercises based on selected options
$sql = "SELECT ex_id, ex_name FROM exercises
        WHERE mg_id IN (" . implode(',', $selectedMuscleGroups) . ")
        AND eq_id IN (" . implode(',', $selectedEquipment) . ")";

$result = $conn->query($sql);

// Generate HTML options for exercises
$options = '';
while ($row = $result->fetch_assoc()) {
    $exerciseId = $row['exercise_id'];
    $exerciseName = $row['exercise_name'];
    $options .= "<option value='$exerciseId'>$exerciseName</option>";
}

// Return the generated HTML as the response
echo $options;

// Close the database connection if necessary
$conn->close();


?>
