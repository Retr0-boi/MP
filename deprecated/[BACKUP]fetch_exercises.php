<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['muscleGroup']) && isset($_POST['equipment'])) {
    $selectedMuscleGroup = $_POST['muscleGroup'];
    $selectedEquipment = $_POST['equipment'];
    $sql_mg = "SELECT mg_id FROM musclegroup WHERE mg_name = '$selectedMuscleGroup'";
    $muscleGroup_id = $conn->query($sql_mg);
    $sql_eq = "SELECT eq_id FROM equipment WHERE eq_name = '$selectedEquipment'";
    $equipment_id = $conn->query($sql_eq);
    // Query to fetch exercises based on selected Muscle Group and Equipment
    $query = "SELECT * FROM exercises WHERE mg_id = '$muscleGroup_id' AND eq_id = '$equipment_id'";
    $result = mysqli_query($conn, $query);

    // Build the options for the Exercises dropdown
    $options = "<option value=''>Select Exercise</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['ex_id']}'>{$row['ex_name']}</option>";
    }

    echo $options;
} else {
    echo "<option value=''>Select Exercise</option>";
}
// Close the database connection
mysqli_close($conn);
?>