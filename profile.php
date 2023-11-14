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
                $query_profile = "SELECT * FROM users where UID=$SID";
                $res = $conn->query($query_profile);
                $row = $res->fetch_assoc();
                ?>
                <table class="profile_table">
                    <tr>
                        <th>Username
                        <th>
                        <th>:</th>
                        <td><?php echo $row['username']; ?></th>
                    </tr>
                    <tr>
                        <th>Email
                        <th>
                        <th>:</th>
                        <td><?php echo $row['email']; ?></th>
                    </tr>
                    <tr>
                        <th>Created on
                        <th>
                        <th>:</th>
                        <td><?php echo $row['date']; ?></th>
                    </tr>
                    <!-- <tr>
                        <th>User ID
                        <th>
                        <th>:</th>
                        <td><?php #echo $row['UID']; ?></th>
                    </tr> -->
                </table>
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

        function demo() {
            alert("You can't perform this operation on a demo account.");

        }
    </script>
</body>

</html>