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
    <script>
        // Store the scroll position before reloading the page
        window.addEventListener("beforeunload", function() {
            localStorage.setItem("scrollPosition", window.scrollY);
        });

        // Restore the scroll position after the page reloads
        window.addEventListener("load", function() {
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
            }
        });
    </script>
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container-workout">

        <div class="container-first">
            <div class="section top">
                <div class="workout-heading">TODAY'S WORKOUT
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul class="todays-workout">
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

                <?php

                // Loop through the days of the week
                foreach ($daysOfWeek as $day) :
                ?>
                    <div class="day-routine">
                        <h2><?php echo $day; ?></h2>
                        <?php
                        $dayquery = "SELECT * FROM days WHERE d_full='$day'";
                        $result = $conn->query($dayquery);
                        $day_fetch = $result->fetch_assoc();
                        $day_id = $day_fetch['d_id'];
                        echo "<ul>";
                        $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$day_id'";
                        $result_exercises = $conn->query($sql_exercise);
                        if ($result_exercises->num_rows > 0) {
                            while ($row_exercise = $result_exercises->fetch_assoc()) {
                                $ex_id = $row_exercise["ex_id"];
                                $sql_ex_details = "SELECT ex_name FROM exercises WHERE ex_id='$ex_id'";

                                $ex_name_result = $conn->query($sql_ex_details);
                                $result_ex_name = $ex_name_result->fetch_assoc();
                                echo '<li>' . $result_ex_name["ex_name"] . '</li>';
                            }
                        } else
                            echo "<li>Rest day</li>";
                        echo "</ul>";
                        ?>

                    </div>
                <?php endforeach; ?>
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
                                if ($_SESSION['rest-toggle' . $day] == 'off') {
                                    $dayquery = "SELECT * FROM days WHERE d_full='$day'";
                                    $result = $conn->query($dayquery);
                                    $day_fetch = $result->fetch_assoc();
                                    $day_id = $day_fetch['d_id'];
                                    $selectQuery = "SELECT * FROM workouts WHERE uid='$SID' AND day='$day_id'";
                                    $result = $conn->query($selectQuery);
                                    if ($result->num_rows > 0) {
                                        $query = "DELETE FROM workouts WHERE day='$day_id' AND uid='$SID'";

                                        if (!$conn->query($query)) {
                                            echo "<script>alert('Error: " . $conn->error . "');</script>";
                                        }
                                    }
                                }
                            }
                            echo '<script>window.location.href = "workouts.php";</script>';
                        }
                        ?>

                        <form method="POST">

                            <h2><?php echo $day; ?>
                                <button type="submit" name="rest-toggle<?php echo $day; ?>" value="<?php echo $day; ?>" class="workout-buttons">
                                    <i class="fa-solid fa-bed" style="color: #ff0000;"></i>
                                </button>
                            </h2>

                            <?php
                            if ($_SESSION['rest-toggle' . $day] == 'on') :
                            ?>

                                <div class="mg-box">
                                    <div class='mg-label-heading'>
                                        <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
                                    </div>
                                    <div class="select-options">
                                        <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                                            <option value="" disabled><span>Select Muscle Group(s)</span></option>
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
                                            <option value="" disabled><span>Select Equipment(s)</span></option>
                                            <?php foreach ($equipment as $equip) : ?>
                                                <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="exercise-show" type="submit" value="Show Exercises" name="Show-exercise<?php echo $day; ?>">
                                    <i class="fa-solid fa-eye" style="color: #25a825;font-size:35px;"></i>
                                </button>
                                <!-- DO NOT EDIT IT JUST WORKS! -->
                                <?php

                                if (isset($_POST['Show-exercise' . $day])) {
                                    $muscleGroupIds = isset($_POST["muscleGroup_$day"]) ? (is_array($_POST["muscleGroup_$day"]) ? $_POST["muscleGroup_$day"] : [$_POST["muscleGroup_$day"]]) : [];
                                    $equipmentIds = isset($_POST["equipment_$day"]) ? (is_array($_POST["equipment_$day"]) ? $_POST["equipment_$day"] : [$_POST["equipment_$day"]]) : [];

                                    if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                                        $query = "SELECT ex_name, ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";

                                        $result = mysqli_query($conn, $query);

                                        if ($result->num_rows > 0) { ?>
                                            <div class="ex-box">
                                                <div class='ex-label-heading'>
                                                    <label for="exercises">Exercises:</label>
                                                </div>
                                                <input type="text" name="<?php echo $day; ?>" value="<?php echo $day; ?>" hidden>

                                                <div class="select-options-ex">
                                                    <select name="selected_Exercises_<?php echo $day; ?>[]" id="selected_Exercises_<?php echo $day; ?>" multiple>
                                                        <option value="" disabled><span>Select Exercise(s)</span></option>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $ExName = $row['ex_name'];
                                                            $ExId = $row['ex_id'];
                                                        ?>
                                                            <option type="checkbox" value="<?php echo $ExId; ?>"><?php echo $ExName; ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" class="exercise-select" name="Select-Exercise_<?php echo $day; ?>" value="save-exercise">
                                                <i class="fa-regular fa-floppy-disk" style="color: #25a825;font-size:35px;"></i>
                                            </button>

                                <?php
                                        } else {
                                            echo "<span>contact the admin to add the exercise youre looking for</span>";
                                        }
                                    } else {
                                        echo "<script>alert('Please select both muscle groups and equipment.');</script>";
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
                                            $selectQuery = "SELECT * FROM workouts WHERE ex_id='$ExId' AND uid='$SID' AND day='$day_id'";
                                            $result = $conn->query($selectQuery);
                                            if (!$result->num_rows > 0) {
                                                $query = "INSERT INTO workouts (uid,ex_id,day,date,Used) VALUES ('$SID','$ExId','$day_id',CURDATE(),'1')";

                                                if (!$conn->query($query)) {
                                                    echo "<script>alert('Error: " . $conn->error . "');</script>";
                                                }
                                            } else {
                                                $poopydoodoo = "UPDATE workouts SET date=CURDATE() WHERE uid='$SID' AND ex_id='$ExId'";
                                            }
                                        }
                                    } else {
                                        echo "<script>alert('Select at least one exercise first');</script>";
                                    }
                                    echo '<script>window.location.href = "workouts.php";</script>';
                                }

                                ?>

                        </form>



                    <?php else : ?>
                        <span>Today is rest day</span>
                    <?php endif; ?>


                    </div>
                <?php endforeach; ?>
                <br> <!-- YOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO STHALAM KOOTAN DAYS INTE ADEEL  -->
            </div>
        </div>
        <div class="container-fourth">
            <div class="section top">

                <div class="workout-heading">WORKOUT PRESETS
                    <div class="icon">
                        <i class="fa-solid fa-sliders" style="color: #25a825;"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>