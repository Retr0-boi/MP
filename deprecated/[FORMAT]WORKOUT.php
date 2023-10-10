<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
                <div class="workout-heading">CURRENT ROUTINE
                    <div class="icon">
                    <i class="fa-solid fa-calendar-week" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul>
                    <?php include 'DashWorkout.php'; ?>
                </ul>
            </div>
        </div>

        <div class="container-third">
            <div class="section top">

                <div class="workout-heading">CREATE NEW WORKOUT PLAN
                    <div class="icon">
                        <i class="fa-solid fa-calendar-plus" style="color: #25a825;"></i>
                    </div>
                </div>

                <form method="post">
                    <?php
                    $sql = "SELECT * FROM days";

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $d_id = $row["d_id"];
                        $day = $row["d_full"];
                    ?>
                        <h2><button>rest</button><?php echo $row["d_full"]; ?></h2>
                        <div class="day" <?php echo $row["d_id"]; ?>>
                            <div class="mg-box">
                                <div class='mg-label-heading'>
                                    <label for="muscleGroup">Muscle Group:</label>
                                </div>
                                <div class="select-options">
                                    <select name="muscleGroup[]" id="muscleGroup" multiple>
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
                                    <select name="equipment[]" id="equipment" multiple>
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
                                        $uwu ="SELECT * FROM exercises WHERE 
                                        mg_id IN (SELECT * FROM musclegroup WHERE mg_name='$selectedMuscleGroups'), 
                                        eq_id IN (SELECT * FROM equipment WHERE eq_name='$selectedEquipment')";
                                        // Build the SQL query to retrieve exercises based on selected options
                                        $result = mysqli_query($conn,$uwu);
                                        // $result = mysqli_query($conn, $qry);

                                        if ($result) {
                                            // Output the available exercises
                                            // echo '<h2>Available Exercises:</h2>';
                                            echo '<select name="selected_exercises[]" multiple>';
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option>' . $row['name'] . '</option>';
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

                    <?php } ?>



                    <div class="buttons-main">

                        <div class="buttons"><input type="submit" value="Show Exercises" name="Show-Exercises"></div>

                        <div class="buttons"><input type="submit" value="Save Routine" name="Save-Routine"></div>
                    </div>

                </form>

            </div>
        </div>

        <div class="container-second">
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
$muscleGroups = [];
$equipment = [];

if ($conn) {
    $muscleQuery = mysqli_query($conn, "SELECT mg_id, mg_name FROM muscleGroup");
    while ($row = mysqli_fetch_assoc($muscleQuery)) {
        $muscleGroups[] = $row;
    }

    $equipmentQuery = mysqli_query($conn, "SELECT eq_id, eq_name FROM equipment");
    while ($row = mysqli_fetch_assoc($equipmentQuery)) {
        $equipment[] = $row;
    }
} else {
    die("Connection failed: " . mysqli_connect_error());
}


