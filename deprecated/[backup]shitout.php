<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";
// Assuming you have your database connection established
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Fetch muscle groups and equipment from your database
$query = mysqli_query($conn, "SELECT mg_id, mg_name FROM muscleGroup");
$muscleGroups = [];
while ($row = mysqli_fetch_assoc($query)) {
    $muscleGroups[] = $row;
}

$query = mysqli_query($conn, "SELECT eq_id, eq_name FROM equipment");
$equipment = [];
while ($row = mysqli_fetch_assoc($query)) {
    $equipment[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <h1>Select Muscle Group and Equipment</h1>

    <form method="POST">
        <label for="muscleGroup">Muscle Group:</label>
        <select name="muscleGroup" id="muscleGroup">
            <option value="">Select Muscle Group</option>
            <?php foreach ($muscleGroups as $group) : ?>
                <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="equipment">Equipment:</label>
        <select name="equipment" id="equipment">
            <option value="">Select Equipment</option>
            <?php foreach ($equipment as $equip) : ?>
                <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Show Exercises">
        <div class="select-options">
        <?php
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve selected muscle group and equipment IDs from the form
            $muscleGroupId = $_POST['muscleGroup'];
            $equipmentId = $_POST['equipment'];

            // Check if both selections are made
            if (!empty($muscleGroupId) && !empty($equipmentId)) {
                // Query exercises based on muscle group and equipment
                $query = mysqli_query($conn, "SELECT ex_name FROM Exercises WHERE mg_id = $muscleGroupId AND eq_id = $equipmentId");

                if ($query) {
                   
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<input type="checkbox" name="ex_name" value="' . $row['ex_name'] . '">' . $row['ex_name'];
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Please select both a muscle group and equipment.";
            }
        }
        ?>
        </div>
    </form>
    
</body>

</html>



<!-- SHITOUT WITH BUTTONS -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <h1>Select Muscle Groups and Equipment</h1>

    <form method="POST">
        <label for="muscleGroup">Muscle Groups:</label>
        <select name="muscleGroup[]" id="muscleGroup" multiple>
            <option value="">Select Muscle Group(s)</option>
            <?php foreach ($muscleGroups as $group) : ?>
                <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="equipment">Equipment:</label>
        <select name="equipment[]" id="equipment" multiple>
            <option value="">Select Equipment(s)</option>
            <?php foreach ($equipment as $equip) : ?>
                <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Show Exercises">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $muscleGroupIds = isset($_POST['muscleGroup']) ? (is_array($_POST['muscleGroup']) ? $_POST['muscleGroup'] : [$_POST['muscleGroup']]) : [];
            $equipmentIds = isset($_POST['equipment']) ? (is_array($_POST['equipment']) ? $_POST['equipment'] : [$_POST['equipment']]) : [];
        
            if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                $query = "SELECT ex_name,ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";
                $result = mysqli_query($conn, $query);
        
                if ($result) {
                    echo "<h2>Available Workouts:</h2>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ExName=$row['ex_name']; 
                        $ExId=$row['ex_id'];?>
                        <button class="exercise-select" type="submit" name="Select-Exercise">
                        <input type="checkbox" name="<?php echo$ExId;?>" value="<?php echo$ExName;?>"><?php echo $ExName;?>
                        </button>
                    <?php }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Please select both muscle groups and equipment.";
            }
        }
         
        ?>
    </form>
</body>

</html>


<!-- SHITOUT MK3 -->
<!-- WITH DAYS OF WEEK -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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

// Define the days of the week
$daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <h1>Select Muscle Groups and Equipment for Each Day</h1>

    <?php
    // Loop through the days of the week
    foreach ($daysOfWeek as $day) :
    ?>
        <h2><?php echo $day; ?></h2>

        <form method="POST">
            <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
            <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                <option value="">Select Muscle Group(s)</option>
                <?php foreach ($muscleGroups as $group) : ?>
                    <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="equipment_<?php echo $day; ?>">Equipment:</label>
            <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                <option value="">Select Equipment(s)</option>
                <?php foreach ($equipment as $equip) : ?>
                    <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Show Exercises">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $muscleGroupIds = isset($_POST["muscleGroup_$day"]) ? (is_array($_POST["muscleGroup_$day"]) ? $_POST["muscleGroup_$day"] : [$_POST["muscleGroup_$day"]]) : [];
                $equipmentIds = isset($_POST["equipment_$day"]) ? (is_array($_POST["equipment_$day"]) ? $_POST["equipment_$day"] : [$_POST["equipment_$day"]]) : [];

                if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                    $query = "SELECT ex_name, ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo "<h3>Available Workouts:</h3>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ExName = $row['ex_name'];
                            $ExId = $row['ex_id'];
                        ?>
                            <button class="exercise-select" type="submit" name="Select-Exercise_<?php echo $day; ?>">
                                <input type="checkbox" name="<?php echo $ExId; ?>_<?php echo $day; ?>" value="<?php echo $ExName; ?>"><?php echo $ExName; ?>
                            </button>
            <?php
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Please select both muscle groups and equipment.";
                }
            }
            ?>
        </form>

    <?php
    endforeach;
    ?>

