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