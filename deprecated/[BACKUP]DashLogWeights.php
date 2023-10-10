<ul>
    <?php
    $check = "SELECT * FROM logged_weights WHERE UID='$SID' AND date=CURDATE()";
    $res = $conn->query($check);
    if ($res->num_rows > 0) {
        $IsAlreadySet = 1;
    } else {
        $IsAlreadySet = 0;
    }
    $currentDay = date("D"); // "D" format returns abbreviated day name (e.g., Mon, Tue, etc.)
    $sql_day = "SELECT d_id,d_full FROM days WHERE day='$currentDay'";

    $result_day = $conn->query($sql_day);
    $row_day = $result_day->fetch_assoc();
    $d_id = $row_day["d_id"];

    $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$d_id'";
    $result_exercises = $conn->query($sql_exercise);
    if ($result_exercises->num_rows > 0) {
        echo "<div class='day-today'>";
        while ($row_exercise = $result_exercises->fetch_assoc()) {
            $ex_id = $row_exercise["ex_id"];
            $sql_ex_details = "SELECT ex_name FROM exercises WHERE ex_id='$ex_id'";

            $ex_name_result = $conn->query($sql_ex_details);
            $result_ex_name = $ex_name_result->fetch_assoc();
            if (isset($IsAlreadySet) && $IsAlreadySet == 1) {
                $getvalues = "SELECT * FROM logged_weights WHERE ex_id='$ex_id' AND UID='$SID' AND date=CURDATE()";
                $result_query = $conn->query($getvalues);
                $result_weight = $result_query->fetch_assoc();
                $logged_weight = $result_weight['weight'];
            }
    ?>
            <form class="DashLogWeights" method="post">
                <li><?php echo $result_ex_name["ex_name"] ?>
                    <input type="text" name="exercise_<?php echo $ex_id; ?>" hidden>
                    <input type="number" name="weight_<?php echo $ex_id; ?>" value="<?php echo $logged_weight; ?>">
                </li>

            <?php }
        echo "</div>"; ?>
            <?php
            if (isset($_POST['submit-weights'])) {
                $insertValues = array();
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'weight_') === 0) {
                        $ex_id = substr($key, strlen('weight_'));
                        $weight = $_POST[$key];

                        $insertValues[] = "('$SID','$ex_id', '$weight',CURDATE())";
                    }
                }
                if (!empty($insertValues)) {
                    $sql = "INSERT INTO logged_weights (UID, ex_id, weight,date) VALUES " . implode(',', $insertValues);

                    if (!$conn->query($sql) === TRUE) {
                        echo "Error: " . $conn->error;
                    }
                }
                echo "<script>window.location='dashboard.php'</script>";
            }
            ?>
            <?php
            if (isset($_POST['update-weights'])) {
                
                $insertValues = array();
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'weight_') === 0) {
                        $ex_id = substr($key, strlen('weight_'));
                        $weight = $_POST[$key];

                        // $insertValues[] = "weight='$weight'WHERE UID='$SID' AND ex_id='$ex_id' AND date=CURDATE())";
                        $updateValues[] = "weight = '$weight'";
                    }
                }
                if (!empty($insertValues)) {
                    // $sql = "UPDATE logged_weights SET " . implode(',', $insertValues);
                    $sql = "UPDATE logged_weights SET " . implode(',', $updateValues) . " WHERE UID = '$SID' AND ex_id = '$ex_id' AND date = 'CURDATE()'";
                    
                    if (!$conn->query($sql) === TRUE) {
                        echo "Error: " . $conn->error;
                    }
                }
            }
            ?>

            <?php if ($IsAlreadySet == 0) : ?>
                <button name="submit-weights" class="bottom-right-button-log">
                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                </button>
            <?php else : ?>
                <button name="update-weights" class="bottom-right-button-log">
                <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                </button>
            <?php endif; ?>
            </form>
        <?php
    } else { ?>
            <li style='list-style-type: none;'>No weights to log today </li>
            <li style='list-style-type: none;'><a href='#' style="text-decoration:none;">View analytics</a></li>
        <?php }
        ?>
</ul>