</body>

</html>



<!-- PARTIALLY WORKING WITH BUTTON -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <h1>Select Muscle Groups and Equipment for Each Day</h1>

    <?php
    // Loop through the days of the week
    foreach ($daysOfWeek as $day) :
        if(isset($_POST['Select-Exercise_'.$day])){
            
        }
    ?>
        <h2><?php echo $day; ?></h2>

        <form method="POST">
            <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
            <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                <option value="">Select Muscle Group(s)</option>
                <?php foreach ($muscleGroups as $group) : ?>
                    <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="equipment_<?php echo $day; ?>">Equipment:</label>
            <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                <option value="">Select Equipment(s)</option>
                <?php foreach ($equipment as $equip) : ?>
                    <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Show Exercises">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $muscleGroupIds = isset($_POST["muscleGroup_$day"]) ? (is_array($_POST["muscleGroup_$day"]) ? $_POST["muscleGroup_$day"] : [$_POST["muscleGroup_$day"]]) : [];
                $equipmentIds = isset($_POST["equipment_$day"]) ? (is_array($_POST["equipment_$day"]) ? $_POST["equipment_$day"] : [$_POST["equipment_$day"]]) : [];

                if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                    $query = "SELECT ex_name, ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0) {
                        echo "<h3>Available Workouts:</h3>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ExName = $row['ex_name'];
                            $ExId = $row['ex_id'];
            ?>
                            <button class="exercise-select" type="submit" name="Select-Exercise_<?php echo $day; ?>">
                            <input type="text"name="selected_ExId" value="<?php echo $ExId;?>" hidden>
                            <input type="text"name="selected_ExDay" value="<?php echo $day;?>" hidden>
                                <input type="checkbox" name="<?php echo $ExId; ?>_<?php echo $day; ?>" value="<?php echo $ExName; ?>"><?php echo $ExName; ?>
                            </button>
            <?php
                        }
                    } else {
                        echo "contact the admin to add the exercise youre looking for";
                    }
                } else {
                    echo "Please select both muscle groups and equipment.";
                }
            }
            ?>
        </form>

    <?php
    endforeach;
    ?>

</body>

</html>




<!-- UHM BUGGY ITERATION  -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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
// Handle exercise selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <?php include 'navmain.php'; ?>
    <h1>Select Muscle Groups and Equipment for Each Day</h1>

    <?php
    // Loop through the days of the week
    foreach ($daysOfWeek as $day) :
    ?>
        <h2><?php echo $day; ?></h2>

        <form method="POST">
            <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
            <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                <option value="">Select Muscle Group(s)</option>
                <?php foreach ($muscleGroups as $group) : ?>
                    <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="equipment_<?php echo $day; ?>">Equipment:</label>
            <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                <option value="">Select Equipment(s)</option>
                <?php foreach ($equipment as $equip) : ?>
                    <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="Select-Exercise_<?php echo $day; ?>" value="Show Exercises">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($daysOfWeek as $day) {
                    if (isset($_POST["Select-Exercise_$day"])) {
                        $muscleGroupIds = isset($_POST["muscleGroup_$day"]) ? (is_array($_POST["muscleGroup_$day"]) ? $_POST["muscleGroup_$day"] : [$_POST["muscleGroup_$day"]]) : [];
                        $equipmentIds = isset($_POST["equipment_$day"]) ? (is_array($_POST["equipment_$day"]) ? $_POST["equipment_$day"] : [$_POST["equipment_$day"]]) : [];

                        if (!empty($muscleGroupIds) && !empty($equipmentIds)) {
                            $query = "SELECT ex_name, ex_id FROM Exercises WHERE mg_id IN (" . implode(',', $muscleGroupIds) . ") AND eq_id IN (" . implode(',', $equipmentIds) . ")";
                            $result = mysqli_query($conn, $query);

                            if ($result->num_rows > 0) {
                                echo "<h3>Available Workouts:</h3>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $ExName = $row['ex_name'];
                                    $ExId = $row['ex_id'];
            ?>
                                    <form method="POST">
                                        <input type="text" name="selected_ExId" value="<?php echo $ExId; ?>" hidden>
                                        <input type="text" name="selected_ExDay" value="<?php echo $day; ?>" hidden>
                                        <input type="checkbox" name="<?php echo $ExId; ?>_<?php echo $day; ?>" value="<?php echo $ExName; ?>"><?php echo $ExName; ?>
                                    </form>
                                <?php
                                } ?> <input type="submit" class="exercise-select" name="Toggle-Exercise">
            <?php
                            } else {
                                echo "Contact the admin to add the exercise you're looking for.";
                            }
                        } else {
                            echo "Please select both muscle groups and equipment.";
                        }
                    }
                }

                if (isset($_POST["Toggle-Exercise"])) {
                    $selectedExId = $_POST["selected_ExId"];
                    $selectedExDay = $_POST["selected_ExDay"];
                    $isChecked = isset($_POST[$selectedExId . "_" . $selectedExDay]) ? 1 : 0;

                    // Assuming $SID contains the user's ID
                    $SID = 1; // Replace with your actual user ID retrieval logic

                    $getDayID = "SELECT d_id FROM days WHERE d_full='$selectedExDay'";
                    $dayres = $conn->query($getDayID);
                    $fetcheddays = $dayres->fetch_assoc();
                    $SelectedDayId = $fetcheddays['d_id'];

                    // Check if the exercise is already saved for the day
                    $checkQuery = "SELECT w_id FROM workouts WHERE ex_id = $selectedExId AND day = '$SelectedDayId' AND uid='$SID'";
                    $checkResult = mysqli_query($conn, $checkQuery);

                    if ($checkResult->num_rows > 0) {
                        // Exercise is already saved, update its state
                        $updateQuery = "UPDATE workouts SET Used = $isChecked WHERE ex_id = $selectedExId AND day = '$SelectedDayId' AND uid='$SID'";
                        $updateResult = mysqli_query($conn, $updateQuery);

                        if ($updateResult) {
                            echo "Exercise state updated successfully.";
                        } else {
                            echo "Error updating exercise state: " . mysqli_error($conn);
                        }
                    } else {
                        // Exercise is not saved, insert it
                        $insertQuery = "INSERT INTO workouts (ex_id, uid, day, date, Used) VALUES ($selectedExId, $SID, '$SelectedDayId', CURDATE(), $isChecked)";
                        $insertResult = mysqli_query($conn, $insertQuery);

                        if ($insertResult) {
                            echo "Exercise inserted successfully.";
                        } else {
                            echo "Error inserting exercise: " . mysqli_error($conn);
                        }
                    }
                }
            } ?>
        </form>
    <?php
    endforeach;
    ?>
