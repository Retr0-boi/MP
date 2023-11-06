<html>

<head>
    <title>Contact us</title>
    <link rel="stylesheet" href="contact.css">

</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container" >
        <?php 
        if(isset($_POST['send-message'])){
            $subject = $_POST["subject"];
            $content = $_POST["content"];
        
        $qry = $conn->prepare("INSERT INTO enquiries (subject, content, uid,date) VALUES (?, ?, ?,CURDATE())");
        $qry->bind_param("sss", $subject, $content, $SID);
        if($qry->execute())
        {
            echo "<script>alert('message sent successfully');</script>";
            echo "<script>window.location.href='dashboard.php';</script>";
        }else {
            echo $conn->error;
        }
        }
        ?>
        <form method="post">
            <div class="container-first" style="height:83%;">
                <div class="section top"style="height:95%;">
                    <div class="section-header">SUBJECT
                        <div class="icon">
                            <!-- <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i> -->
                            <i class="material-symbols-outlined" style="font-size:30px; position:relative;top:2px;color: #25a825;">subject</i>
                        </div>
                    </div>
                    <br>
                    <input type="text" class="contact-us" name="subject" maxlength="100" required>
                    <br><br>
                    <div class="section-header">CONTENT
                        <div class="icon">
                            <!-- <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i> -->
                            <span class="material-symbols-outlined"style="font-size:30px; position:relative;top:2px;color: #25a825;">description</span>
                        </div>
                    </div>
                    <br>
                    <textarea rows="100" cols="100" class="content" name="content" maxlength="500"></textarea>
                    <br><br>    
                    <div class="section-header">CONTENT
                        <div class="icon">
                            <!-- <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i> -->
                            <span class="material-symbols-outlined"style="font-size:30px; position:relative;top:2px;color: #25a825;">send</span>

                        </div>
                    </div>
                    <br>
                    <button type="submit" class="submit-message" name="send-message">SUBMIT MESSAGE 
                        <span class="material-symbols-outlined"style="font-size:30px; position:relative;top:8px;color: #051131;">send</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>