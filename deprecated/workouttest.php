<?php
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "mygymroutine";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected muscle group and equipment values from POST
$mg_id = $_POST['mg_id'];
$eq_id = $_POST['eq_id'];

// SQL query to fetch exercises based on selected muscle group and equipment
$sql = "SELECT ex_id, ex_name FROM exercises WHERE mg_id = $mg_id AND eq_id = $eq_id";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Generate HTML options for exercises
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $ex_id = $row['ex_id'];
        $ex_name = $row['ex_name'];
        $options .= "<option value='$ex_id'>$ex_name</option>";
    }
    echo $options;
} else {
    echo "<option value=''>No exercises found</option>";
}

// Close the database connection
$conn->close();
?>
