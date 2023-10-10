<html>

<head>
    <title>Exercise Selection</title>
    <link rel="stylesheet" href="workouts.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#exerciseForm').onchange(function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                console.log("test");
                var selectedMuscleGroup = $('#muscleGroup').val();
                var selectedEquipment = $('#equipment').val();
                
                console.log(selectedMuscleGroup);
                console.log(selectedMuscleGroup);
                // Use AJAX to fetch exercises

                $.ajax({
                    type: 'POST',
                    url: '[BACKUP]fetch_exercises.php', // PHP script to handle the AJAX request
                    data: {
                        muscleGroup: selectedMuscleGroup,
                        equipment: selectedEquipment
                    },
                    success: function(response) {
                        console.log("success");
                        $('#exercises').html(response); // Populate the Exercises dropdown with the response
                    },
                    error: function(XMLHttpRequest,response) { 
                        console.log("fail");
                    alert("Status: " + response);
                }       
                });
            });
        });
    </script>
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container">

        <div class="container-first">
            <div class="section top">
                <div class="workout-heading">TODAY'S WORKOUT
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                    </div>
                </div>
                <ul>
                    <?php include 'DashWorkout.php'; ?>
                </ul>
            </div>
        </div>

        <div class="container-second">
            <div class="section top">

                <div class="workout-heading">CREATE NEW WORKOUT PLAN
                    <div class="icon">
                        <i class="fa-solid fa-calendar-plus" style="color: #25a825;"></i>
                    </div>
                </div>
                <?php
                $query = mysqli_query($conn, "SELECT mg_id, mg_name FROM MuscleGroup");
                $muscleGroups = [];
                while ($row = mysqli_fetch_assoc($query)) {
                $muscleGroups[] = $row;
                }
                
                $query = mysqli_query($conn, "SELECT eq_id , eq_name FROM Equipment");
                $equipment = [];
                while ($row = mysqli_fetch_assoc($query)) {
                $equipment[] = $row;
                }
                ?>
                <form method="post" id="exerciseForm">
                    <h3><button>rest</button>Sunday<button>new exercise</button></h3>
                    <label for="muscleGroup">Muscle Group:</label>
                    <select name="muscleGroup" id="muscleGroup">
                        <option value="">Select Muscle Group</option>
                        <?php foreach ($muscleGroups as $group) : ?>
                            <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="equipment">Equipment:</label>
                    <select name="equipment" id="equipment">
                        <option value="">Select Equipment</option>
                        <?php foreach ($equipment as $equip) : ?>
                            <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit" value="Show Exercises">
                    <label for="Exercises">Exercises:</label>
                    <select name="exercises" id="exercises">
                        <option value="">Select Exercise</option>
                        <!-- Populate exercise options dynamically using AJAX -->
                    </select>
                    <h3>Monday</h3>

                    <h3>Tuesday</h3>
                    <h3>Wednesday</h3>
                    <h3>Thursday</h3>
                    <h3>Friday</h3>
                    <h3>Saturday</h3>

                </form>

            </div>
        </div>

        <div class="container-third">
            <div class="section top">

                <div class="workout-heading">PREVIOUS WORKOUT PLANS
                    <div class="icon">
                        <i class="fa-solid fa-clock-rotate-left" style="color: #25a825;"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>