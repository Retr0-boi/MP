<?php
// Connect to your database
$conn = new mysqli("localhost", "username", "password", "your_database");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve selected muscle groups and equipment from the form
$selectedMuscleGroups = $_POST['muscle_group'];
$selectedEquipment = $_POST['equipment'];

// Create a query to fetch exercises based on selected options
$sql = "SELECT DISTINCT exercise.name
        FROM exercise
        INNER JOIN exercise_musclegroup ON exercise.id = exercise_musclegroup.exercise_id
        INNER JOIN exercise_equipment ON exercise.id = exercise_equipment.exercise_id
        WHERE exercise_musclegroup.musclegroup_id IN (" . implode(",", $selectedMuscleGroups) . ")
        AND exercise_equipment.equipment_id IN (" . implode(",", $selectedEquipment) . ")";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the available exercises in a select box
    echo "<label for='exercises'>Available Exercises:</label>";
    echo "<select name='exercises' multiple>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>" . $row['name'] . "</option>";
    }
    echo "</select>";
} else {
    echo "No exercises match the selected criteria.";
}

// Close the database connection
$conn->close();
?>
