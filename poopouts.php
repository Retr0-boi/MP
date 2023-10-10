<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = mysqli_query($conn, "SELECT mg_id, mg_name FROM MuscleGroup");
$muscleGroups = [];
while ($row = mysqli_fetch_assoc($query)) {
    $muscleGroups[] = $row;
}
$query = mysqli_query($conn, "SELECT eq_id , eq_name FROM Equipment");
$equipment = [];
while ($row = mysqli_fetch_assoc($query)) {
    $equipment[] = $row;
}
?>
<html>

<head>
    <title>Exercise Selection</title>
    <link rel="stylesheet" href="workouts.css">
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container">

        <div class="container-first">
            <div class="section top">
                <div class="workout-heading">TODAY'S WORKOUT
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul>
                    <?php include 'DashWorkout.php'; ?>
                </ul>
            </div>
        </div>

        <div class="container-second">
            <div class="section top">

                <div class="workout-heading">CREATE NEW WORKOUT PLAN
                    <div class="icon">
                        <i class="fa-solid fa-calendar-plus" style="color: #25a825;"></i>
                    </div>
                </div>

                <form method="post">
                <h2><button>rest</button>ANDI-DAY</h2>
                        <div class="day">
                            <div class="mg-box">
                                <div class='mg-label-heading'>
                                    <label for="muscleGroup">Muscle Group:</label>
                                </div>
                                <div class="select-options">
                                    <select name="muscleGroup" id="muscleGroup" multiple>
                                        <option value="">Select Muscle Groups</option>
                                        <?php foreach ($muscleGroups as $group) : ?>
                                            <option value="<?php echo $group['mg_id']; ?>" name="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="eq-box">
                                <div class='eq-label-heading'>
                                    <label for="equipment">Equipment:</label>
                                </div>
                                <div class="select-options">
                                    <select name="equipment" id="equipment" multiple>
                                        <option value="">Select Equipment</option>
                                        <?php foreach ($equipment as $equip) : ?>
                                            <option value="<?php echo $equip['eq_id']; ?>" name="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ex-box">
                                <div class='ex-label-heading'>
                                    <label for="exercises">Exercises:</label>
                                </div>
                                <div class="select-options">
                                <?php
                                    if (isset($_POST['Show-Exercises'])) {
                                        // Retrieve selected muscle groups and equipment from the form
                                        $selectedMuscleGroups = $_POST['muscleGroup'];
                                        $selectedEquipment = $_POST['equipment'];
                                        $mgid="SELECT DISTINCT mg_id FROM musclegroup WHERE mg_name='$selectedMuscleGroups'";
                                        $eqid="SELECT DISTINCT eq_id FROM equipment WHERE eq_name='$selectedEquipment'";
                                        $result_mgid = mysqli_query($conn, $mgid);
                                        $mgid_row= $result_mgid->fetch_assoc();
                                        
                                        $result_eqid = mysqli_query($conn, $eqid);
                                        $eqid_row= $result_eqid->fetch_assoc();
                                        // Build the SQL query to retrieve exercises based on selected options
                                        $uwu = "SELECT * FROM exercises WHERE mg_id='$mgid_row' AND eq_id='$eqid_row'";
                                    
                                        // Execute the query
                                        $result = mysqli_query($conn, $uwu);
                                        while ($row = $result->fetch_array()) {
                                            echo '<script>alert("$row["ex_name"]);</script>';                            
                                            }
                                        
                                        if ($result) {
                                            // Output the available exercises
                                            echo '<select name="exercises"id="exercises" multiple>';
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<script>alert("$row["ex_name"]);</script>';                            
                                                echo '<option>' . $row['ex_name'] . '</option>';
                                            }
                                            echo '</select>';
                                        } else {
                                            echo 'Error executing query: ' . mysqli_error($conn);
                                        }
                                    }
                                    ?>
                                    <!-- <select name="exercises[]" id="exercises" multiple>
                                        <option value="">Select Exercise</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                    <div class="buttons-main">

                        <div class="buttons"><input type="submit" value="Show Exercises" name="Show-Exercises"></div>

                        <div class="buttons"><input type="submit" value="Save Routine" name="Save-Routine"></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-third">
            <div class="section top">

                <div class="workout-heading">PREVIOUS WORKOUT PLANS
                    <div class="icon">
                        <i class="fa-solid fa-clock-rotate-left" style="color: #25a825;"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>