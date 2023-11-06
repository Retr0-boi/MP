
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="dashboard.css">

</head>
<body>
    
         <div id="navigation">
         <?php include 'navmain.php';?> 
        </div> 
        <div class="main-container">
        <div class="content">
            <h2>WELCOME, 
                <?php if(isset($_SESSION['name']))
                        {echo $_SESSION['name'];}?>
            </h2>
            <h1>To Gym Routine Tracker</h1>
        </div>
    </div>
</body>
</html>