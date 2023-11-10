<html>

<head>
  <title>Dashboard</title>
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
          <?php include 'DashWorkout.php'; ?>
        </ul>
      </div>
      <div class="section top">
        <div class="section-header">LOG WEIGHTS
          <div class="icon">
            <i class="fa-solid fa-cloud-arrow-up" style="color: #25a825;"></i>
          </div>
        </div>
      <?php include 'DashLogWeights.php';?>
      </div>  
    </div>
    <div class="container-second">
      <?php include 'DashGoals.php'; ?>
    </div><!-- EEEEEEEEEEEEEEEEE DIVVVVVVVVV IS FROM THE PHP INCLUDE  -->
    <?php include 'DashReminders.php'; ?>
  </div>
  <div class="container-third">
    <?php include 'DashBodyweight.php';?>
  </div>
  </div>
</body>
</html>