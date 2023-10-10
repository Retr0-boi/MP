<html>
<head>
    <title>Homepage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container">
        <div class="container-first">
            <div class="section top">
                <div class="section-header">TODAY'S WORKOUT
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                    </div>
                    <button class="square-button-workouts"><a href="workouts.php" style='text-decoration:none;'>
                            <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                        </a></button>
                </div>
                <ul>
                    <?php
                    $currentDay = date("D"); // "D" format returns abbreviated day name (e.g., Mon, Tue, etc.)
                    $sql_day = "SELECT d_id FROM days WHERE day='$currentDay'";
                    $result_day = $conn->query($sql_day);
                    $row_day = $result_day->fetch_assoc();
                    $d_id = $row_day["d_id"];

                    $sql_exercise = "SELECT ex_id FROM workouts WHERE UID = '$SID' AND used = 1 AND day='$d_id'";
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
                        echo "<li style='list-style-type: none;'>create a workout plan to see todays exercises</li>";
                    ?>

                </ul>
            </div>
            <div class="section top">
                <div class="section-header">LOG WEIGHTS
                    <div class="icon">
                        <i class="fa-solid fa-cloud-arrow-up" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul>
                    <li>Logged weight for exercise 1</li>
                    <li>Logged weight for exercise 2</li>
                    <li style='list-style-type: none;'>Logged weight no style</li>
                </ul>
                <button name="submit-weights" class="bottom-right-button-log">
                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                </button>
            </div>
        </div>

        <div class="container-second">
            <?php
            if (!isset($_SESSION['goal-toggle'])) {
                $_SESSION['goal-toggle'] = 'on'; // Default to 'on' if not set
            }

            if (isset($_POST['goal-edit'])) {
                // Toggle the state when the button is clicked
                $_SESSION['goal-toggle'] = ($_SESSION['goal-toggle'] === 'on') ? 'off' : 'on';
            }
            ?>
            <div class="section bottom">
                <div class="section-header">GOALS
                    <div class="icon">
                        <i class="fa-solid fa-bullseye" style="color: #25a825;"></i>
                    </div>
                    <form class="goals-form" method="POST">
                        <button type="submit" class="square-button-goals" name="goal-edit">
                            <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                        </button>
                    </form>
                </div>

                <?php
                if ($_SESSION['goal-toggle'] === 'on') :
                ?>
                    <form method='post'>
                        <ul>
                            <?php
                            $sql_goals = "SELECT * FROM goals WHERE UID = '$SID' ORDER BY goal_id ASC";
                            $result_goals = $conn->query($sql_goals);

                            if ($result_goals->num_rows > 0) {
                                while ($row_goals = $result_goals->fetch_assoc()) {
                                    $goal_id = $row_goals["goal_id"];
                                    $goal_desc = $row_goals["goal_description"];
                            ?>
                                    <li>
                                        <form method='post'>
                                            <div class="goal-list">
                                                <div class="goal-desc">
                                                    <?php echo $goal_desc; ?>
                                                    <input type="hidden" name="ip_goal_id" value="<?php echo $goal_id; ?>">
                                                </div>
                                                <div class="goal-buttons">
                                                    <button type="submit" class="square-button-complete-goal" name="completed">
                                                        <i class="fa-solid fa-circle-check" style="color: #25a825;"></i>
                                                    </button>
                                                    <button type="submit" class="square-button-delete-goal" name="deleted">
                                                        <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                            <?php
                                }
                            } else {
                                echo "<li style='list-style-type: none;'>Set goals using the edit button</li>";
                            }
                            ?>
                        </ul>

                    </form>
                    <?php
                    if (isset($_POST['completed']) or isset($_POST['deleted'])) {
                        $goal_id = $_POST['ip_goal_id']; // Get the goal_id from the hidden input
                        $sql = "SELECT goal_description FROM goals WHERE goal_id = '$goal_id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $goalDescription = $row['goal_description'];
                            if (isset($_POST['completed']))
                                $sql_insert = "INSERT INTO previous_goals(g_id,uid,goal_desc,date,completed) 
          VALUES('$goal_id','$SID','$goalDescription',CURDATE(),1)";
                            else
                                $sql_insert = "INSERT INTO previous_goals(g_id,uid,goal_desc,date,completed) 
          VALUES('$goal_id','$SID','$goalDescription',CURDATE(),0)";
                            if ($conn->query($sql_insert) === TRUE) {
                                $sql_delete = "DELETE FROM goals WHERE goal_id = '$goal_id'";
                                if (!$conn->query($sql_delete) === TRUE) {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }
                        echo '<script>window.location.href = "dashboard.php";</script>';
                    }
                    ?>

                <?php else : ?>

                    <form class="add-goal" method="POST">
                        <div id="newGoal">
                            <!-- New text box and button pairs will be added here -->
                        </div>
                        <div class="button-container">
                            <div class="newGoalButton">
                                <button class="square-button-new-goals" type="button" onclick="addNewGoal()">
                                    <i class="fa-solid fa-square-plus" style="color: #25a825;"></i>
                                </button>
                            </div>
                            <div class="submitButton" style="display: none;">
                                <button class="square-button-save-new-goals" type="submit" name="add_goal">
                                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                                </button>
                            </div>
                        </div>
                    </form>


                    <script>
                        function addNewGoal() {
                            // Create a new div to contain the text box, delete button, and "Add Goal" button
                            var goalDiv = document.createElement("div");

                            // Create new input field
                            var newInputGoals = document.createElement("input");
                            newInputGoals.type = "text";
                            newInputGoals.name = "newGoal[]";
                            newInputGoals.className = "newGoal";
                            newInputGoals.placeholder = "Enter a new goal";
                            newInputGoals.required = true;

                            // Create a delete button for the text box
                            var deleteButton = document.createElement("button");
                            deleteButton.type = "button";
                            deleteButton.className = "square-button-delete-goals";
                            var trashIcon = document.createElement("i");
                            trashIcon.className = "fa-solid fa-trash";
                            trashIcon.style.color = "#ff0000";
                            deleteButton.appendChild(trashIcon);
                            deleteButton.onclick = function() {
                                // Remove the entire div when the delete button is clicked
                                goalDiv.remove();
                                checkSaveButtonVisibilityGoals();
                            };

                            // Append the new elements to the div
                            goalDiv.appendChild(newInputGoals);
                            goalDiv.appendChild(deleteButton);

                            // Append the div to the form
                            var newGoalDiv = document.getElementById("newGoal");
                            newGoalDiv.appendChild(goalDiv);

                            // Show the "Add Goal" button when a form is added
                            checkSaveButtonVisibilityGoals();
                        }

                        function checkSaveButtonVisibilityGoals() {
                            // Show the "Save Goals" button when there's at least one form
                            var submitButton = document.querySelector(".submitButton");
                            var newGoalDiv = document.getElementById("newGoal");
                            var forms = newGoalDiv.querySelectorAll("div");
                            if (forms.length > 0) {
                                submitButton.style.display = "block";
                            } else {
                                submitButton.style.display = "none";
                            }
                        }
                    </script>
                <?php endif; ?>
                <?php
                if (isset($_POST['add_goal'])) {
                    $goals = $_POST['newGoal'];

                    foreach ($goals as $goal) {
                        $sql = "INSERT INTO goals (goal_description, UID) VALUES ('$goal', '$SID')"; // Replace $SID with your user ID

                        if (!$conn->query($sql) === TRUE)
                            echo "<p>Goal insertion unsuccessful: " . $goal . "<br></p>";
                        else {

                            $_SESSION['goal-toggle'] = 'on';
                            echo '<script>window.location.href = "dashboard.php";</script>';
                        }
                    }
                }
                ?>
            </div><!-- EEEEEEEEEEEEEEEEE DIVVVVVVVVV IS FROM THE PHP INCLUDE  -->
            <?php
            if (!isset($_SESSION['reminder-toggle'])) {
                $_SESSION['reminder-toggle'] = 'on'; // Default to 'on' if not set
            }

            if (isset($_POST['reminder-edit'])) {
                // Toggle the state when the button is clicked
                $_SESSION['reminder-toggle'] = ($_SESSION['reminder-toggle'] === 'on') ? 'off' : 'on';
            }
            ?>
            <div class="section bottom">
                <div class="section-header">REMINDERS
                    <div class="icon">
                        <i class="fa-solid fa-bell" style="color: #25a825;"></i>
                    </div>
                    <form class="reminders-form" method="POST">
                        <button type="submit" class="square-button-reminders" name="reminder-edit">
                            <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                            </a></button>
                    </form>
                </div>
                <?php
                if ($_SESSION['reminder-toggle'] === 'on') :
                ?>
                    <form method='post'>
                        <ul>
                            <?php
                            $sql_reminders = "SELECT * FROM reminders WHERE UID = '$SID' ORDER BY reminder_id ASC";
                            $result_reminders = $conn->query($sql_reminders);

                            if ($result_reminders->num_rows > 0) {
                                while ($row_reminders = $result_reminders->fetch_assoc()) {
                                    $reminder_id = $row_reminders["reminder_id"];
                                    $reminder_desc = $row_reminders["reminder_text"];
                            ?>
                                    <li>
                                        <form method='post'>
                                            <div class="reminder-list">
                                                <div class="reminder-desc">
                                                    <?php echo $reminder_desc; ?>
                                                    <input type="hidden" name="ip_reminder_id" value="<?php echo $reminder_id; ?>">
                                                </div>
                                                <div class="reminder-buttons">
                                                    <button type="submit" class="square-button-delete-reminder" name="delete_reminders">
                                                        <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>

                            <?php
                                }
                            } else
                                echo "<li style='list-style-type: none;'>Set reminders using the edit button</li>";
                            ?>
                        </ul>
                    </form>
                    <?php

                    if (isset($_POST['delete_reminders'])) {
                        $goal_id = $_POST['ip_reminder_id']; // Get the goal_id from the hidden input
                        $sql_delete = "DELETE FROM reminders WHERE reminder_id = '$reminder_id'";
                        if (!$conn->query($sql_delete) === TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        echo '<script>window.location.href = "dashboard.php";</script>';
                    }

                    ?>
                <?php else : ?>
                    <form class="add-reminder" method="POST">
                        <div id="newReminder">
                            <!-- New text box and button pairs will be added here -->
                        </div>
                        <div class="button-container">
                            <div class="newReminderButton">
                                <button class="square-button-new-reminders" type="button" onclick="addNewReminder()">
                                    <i class="fa-solid fa-square-plus" style="color: #25a825;"></i>
                                </button>
                            </div>
                            <div class="submitButton" style="display: none;">
                                <button class="square-button-save-new-reminders" type="submit" name="add_reminder">
                                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                                </button>
                            </div>
                        </div>
                    </form>


                    <script>
                        function addNewReminder() {
                            // Create a new div to contain the text box, delete button, and "Add reminder" button
                            var reminderDiv = document.createElement("div");

                            // Create new input field
                            var newInputRemindes = document.createElement("input");
                            newInputRemindes.type = "text";
                            newInputRemindes.name = "newReminder[]";
                            newInputRemindes.className = "newReminder";
                            newInputRemindes.placeholder = "Enter a new reminder";
                            newInputRemindes.required = true;

                            // Create a delete button for the text box
                            var deleteButton = document.createElement("button");
                            deleteButton.type = "button";
                            deleteButton.className = "square-button-delete-reminders";
                            var trashIcon = document.createElement("i");
                            trashIcon.className = "fa-solid fa-trash";
                            trashIcon.style.color = "#ff0000";
                            deleteButton.appendChild(trashIcon);
                            deleteButton.onclick = function() {
                                // Remove the entire div when the delete button is clicked
                                reminderDiv.remove();
                                checkSaveButtonVisibilityReminders();
                            };

                            // Append the new elements to the div
                            reminderDiv.appendChild(newInputRemindes);
                            reminderDiv.appendChild(deleteButton);

                            // Append the div to the form
                            var newReminderDiv = document.getElementById("newReminder");
                            newReminderDiv.appendChild(reminderDiv);

                            // Show the "Add reminder" button when a form is added
                            checkSaveButtonVisibilityReminders();
                        }

                        function checkSaveButtonVisibilityReminders() {
                            // Show the "Save Reminders" button when there's at least one form
                            var submitButton = document.querySelector(".submitButton");
                            var newReminderDiv = document.getElementById("newReminder");
                            var forms = newReminderDiv.querySelectorAll("div");
                            if (forms.length > 0) {
                                submitButton.style.display = "block";
                            } else {
                                submitButton.style.display = "none";
                            }
                        }
                    </script>
                <?php endif; ?>
                <?php
                if (isset($_POST['add_reminder'])) {
                    $reminders = $_POST['newReminder'];

                    foreach ($reminders as $reminder) {
                        $sql = "INSERT INTO reminders (reminder_text, UID) VALUES ('$reminder', '$SID')"; // Replace $SID with your user ID

                        if (!$conn->query($sql) === TRUE)
                            echo "<p>Reminder insertion unsuccessful: " . $reminder . "<br></p>";
                        else {

                            $_SESSION['reminder-toggle'] = 'on';
                            echo '<script>window.location.href = "dashboard.php";</script>';
                        }
                    }
                }
                ?>
            </div><!-- EEEEEEEEEEEEEEEEE DIVVVVVVVVV IS FROM THE PHP INCLUDE  -->
        </div>
        <div class="container-third">
            <div class="section top">
                <div class="section-header">Strength
                    <div class="icon">
                        <i class="fa-solid fa-hand-fist" style="color: #25a825;"></i>
                    </div>
                </div>
                <canvas id="myLineChart"></canvas>

                <script>
                    // Sample data for the line chart
                    var data = {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Strength',
                            borderColor: 'rgb(75, 192, 192)',
                            data: [10, 20, 15, 30, 25],
                            fill: false
                        }]
                    };

                    var options = {
                        responsive: false, // Disable responsiveness
                        maintainAspectRatio: false, // Allow chart to have custom dimensions
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    };

                    // Get the canvas element and set its dimensions
                    var canvas = document.getElementById('myLineChart');
                    canvas.width = 850; // Set your desired width
                    canvas.height = 250; // Set your desired height

                    // Initialize the chart
                    var myLineChart = new Chart(canvas.getContext('2d'), {
                        type: 'line',
                        data: data,
                        options: options
                    });

                    // Get the data values
                    var salesData = data.datasets[0].data;
                    var lastIndex = salesData.length - 1;
                    var lastValue = salesData[lastIndex];
                    var secondLastValue = salesData[lastIndex - 1];

                    // Determine the borderColor based on the value change
                    var borderColor = 'rgb(75, 192, 192)'; // Default color
                    if (lastValue > secondLastValue) {
                        borderColor = 'rgb(0, 255, 0)'; // Green for increase
                    } else if (lastValue < secondLastValue) {
                        borderColor = 'rgb(255, 0, 0)'; // Red for decrease
                    } else {
                        borderColor = 'rgb(0, 0, 255)'; // Blue for no change
                    }

                    // Update the chart's dataset borderColor
                    myLineChart.data.datasets[0].borderColor = borderColor;
                    myLineChart.update(); // Update the chart to apply changes
                </script>
            </div>
            <?php
            if (!isset($_SESSION['bodyweight-toggle'])) {
                $_SESSION['bodyweight-toggle'] = 'on'; // Default to 'on' if not set
            }

            if (isset($_POST['bodyweight-edit'])) {
                // Toggle the state when the button is clicked
                $_SESSION['bodyweight-toggle'] = ($_SESSION['bodyweight-toggle'] === 'on') ? 'off' : 'on';
            }
            ?>
            <div class="section bottom">
                <div class="section-header">BodyWeight
                    <div class="icon">
                        <i class="fa-solid fa-weight-scale" style="color: #25a825;"></i>
                    </div>
                    <form class="bodyWeight-form" method="POST">
                        <button type="submit" class="square-button-bodyWeight" name="bodyweight-edit">
                            <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                        </button>
                    </form>
                </div>
                <?php
                if ($_SESSION['bodyweight-toggle'] === 'on') :
                ?>
                    <div id="chartContainer">
                        <?php
                        $query = "SELECT date, weight FROM bodyweight WHERE uid='$SID' ORDER BY date ASC";
                        $result = $conn->query($query);

                        $labels = [];
                        $weightData = [];

                        while ($row = $result->fetch_assoc()) {
                            $labels[] = ($row['date']);
                            $weightData[] = $row['weight'];
                        }

                        $lineData2 = [
                            'labels' => $labels,
                            'datasets' => [
                                [
                                    'label' => 'Body weight',
                                    'borderColor' => 'rgb(255, 99, 132)',
                                    'data' => $weightData,
                                    'fill' => false
                                ]
                            ]
                        ];
                        $result->close(); // Close the result set
                        ?>

                        <?php
                        if (count($lineData2['labels']) > 0 && count($lineData2['datasets'][0]['data']) > 0) :
                            //       echo "lineData2 Contents:";
                            // echo "<pre>";
                            // var_dump($lineData2);
                            // echo "</pre>";
                        ?>
                            <canvas id="lineChart2"></canvas>
                            <script>
                                // Sample data for Line Chart 2
                                var lineData2 = <?php echo json_encode($lineData2); ?>;

                                // Configuration options for Line Chart 2
                                var options = {
                                    responsive: false,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                };

                                if (lineData2.labels.length > 0 && lineData2.datasets[0].data.length > 0) {
                                    // Get the canvas element and initialize Line Chart 2
                                    var lineCanvas2 = document.getElementById('lineChart2');
                                    lineCanvas2.width = 850; // Set your desired width
                                    lineCanvas2.height = 228; // Set your desired height
                                    var lineChart2 = new Chart(lineCanvas2.getContext('2d'), {
                                        type: 'line',
                                        data: lineData2,
                                        options: options
                                    });

                                    // Get the data values
                                    var weightData = lineData2.datasets[0].data;
                                    var lastIndex = weightData.length - 1;
                                    var lastValue = weightData[lastIndex];
                                    var secondLastValue = weightData[lastIndex - 1];

                                    // Determine the borderColor based on the value change
                                    var borderColor = 'rgb(255, 99, 132)'; // Default color
                                    if (lastValue > secondLastValue) {
                                        borderColor = 'rgb(255, 0, 0)'; // Green for decrease
                                    } else if (lastValue < secondLastValue) {
                                        borderColor = 'rgb(0, 255, 0)'; // Red for decrease
                                    } else {
                                        borderColor = 'rgb(0, 0, 255)'; // Blue for no change
                                    }

                                    // Update the chart's dataset borderColor
                                    lineChart2.data.datasets[0].borderColor = borderColor;
                                    lineChart2.update(); // Update the chart to apply changes
                                }
                            </script>
                        <?php else : ?>
                            <ul>
                                <li style='list-style-type: none;'>Log weight to see the analytics.</li>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php else : ?>

                    <form class="add-bodyweight" method="POST">
                        <div id="newBodyweight">
                            <!-- New text box and button pairs will be added here -->
                        </div>
                        <div class="button-container">
                            <div class="newBodyweightButton">
                                <input type="numbers" class="newBodyweight" placeholder="Enter Bodyweight (KG)" name="bdweight" required>
                            </div>
                            <!-- <button class="square-button-delete-bodyWeight" > -->
                            <!-- <i class="fa-solid fa-trash" style="color: #ff0000;"></i> -->
                            <!-- </button> -->

                            <div class="submitButton">
                                <button class="square-button-save-new-bodyWeight" type="submit" name="add_bodyweight">
                                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                                </button>
                            </div>
                        </div>
            </div>
            </form>
        <?php endif; ?>
        </div>
        <?php
        if (isset($_POST['add_bodyweight'])) {
            $bodyweight = $_POST['bdweight'];
            $sql = "INSERT INTO bodyweight (uid,weight,date) VALUES('$SID','$bodyweight',CURDATE())";
            if (!$conn->query($sql) === TRUE)
                echo "<p>Bodyweight insertion unsuccessful: " . $bodyweight . "<br></p>";
            else {

                $_SESSION['bodyweight-toggle'] = 'on';
                echo '<script>window.location.href = "dashboard.php";</script>';
            }
        }
        ?>
    </div>
    </div>
</body>

</html>