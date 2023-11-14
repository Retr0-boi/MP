<html>

<head>
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div id="navigation">
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
    if (!empty($_SESSION['SUID'])) {
      $SID = $_SESSION['SUID'];
    } else {
      $page =  substr($_SERVER['SCRIPT_NAME'], 4);
      if ($page != 'homepage.php')
        header('location:homepage.php');
    }
    ?>
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


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
          console.log("scroll loader worked yay :D");
        }
      });
    </script>
    <nav>
      <div class="logo">
        <a href="homepage.php">Gym Routine Tracker</a>
      </div>
      <div class="topnav">

        <?php

        $page =  substr($_SERVER['SCRIPT_NAME'], 4);
        if (isset($_SESSION['SUID'])) {
          if ($page != 'dashboard.php') : ?>
            <a href="dashboard.php" name="nav_dashboard"><i class="fa-solid fa-house" id="nav-icon-dashboard"></i>Dashboard</a>
          <?php endif ?>
          <?php if ($page != 'workouts.php') : ?>
            <a href="workouts.php" name="nav_workouts"><i class="fa-solid fa-dumbbell" id="nav-icon-workouts"></i>Workouts</a>
          <?php endif ?>
          <?php if ($page != 'goals.php') : ?>
            <a href="goals.php" name="nav_goals"><i class="fa-solid fa-bullseye" id="nav-icon-goals"></i>Goals</a>
          <?php endif ?>
          <!-- <a href="#">Reminders</a> -->
          <?php if ($page != 'analytics.php') : ?>
            <a href="analytics.php" name="nav_analytics"><i class="fa-solid fa-chart-line" id="nav-icon-analytics"></i>Analytics</a>
          <?php endif ?>
          <?php if ($page != 'profile.php') : ?>
            <a href="profile.php" name="nav_profile"><i class="fa-solid fa-user" id="nav-icon-profile"></i>Profile</a>
          <?php endif ?>
          <?php if ($page == 'homepage.php') : ?>
            <a href="contact_us.php" name="nav_contact"><i class="fa-solid fa-comments" id="nav-icon-contact"></i>Contact Us</a>
          <?php endif ?>
          <a href="logout.php" name="nav_logout"><i class="fa-solid fa-right-from-bracket" id="nav-icon-logout"></i>Logout</a>
        <?php
        } else { ?>
          <a href="demo.php" name="nav_demo"><i class="fa-solid fa-magnifying-glass" id="nav-icon-demo"></i>Demo</a>
          <!-- <a href="#" name="nav_about"><i class="fa-solid fa-circle-info" id="nav-icon-info"></i>About</a> -->
          <a href="login.php" name="nav_login"><i class="fa-solid fa-right-to-bracket" id="nav-icon-login"></i>Login</a>
          <a href="register.php" name="nav_signup"><i class="fa-solid fa-user-plus" id="nav-icon-signup"></i>Sign Up</a>
        <?php
        }
        ?>
      </div>
    </nav>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const nav_icons = {
          info: document.getElementById('nav-icon-info'),
          login: document.getElementById('nav-icon-login'),
          signup: document.getElementById('nav-icon-signup'),
          dashboard: document.getElementById('nav-icon-dashboard'),
          workouts: document.getElementById('nav-icon-workouts'),
          goals: document.getElementById('nav-icon-goals'),
          profile: document.getElementById('nav-icon-profile'),
          logout: document.getElementById('nav-icon-logout'),
          analytics: document.getElementById('nav-icon-analytics'),
          demo: document.getElementById('nav-icon-demo'),
          contact: document.getElementById('nav-icon-contact'),
        };
      });
      // Get all the .topnav a elements by name
      const nav_links = {
        nav_about: document.querySelector('[name="nav_about"]'),
        nav_login: document.querySelector('[name="nav_login"]'),
        nav_signup: document.querySelector('[name="nav_signup"]'),
        nav_dashboard: document.querySelector('[name="nav_dashboard"]'),
        nav_workouts: document.querySelector('[name="nav_workouts"]'),
        nav_goals: document.querySelector('[name="nav_goals"]'),
        nav_profile: document.querySelector('[name="nav_profile"]'),
        nav_logout: document.querySelector('[name="nav_logout"]'),
        nav_analytics: document.querySelector('[name="nav_analytics"]'),
        nav_demo: document.querySelector('[name="nav_demo"]'),
        nav_contact: document.querySelector('[name="nav_contact"]'),
      };

      // Common hover event listener
      function handleHover(navLinkId, navIconId) {
        const nav_link = nav_links[navLinkId];
        const nav_icon = nav_icons[navIconId];
        // console.log("Adding event listener to nav_about");
        nav_link.addEventListener('mouseenter', () => {
          console.log("Mouse enter nav_about");
          nav_icon.style.color = 'var(--background)';
        });

        nav_link.addEventListener('mouseleave', () => {
          // console.log("Mouse left nav_about");
          nav_icon.style.color = 'var(--tertiary)';
        });
      }

      // Add hover effect for specific links and icons
      handleHover('nav_about', 'info');
      handleHover('nav_login', 'login');
      handleHover('nav_signup', 'signup');
      handleHover('nav_dashboard', 'dashboard');
      handleHover('nav_workouts', 'workouts');
      handleHover('nav_goals', 'goals');
      handleHover('nav_profile', 'profile');
      handleHover('nav_logout', 'logout');
      handleHover('nav_analytics', 'analytics');
      handleHover('nav_demo', 'demo');
      handleHover('nav_contact', 'contact');
    </script>
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
          $sql_day = "SELECT d_id,d_full FROM days WHERE day='$currentDay'";

          $result_day = $conn->query($sql_day);
          $row_day = $result_day->fetch_assoc();
          $d_id = $row_day["d_id"];
          $d_full = $row_day['d_full'];

          $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$d_id'";
          $result_exercises = $conn->query($sql_exercise);
          if ($result_exercises->num_rows > 0) {
            echo "<div class='day-today'>";
            echo "<h2>" . $d_full . "</h2>";
            while ($row_exercise = $result_exercises->fetch_assoc()) {
              $ex_id = $row_exercise["ex_id"];
              $sql_ex_details = "SELECT ex_name FROM exercises WHERE ex_id='$ex_id'";

              $ex_name_result = $conn->query($sql_ex_details);
              $result_ex_name = $ex_name_result->fetch_assoc();
              echo '<li>' . $result_ex_name["ex_name"] . '</li>';
            }
            echo "</div>";
          } else { ?>
            <li style='list-style-type: none;'>You have no exercises today</li>
            <li style='list-style-type: none;'><a href='analytics.php' style="text-decoration:none;">View analytics</a></li>

          <?php
          }
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
          <?php
          $check = "SELECT * FROM logged_weights WHERE UID='$SID' ORDER BY date DESC LIMIT 1";

          $res = $conn->query($check);
          if ($res->num_rows > 0) {
            $IsAlreadySet = 0;
          } else {
            $IsAlreadySet = 1;
          }
          $currentDay = date("D"); // "D" format returns abbreviated day name (e.g., Mon, Tue, etc.)
          $sql_day = "SELECT d_id,d_full FROM days WHERE day='$currentDay'";

          $result_day = $conn->query($sql_day);
          $row_day = $result_day->fetch_assoc();
          $d_id = $row_day["d_id"];

          $result_weight = ['weight' => 0];

          $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$d_id'";
          $result_exercises = $conn->query($sql_exercise);
          if ($result_exercises->num_rows > 0) {
            echo "<div class='day-today'>";
            while ($row_exercise = $result_exercises->fetch_assoc()) {
              $ex_id = $row_exercise["ex_id"];
              $sql_ex_details = "SELECT ex_name FROM exercises WHERE ex_id='$ex_id'";

              $ex_name_result = $conn->query($sql_ex_details);
              $result_ex_name = $ex_name_result->fetch_assoc();
              $logged_weight = null;
              if ($IsAlreadySet === 0) {
                $getvalues = "SELECT * FROM logged_weights WHERE ex_id='$ex_id' AND UID='$SID' AND date=CURDATE()";
                $result_query = $conn->query($getvalues);
                if ($result_query->num_rows > 0) {
                  $result_weight = $result_query->fetch_assoc();
                  $logged_weight = $result_weight['weight'];
                } else {
                  $IsAlreadySet = 1;
                }
              }
          ?>
              <form class="DashLogWeights" method="post">
                <li><?php echo $result_ex_name["ex_name"] ?>
                  <input type="text" name="exercise_<?php echo $ex_id; ?>" hidden>
                  <input class="log_weights" type="number" name="weight_<?php echo $ex_id; ?>" <?php if ($IsAlreadySet === 0) { ?> value="<?php echo $logged_weight; ?>" <?php } else { ?> placeholder="0" <?php } ?>>
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
                foreach ($_POST as $key => $value) {
                  if (strpos($key, 'weight_') === 0) {
                    $ex_id = substr($key, strlen('weight_'));
                    $new_weight = $_POST['weight_' . $ex_id];
                    $update_query = "UPDATE logged_weights SET weight = '$new_weight' WHERE ex_id = '$ex_id' AND UID = '$SID' AND date = CURDATE()";
                    $conn->query($update_query);
                  }
                }
                echo "<script>window.location='dashboard.php'</script>";
              }
              ?>
              <div class="update-submit-logweights">
                <?php if ($IsAlreadySet == 1) : ?>
                  <button name="submit-weights" class="bottom-right-button-log">
                    <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                  </button>
                <?php else : ?>
                  <button name="update-weights" class="bottom-right-button-log">
                    <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                  </button>
                <?php endif; ?>
              </div>

              </form>
            <?php
          } else { ?>
              <li style='list-style-type: none;'>No weights to log today </li>
              <li style='list-style-type: none;'><a href='analytics.php' style="text-decoration:none;">View analytics</a></li>
            <?php }
            ?>
        </ul>
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
        // Toggle the state
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
              </a>
            </button>
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
            $goal_id = $_POST['ip_reminder_id'];
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
          var reminderDiv = document.createElement("div");

          var newInputReminders = document.createElement("input");
          newInputReminders.type = "text";
          newInputReminders.name = "newReminder[]";
          newInputReminders.className = "newReminder";
          newInputReminders.placeholder = "Enter a new reminder";
          newInputReminders.required = true;

          var frequencyDropdown = document.createElement("select");
          frequencyDropdown.name = "reminderFrequency[]";
          frequencyDropdown.className = "freqReminder";
          frequencyDropdown.required = true;
          var frequencyOptions = ["Daily", "Weekly", "Monthly"];
          var frequencyValues = ["daily", "weekly", "monthly"];

          for (var i = 0; i < frequencyOptions.length; i++) {
            var option = document.createElement("option");
            option.className = 'freqOpt';
            option.value = frequencyValues[i];
            option.text = frequencyOptions[i];
            frequencyDropdown.appendChild(option);
          }

          var deleteButton = document.createElement("button");
          deleteButton.type = "button";
          deleteButton.className = "square-button-delete-reminders";
          var trashIcon = document.createElement("i");
          trashIcon.className = "fa-solid fa-trash";
          trashIcon.style.color = "#ff0000";
          deleteButton.appendChild(trashIcon);
          deleteButton.onclick = function() {
            reminderDiv.remove();
            checkSaveButtonVisibilityReminders();
          };

          reminderDiv.appendChild(newInputReminders);
          reminderDiv.appendChild(frequencyDropdown);
          reminderDiv.appendChild(deleteButton);

          var newReminderDiv = document.getElementById("newReminder");
          newReminderDiv.appendChild(reminderDiv);

          checkSaveButtonVisibilityReminders();
        }


        function checkSaveButtonVisibilityReminders() {
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
      $frequencies = $_POST['reminderFrequency'];

      for ($i = 0; $i < count($reminders); $i++) {
        $reminder = $reminders[$i];
        $frequency = $frequencies[$i];

        $sql = "INSERT INTO reminders (reminder_text, frequency, UID) VALUES ('$reminder', '$frequency', '$SID')";

        if (!$conn->query($sql) === TRUE) {
          echo "<p>Reminder insertion unsuccessful: " . $reminder . "<br></p>";
        } else {
          $_SESSION['reminder-toggle'] = 'on';
          echo '<script>window.location.href = "dashboard.php";</script>';
        }
      }
    }
    ?>
      </div>

    </div>

    <div class="container-third">
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
                  lineCanvas2.width = 1800; // Set your desired width
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


              <!-- <form class="bodyWeight-form" method="POST">
                < button type="submit" class="square-button-bodyWeight-none" name="bodyweight-edit">
                <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
                </button>
              </form> -->

              <ul>
                <li style='list-style-type: none;'>Log weight to see the analytics.</li>
              </ul>
              <!-- </form> -->
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
            </form>

      </div>
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
</body>

</html>