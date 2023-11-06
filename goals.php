<!DOCTYPE html>
<html>

<head>
  <title>Goals</title>
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
  <div id="navigation">
    <?php include 'navmain.php'; ?>
  </div>
  <div class="main-container">

    <div class="container-first-add">
      <div class="section topmost">
        <div class="section-header">ADD GOALS
          <div class="icon">
            <i class="fa-solid fa-square-plus" style="color: #25a825;"></i>
          </div>
        </div>
        <form class="add-goalpage" method="POST">
          <div id="newGoalpage">


            <div class="button-container">
              <div class="newGoalpageButton">
                <input type="text" class="newGoalpage" placeholder="Enter Goal" name="new-goalpage" required>
              </div>
              <div class="submitButton">
                <button class="square-button-save-new-goalpage" type="submit" name="add_goalpage">
                  <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
                </button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
    <?php
    if (isset($_POST['add_goalpage'])) {
      $goal = $_POST['new-goalpage'];

      $sql = "INSERT INTO goals (goal_description, UID) VALUES ('$goal', '$SID')"; // Replace $SID with your user ID

      if (!$conn->query($sql) === TRUE)
        echo "<p>Goal insertion unsuccessful: " . $goal . "<br></p>";
      else {

        $_SESSION['goal-toggle'] = 'on';
        echo '<script>window.location.href = "dashboard.php";</script>';
      }
    }
    ?>
    <div class="container-first-goals">

      <div class="section top">
        <div class="section-header">ACTIVE GOALS
          <div class="icon">
            <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
          </div>

        </div>
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
                      <div class="goalpage-buttons">
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
                echo "Error: " . $sql . "<br>" . $conn->$error;
              }
            } else {
              echo "Error: " . $sql . "<br>" . $conn->$error;
            }
          }
          echo '<script>window.location.href = "goals.php";</script>';
        }
        ?>
      </div>
    </div>
    <div class="container-second">
      <div class="section bottom">
        <div class="section-header">COMPLETED GOALS
          <div class="icon">
            <i class="fa-solid fa-star" style="color: #25a825;"></i>
          </div>

        </div>
        <form method='post'>
          <ul>
            <?php
            $sql_goals = "SELECT * FROM previous_goals WHERE UID = '$SID' AND completed=1 ORDER BY date ASC";
            $result_goals = $conn->query($sql_goals);

            if ($result_goals->num_rows > 0) {
              while ($row_goals = $result_goals->fetch_assoc()) {
                $goal_id = $row_goals["g_id"];
                $goal_desc = $row_goals["goal_desc"];
            ?>
                <li>
                  <form method='post'>
                    <div class="goal-list">
                      <div class="goal-desc">
                        <?php echo $goal_desc; ?>
                        <input type="hidden" name="ip_goal_id" value="<?php echo $goal_id; ?>">
                      </div>
                      
                    </div>
                  </form>
                </li>
            <?php
              }
            } else {
              echo "<li style='list-style-type: none;'>You have not set/completed any goals</li>";
            }
            ?>
          </ul>

        </form>
      </div>
    </div>

    <div class="container-third">
      <div class="section top">
        <div class="section-header">INCOMPLETE GOALS
          <div class="icon">
            <i class="fa-solid fa-xmark" style="color: #25a825;"></i>
          </div>

        </div>
        <form method='post'>
          <ul>
            <?php
            $sql_goals = "SELECT * FROM previous_goals WHERE UID = '$SID' AND completed=0 ORDER BY date ASC";
            $result_goals = $conn->query($sql_goals);

            if ($result_goals->num_rows > 0) {
              while ($row_goals = $result_goals->fetch_assoc()) {
                $add_goal_id = $row_goals["g_id"];
                $goal_desc = $row_goals["goal_desc"];
            ?>
                <li>
                  <form method='post'>
                    <div class="goal-list">
                      <div class="goal-desc">
                        <?php echo $goal_desc; ?>
                        <input type="hidden" name="add_again_ip_goal_id" value="<?php echo $add_goal_id; ?>">
                      </div>
                      <div class="goal-buttons-add">
                    <button type="submit" class="square-button-add-again" name="add_again">
                      <i class="fa-solid fa-circle-plus" style="color: #25a825;"></i>
                    </button>
              </button>
                    </div>
                  </form>
                </li>
            <?php
              }
            } else {
              echo "<li style='list-style-type: none;'>You have not set/completed any goals</li>";
            }
            ?>
          </ul>
        </form>
        <?php
        if (isset($_POST['add_again'])) {
          $add_goal_id = $_POST['add_again_ip_goal_id']; // Get the goal_id from the hidden input
          $sql = "SELECT * FROM previous_goals WHERE g_id = '$add_goal_id'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $goalDesc = $row['goal_desc'];
              $sql_insert = "INSERT INTO goals(uid,goal_description) 
          VALUES('$SID','$goalDesc')";
            if ($conn->query($sql_insert) === TRUE) {
              $sql_delete = "DELETE FROM previous_goals WHERE g_id = '$add_goal_id'";
              if (!$conn->query($sql_delete) === TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->$error;
              }
            } else {
              echo "Error: " . $sql . "<br>" . $conn->$error;
            }
          }
          echo '<script>window.location.href = "goals.php";</script>';
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
