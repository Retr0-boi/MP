<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profile.css">

    <title>User Profile</title>
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>

    </div>
    <div class="profile-container">
        <div class="container-profile">
            <div class="section top">
                <div class="section-header">USER PROFILE
                    <div class="icon">
                        <i class="fa-solid fa-user" style="color: #25a825;"></i>
                    </div>
                </div>
                <?php
                $query_profile="SELECT * FROM users";
                $res=$conn->query($query_profile);
                $row=$res->fetch_assoc();
                ?>
                <table class="profile_table">
                <tr>
                <th>Username <th>
                <th>:</th>
                <td><?php echo$row['username'];?></th>
                </tr>
                <tr>    
                <th>Email <th>
                <th>:</th>
                <td><?php echo$row['email'];?></th>
                </tr>
                <tr>    
                <th>Created on <th>
                <th>:</th>
                <td><?php echo$row['date'];?></th>
                </tr>
                </table>
            </div>
        </div>
        <div class="container-profile">
            <div class="section top">
                <div class="section-header">CHANGE PROFILE
                    <div class="icon">
                        <i class="fa-solid fa-address-card" style="color: #25a825;"></i>
                    </div>
                </div>
                <form class="profileForm" method="post">
                    <div class="form-item">
                        <input type="text" id="newUsername" name="newUsername" placeholder="Change Username" required>
                    </div>
                    <div class="form-item">
                        <input type="email" id="newEmail" name="newEmail" placeholder="Change Email" required>
                    </div>
                    <div class="form-item">
                        <input type="password" id="newPassword" name="newPassword" placeholder="Change Password" required>
                    </div>

                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>
        <div class="container-profile">
            <div class="section top">
                <div class="section-header">DELETE DATA
                    <div class="icon">
                        <!-- <i class="fa-solid fa-address-card" ></i> -->
                        <span class="material-symbols-outlined"style="color: #25a825;font-size:30px;position:relative;top:2px;">database</span>
                    </div>
                </div>
                <form class ="Delete_profile" method="post">
                    <button class="delete_button" name="delete_data" >Delete all logged data</button>
                    <?php
                     if(isset($_POST['delete_data'])){?>
                     <div class="deletoin_confirmation">
                        <input type="text" class="confirmation"placeholder="Enter password" required>
                        <button class="delete_button" name="act_delete_data" onclick="confirmDeleteData()">
                        <span class="material-symbols-outlined" style="font-size:30px;position:relative;top:18px;">delete_sweep</span>
                        </button>           
                     </div>         
                    <?php
                     }
                    ?>
                    <br>
                    <button class="delete_button" name="delete_all" onclick="confirmDeleteAll()">Delete account</button>
                    <?php
                     if(isset($_POST['delete_all'])){ ?>
                        <div class="deletoin_confirmation">
                        <input type="text" class="confirmation"placeholder="Enter password" required>
                        <button class="delete_button" name="act_delete_all" onclick="confirmDeleteData()">
                        <span class="material-symbols-outlined" style="font-size:30px;position:relative;top:18px;">delete_sweep</span>
                        </button>
                        <?php
                        if(isset($_POST['act_delete_all'])){
                            $del_data_qry_workouts="DELETE * FROM workouts WHERE uid='$SID'";
                            $del_data_qry_reminders="DELETE * FROM reminders WHERE uid='$SID'";
                            $del_data_qry_previous_goals="DELETE * FROM previous_goals WHERE uid='$SID'";
                            $del_data_qry_logged_weights="DELETE * FROM logged_weights WHERE uid='$SID'";
                            $del_data_qry_goals="DELETE * FROM goals WHERE uid='$SID'";
                            $del_data_bodyweight="DELETE * FROM bodyweight WHERE uid='$SID'";
                        }
                        ?>
                     </div>
                     <?php }
                    ?>
                </form>
            </div>
        </div>
    </div>



    <script>
        function confirmDeleteData() {
            confirm("Are you sure you want to delete all your data? \nThis action cannot be undone.");
        }
        function confirmDeleteAll() {
            if (confirm("Are you sure you want to delete your account? \nThis action cannot be undone.")) {
                window.location.href = "delete_all.php";
            }
        }
    </script>
</body>

</html>