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
            $goal_id = $row_goals["goal_id"]; // Add this line to get the goal_id
            $goal_desc = $row_goals["goal_description"];
        ?>
            <div class="goal-list">
              <div class="goal-desc">
                <li><?php echo $goal_desc; ?>
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
              </li>
            </div>
        <?php
          }
        } else
          echo "<li style='list-style-type: none;'>Set goals using the edit button</li>";
        ?>
      
    </form>
    <?php
    if (isset($_POST['completed']) or isset($_POST['deleted'])) {
      $goal_id = $_POST['ip_goal_id']; // Get the goal_id from the hidden input
      $sql = "SELECT goal_description FROM goals WHERE goal_id = '$goal_id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();  
        $goalDescription = $row['goal_description'];
        if(isset($_POST['completed']))
          $sql_insert = "INSERT INTO previous_goals(g_id,uid,goal_desc,date,completed) VALUES('$goal_id','$SID','$goalDescription',CURDATE(),1)";
        else
          $sql_insert = "INSERT INTO previous_goals(g_id,uid,goal_desc,date,completed) VALUES('$goal_id','$SID','$goalDescription',CURDATE(),0)";
        if ($conn->query($sql_insert) === TRUE) {
          $sql_delete = "DELETE FROM goals WHERE goal_id = '$goal_id'";
          if (!$conn->query($sql_delete) === TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    }
    ?>

</ul>
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
        var newInput = document.createElement("input");
        newInput.type = "text";
        newInput.name = "newGoal[]";
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
  <?php endif; ?>
  <?php
  if (isset($_POST['add_goal'])) {
    $goals = $_POST['newGoal'];

    foreach ($goals as $goal) {
      $sql = "INSERT INTO goals (goal_description, UID) VALUES ('$goal', '$SID')"; // Replace $SID with your user ID

      if (!$conn->query($sql) === TRUE)
        echo "<p>Goal insertion unsuccessful: " . $goal . "<br></p>";
    }
  }
  ?>