</body>

</html>



<!-- FINALLY A WOKRING ITERATION -->
<!-- PARTIALLY WORKING WITH BUTTON -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
    <?php include 'navmain.php'; ?>
    <h1>Select Muscle Groups and Equipment for Each Day</h1>

    <?php
    // Loop through the days of the week
    foreach ($daysOfWeek as $day) :
    ?>
        <h2><?php echo $day; ?></h2>

        <form method="POST">
            <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
            <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                <option value="" disabled>Select Muscle Group(s)</option>
                <?php foreach ($muscleGroups as $group) : ?>
                    <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="equipment_<?php echo $day; ?>">Equipment:</label>
            <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                <option value="" disabled>Select Equipment(s)</option>
                <?php foreach ($equipment as $equip) : ?>
                    <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Show Exercises">
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

    <?php
    endforeach;
    ?>

</body>

</html>


<!-- YEAAAAAAAAA TOGGLE BABYYYYYYY -->
<!-- PARTIALLY WORKING WITH BUTTON -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = mysqli_connect($servername, $username, $password, $dbname);
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Selection</title>
</head>

<body>
<?php include 'navmain.php';?><br><br><br><br>
    <h1>Select Muscle Groups and Equipment for Each Day</h1>

    <?php
    // Loop through the days of the week
    foreach ($daysOfWeek as $day) :
    ?>

        <?php
        if (!isset($_SESSION['rest-toggle'.$day])) {
            $_SESSION['rest-toggle'.$day] = 'on'; // Default to 'on' if not set
        }
        
        if (isset($_POST['rest-toggle'.$day])) {
            $clickedDay = $_POST['rest-toggle'.$day];
            if ($clickedDay === $day) {
                // Toggle the state when the button for the current day is clicked
                $_SESSION['rest-toggle'.$day] = ($_SESSION['rest-toggle'.$day] == 'on') ? 'off' : 'on';
            }
        }
        ?>

        <form method="POST">
        
            <h2><?php echo $day; ?><button type="submit" name="rest-toggle<?php echo $day;?>" value="<?php echo $day; ?>">REST</button></h2>
        
            <?php
            if ($_SESSION['rest-toggle'.$day] == 'on') :
            ?>
                <label for="muscleGroup_<?php echo $day; ?>">Muscle Groups:</label>
                <select name="muscleGroup_<?php echo $day; ?>[]" id="muscleGroup_<?php echo $day; ?>" multiple>
                    <option value="" disabled>Select Muscle Group(s)</option>
                    <?php foreach ($muscleGroups as $group) : ?>
                        <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="equipment_<?php echo $day; ?>">Equipment:</label>
                <select name="equipment_<?php echo $day; ?>[]" id="equipment_<?php echo $day; ?>" multiple>
                    <option value="" disabled>Select Equipment(s)</option>
                    <?php foreach ($equipment as $equip) : ?>
                        <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Show Exercises">
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
<?php
    endforeach;
?>

</body>

</html>