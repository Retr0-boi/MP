<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="dashboard.css">
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
    <a href="admin.php">Gym Routine Tracker</a>
  </div>
  <div class="topnav">

    <?php

    $page =  substr($_SERVER['SCRIPT_NAME'], 4);
      if ($page != 'adminAddExercises.php') : ?>
        <a href="adminAddExercises.php" name="nav_add"><i class="fa-solid fa-plus-minus" id="nav-icon-add"></i>Exercises</a>
      <?php endif ?>
      
      <?php if ($page != 'enquiries.php') : ?>
        <a href="enquiries.php" name="nav_enq"><i class="fa-solid fa-comments" id="nav-icon-enq"></i>User Enquiries</a>
      <?php endif ?>
      <a href="logout.php" name="nav_logout"><i class="fa-solid fa-right-from-bracket" id="nav-icon-logout"></i>Logout</a>
    
  </div>
</nav>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const nav_icons = {
      logout: document.getElementById('nav-icon-logout'),
      enq: document.getElementById('nav-icon-enq'),
      add: document.getElementById('nav-icon-add'),
    };
  });
  // Get all the .topnav a elements by name
  const nav_links = {
    nav_logout: document.querySelector('[name="nav_logout"]'),
    nav_enq: document.querySelector('[name="nav_enq"]'),
    nav_add: document.querySelector('[name="nav_add"]'),
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
  handleHover('nav_logout', 'logout');
  handleHover('nav_enq', 'enq');
  handleHover('nav_add', 'add');
</script>