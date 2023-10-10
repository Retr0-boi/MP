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
                <p>Username: <span class="username">JohnDoe</span></p>
                <p>Email: <span class="email">johndoe@example.com</span></p>
            </div>
        </div>
        <div class="container-profile">
            <div class="section top">
                <div class="section-header">CHANGE PROFILE
                    <div class="icon">
                        <i class="fa-solid fa-address-card" style="color: #25a825;"></i>
                    </div>
                </div>
                <form class="profileForm">
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
    </div>



    <script>
        // Function to confirm data deletion
        function confirmDelete() {
            if (confirm("Are you sure you want to delete all your data? This action cannot be undone.")) {
                // Perform data deletion operation (you'll need server-side code for this)
                window.location.href = "delete_data.php";
            }
        }
    </script>
</body>

</html>