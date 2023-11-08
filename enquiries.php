<html>

<head>
    <title>enquiries</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="enquiry.css">
</head>

<body>

    <div id="navigation">
        <?php include 'navadmin.php'; ?>
    </div>
    <div class="main-container">
        <div class="container-first-enq">
            <div class="section top enquiries-left">
                <div class="section-header">ENQUIRIES
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                    </div>
                </div>
                <form method="post">
                <?php
                $qry = "SELECT * FROM enquiries ORDER BY date DESC";
                $result = $conn->query($qry);
                if ($result->num_rows > 0) {
                    $noenq=0;
                    while ($row = $result->fetch_assoc()) {
                        $sub = $row['subject'];
                        $enq_id=$row['enq_id'];
                        $date=$row['date'];
                ?>
                        <li><?php echo $date; ?></li><br>
                        <button class='enqs'type="submit" name="show" value="<?php echo $enq_id ?>">
                            <?php echo $sub; ?>
                        </button>
                <?php
                    }
                } else {
                    echo "uh oh looks like this is empty...";
                    $noenq=1;
                } ?>
                </form>
            </div>
            <div class="section bottom enquiries-right">
                
                <?php
                if (isset($_POST['show']) && $noenq==0) {
                    $content_id = $_POST['show'];
                    $art = "SELECT * FROM enquiries where enq_id='$content_id'";
                    $resart = $conn->query($art);
                    $row = $resart->fetch_assoc();
                    $subject = $row['subject'];
                    $content = $row['content'];
                ?>
                <div class="section-header">SUBJECT<br><br><?php echo $subject; ?>
                    <!-- <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                        <span class="material-symbols-outlined"style="font-size:30px; position:relative;top:4px;color: #25a825;">title</span>
                    </div> -->
                </div>
                <br><br>
                    <p><?php echo $content; ?></p>
                <?php } elseif($noenq==1){
                    echo "<h2>you do not have any enquiries at the moment</h2>";
                }else {
                    echo "<h2>select an enquiry</h2>";
                }
                ?>
            </div>

        </div>

    </div>
</body>

</html>