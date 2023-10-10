<?php
session_start();
if (!isset($_SESSION['option-toggle-current'])) {
  $_SESSION['option-toggle-current'] = 'on'; // Default to 'on' if not set
  $_SESSION['option-toggle-muscle'] = 'off';
  $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-current'])) {
  // Toggle the state when the button is clicked
  $_SESSION['option-toggle-current'] = 'on';
  $_SESSION['option-toggle-muscle'] = 'off';
  $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-muscle'])) {

  $_SESSION['option-toggle-current'] = 'off';
  $_SESSION['option-toggle-muscle'] = 'on';
  $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-all'])) {
  $_SESSION['option-toggle-current'] = 'off';
  $_SESSION['option-toggle-muscle'] = 'off';
  $_SESSION['option-toggle-all'] = 'on';
}
?>

<html>

<head>
  <title>Analytics</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="analytics.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div id="navigation">
    <?php include 'navmain.php'; ?>
  </div>
  <div class="main-container-analytics">
    <?php
    $current = $_SESSION['option-toggle-current'];
    $muscle = $_SESSION['option-toggle-muscle'];
    $all = $_SESSION['option-toggle-all'];
    ?>
    <form method="post">
      <div class="container-options">
        <button class="option-button" name="filter-current">
          <div class="sec options 
          <?php if ($current == 'on') {echo 'checked';} else {echo 'unchecked';} ?> " id="filter-current">
            <div class="section-header-analytics">CURRENT DAY
              <div class="icon">
                <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
              </div>
            </div>
          </div>
        </button>
        <button class="option-button" name="filter-muscle">
          <div class="sec options <?php if ($muscle == 'on') {echo 'checked';} else {echo 'unchecked';} ?>" id="filter-muscle">
            <div class="section-header-analytics">MUSCLE GROUP
              <div class="icon">
                <i class="fa-solid fa-dumbbell" style="color: #25a825;"></i>
              </div>
            </div>
          </div>
        </button>
        <button class="option-button" name="filter-all">
          <div class="sec options 
          <?php if ($all == 'on') {echo 'checked';} else {echo 'unchecked';} ?>" id="filter-all">
            <div class="section-header-analytics">ALL LOGS
              <div class="icon">
                <i class="material-symbols-outlined" style="font-size:30px;color:#25a825;position:relative;bottom:2px;">select_all</i>
              </div>
            </div>
          </div>
        </button>
      </div>
    </form>
    <?php 
    if ($current == 'on') {include 'Analytics_Current_Day.php';}
    if ($muscle == 'on') {include 'Analytics_Muscle.php';}
    if ($all == 'on') {include 'Analytics_All.php';} 
    ?>
  </div>
</body>

</html>