<?php
$currentDay = date("D"); // "D" format returns abbreviated day name (e.g., Mon, Tue, etc.)
$sql_day = "SELECT d_id,d_full FROM days WHERE day='$currentDay'";

$result_day = $conn->query($sql_day);
$row_day = $result_day->fetch_assoc();
$d_id = $row_day["d_id"];
$d_full = $row_day['d_full'];

$sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$d_id'";
$result_exercises = $conn->query($sql_exercise);
if ($result_exercises->num_rows > 0) {
    echo"<div class='day-today'>";
    echo"<h2>".$d_full."</h2>";
    while ($row_exercise = $result_exercises->fetch_assoc()) {
        $ex_id = $row_exercise["ex_id"];
        $sql_ex_details = "SELECT ex_name FROM exercises WHERE ex_id='$ex_id'";

        $ex_name_result = $conn->query($sql_ex_details);
        $result_ex_name = $ex_name_result->fetch_assoc();
        echo '<li>' . $result_ex_name["ex_name"] . '</li>';
    }
    echo"</div>";
} else {?>
    <li style='list-style-type: none;'>You have no exercises today</li>
    <li style='list-style-type: none;'><a href='analytics.php'style="text-decoration:none;" >View analytics</a></li>

<?php
}
?>
