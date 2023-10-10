<!DOCTYPE html>
<html>

<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
  <ul>
    <?php
    $sql_goals = "SELECT * FROM goals WHERE UID = '$SID'";
    $result_goals = $conn->query($sql_goals);
    $firstRow = true;
    if ($result_goals->num_rows > 0) {
      while ($row_goals = $result_goals->fetch_assoc()) {
        $goal_desc = $row_goals["goal_description"];
        if ($firstRow) {
          echo "<li>" . $goal_desc . " <button>Add Goal</button></li>";
          $firstRow = false;
        } else {
          echo "<li>" . $goal_desc . "</li>";
        }
      }
    } else
      echo "<li style='list-style-type: none;'>Set goals using the edit button</li>";
    ?>
  </ul>
<?php else : ?>
  <?php
  $sql_goals = "SELECT * FROM goals WHERE UID = '$SID'";
  $result_goals = $conn->query($sql_goals);
  if ($result_goals->num_rows > 0) {
    // Display values with buttons on the right
    while ($row_goals = $result_goals->fetch_assoc()) {
      $goal_desc = $row_goals["goal_description"];
      echo "<li>" . $goal_desc . " <button>Button 1</button> <button>Button 2</button></li>";
    }
  } else {
    ?>
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
    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = "newGoal";
    newInput.className = "newGoal";
    newInput.placeholder = "Enter a new goal";
    newInput.required = true;

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
      checkSaveButtonVisibility();
    };

    // Append the new elements to the div
    goalDiv.appendChild(newInput);
    goalDiv.appendChild(deleteButton);

    // Append the div to the form
    var newGoalDiv = document.getElementById("newGoal");
    newGoalDiv.appendChild(goalDiv);

    // Show the "Add Goal" button when a form is added
    checkSaveButtonVisibility();
  }

  function checkSaveButtonVisibility() {
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


  <?php
  }
  ?>
<?php endif; ?>
</div>
      <div class="section bottom">
        <div class="section-header">REMINDERS
          <div class="icon">
            <i class="fa-solid fa-bell" style="color: #25a825;"></i>
          </div>
          <button class="square-button-reminders"><a href="#" style='text-decoration:none;'>
              <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
            </a></button>
        </div>
        <ul>
          <?php
          $sql_reminders = "SELECT * FROM reminders WHERE UID = '$SID'";
          $result_reminders = $conn->query($sql_reminders);
          if ($result_reminders->num_rows > 0) {
            while ($row_reminders = $result_reminders->fetch_assoc()) {
              $reminder_desc = $row_reminders["reminder_text"];
              echo "<li>" . $reminder_desc . "</li>";
            }
          } else
            echo "<li style='list-style-type: none;'>Set reminders using the edit button</li>";
          ?>
        </ul>
      </div>
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
      <div class="section bottom">
        <div class="section-header">BodyWeight
          <div class="icon">
            <i class="fa-solid fa-weight-scale" style="color: #25a825;"></i>
          </div>
        </div>
        <div id="chartContainer">
          <?php
          $query = "SELECT date, weight FROM bodyweight WHERE uid='$SID' ORDER BY date ASC";
          $result = $conn->query($query);

          $labels = [];
          $weightData = [];

          while ($row = $result->fetch_assoc()) {
            $labels[] = date("M", strtotime($row['date']));
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
          ?>
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
                lineCanvas2.height = 250; // Set your desired height
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
                  borderColor = 'rgb(0, 255, 0)'; // Green for increase
                } else if (lastValue < secondLastValue) {
                  borderColor = 'rgb(255, 0, 0)'; // Red for decrease
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
              <li style='list-style-type: none;'>Log weights to see the analytics.</li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>