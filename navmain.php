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
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="dashboard.css">
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
  handleHover('nav_analytics', 'analytics')
  handleHover('nav_demo', 'demo');
</script>