$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


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
                <div class="workout-heading">CURRENT ROUTINE
                    <div class="icon">
                        <i class="fa-solid fa-calendar-week" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul>
                    <?php include 'DashWorkout.php'; ?>
                </ul>
            </div>
        </div>

        <div class="container-third">
            <div class="section top">

                <div class="workout-heading">CREATE NEW WORKOUT PLAN
                    <div class="icon">
                        <i class="fa-solid fa-calendar-plus" style="color: #25a825;"></i>
                    </div>
                </div>

                <?php
                // Loop through the days of the week
                foreach ($daysOfWeek as $day) :
                ?>
                    <div class="day">
                        <?php
                        if (!isset($_SESSION['rest-toggle' . $day])) {
                            $_SESSION['rest-toggle' . $day] = 'on'; // Default to 'on' if not set
                        }

                        if (isset($_POST['rest-toggle' . $day])) {
                            $clickedDay = $_POST['rest-toggle' . $day];
                            if ($clickedDay === $day) {
                                // Toggle the state when the button for the current day is clicked
                                $_SESSION['rest-toggle' . $day] = ($_SESSION['rest-toggle' . $day] == 'on') ? 'off' : 'on';
                            }
                        }
                        ?>

                        <form method="POST">

                            <h2><?php echo $day; ?><button type="submit" name="rest-toggle<?php echo $day; ?>" value="<?php echo $day; ?>"><i class="fa-solid fa-bed" style="color: #ff0000;"></i></button></h2>

                            <?php
                            if ($_SESSION['rest-toggle' . $day] == 'on') :
                            ?>
                                <div class="mg-box">
                                    <div class='mg-label-heading'>
                                        <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
                                    </div>
                                    <div class="select-options">
                                        <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                                            <option value="" disabled>Select Muscle Group(s)</option>
                                            <?php foreach ($muscleGroups as $group) : ?>
                                                <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="eq-box">
                                    <div class='eq-label-heading'>
                                        <label for="equipment_<?php echo $day; ?>">Equipment:</label>
                                    </div>
                                    <div class="select-options">
                                        <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                                            <option value="" disabled>Select Equipment(s)</option>
                                            <?php foreach ($equipment as $equip) : ?>
                                                <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="buttons"><input type="submit" value="Show Exercises"></div>
                                
                                <?php

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $muscleGroupIds = isset($_POST["muscleGroup_$day"]) ? (is_array($_POST["muscleGroup_$day"]) ? $_POST["muscleGroup_$day"] : [$_POST["muscleGroup_$day"]]) : [];
                                    $equipmentIds = isset($_POST["equipment_$day"]) ? (is_array($_POST["equipment_$day"]) ? $_POST["equipment_$day"] : [$_POST["equipment_$day"]]) : [];

                                    if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                                        $query = "SELECT ex_name, ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";

                                        $result = mysqli_query($conn, $query);

                                        if ($result->num_rows > 0) { ?>
                                            <h3>Available Workouts:</h3>
                                            <input type="text" name="<?php echo $day; ?>" value="<?php echo $day; ?>" hidden>
                                            <select name="selected_Exercises_<?php echo $day; ?>[]" id="selected_Exercises_<?php echo $day; ?>" multiple>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $ExName = $row['ex_name'];
                                                    $ExId = $row['ex_id'];
                                                ?>
                                                    <option type="checkbox" value="<?php echo $ExId; ?>"><?php echo $ExName; ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                            <input type="submit" class="exercise-select" name="Select-Exercise_<?php echo $day; ?>" value="save-exercise">
                                <?php
                                        } else {
                                            echo "contact the admin to add the exercise youre looking for";
                                        }
                                    } else {
                                        echo "Please select both muscle groups and equipment.";
                                    }
                                }
                                ?>

                                <?php
                                // Check if the form has been submitted
                                if (isset($_POST['Select-Exercise_' . $day])) {
                                    $DayName = $_POST[$day];
                                    $dayquery = "SELECT * FROM days WHERE d_full='$DayName'";
                                    $result = $conn->query($dayquery);
                                    $day_fetch = $result->fetch_assoc();
                                    $day_id = $day_fetch['d_id'];
                                    $exerciseIds = isset($_POST["selected_Exercises_$day"]) ? (is_array($_POST["selected_Exercises_$day"]) ? $_POST["selected_Exercises_$day"] : [$_POST["selected_Exercises_$day"]]) : [];

                                    if (!empty($exerciseIds)) {
                                        foreach ($exerciseIds as $ExId) {
                                            $query = "INSERT INTO workouts (uid,ex_id,day,date,Used) VALUES ('$SID','$ExId','$day_id',CURDATE(),'1')";
                                            if (!$conn->query($query)) {
                                                echo "<script>alert('Error: " . $conn->error . "');</script>";
                                            }
                                        }
                                    } else {
                                        echo "<script>alert('Select at least one exercise first');</script>";
                                    }
                                }

                                ?>

                        </form>
                    <?php else : ?>
                        <p>Today is rest day</p>
                    <?php endif; ?>
                    </div>
                <?php
                endforeach;
                ?>


            </div>
        </div>

        <div class="container-second">
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