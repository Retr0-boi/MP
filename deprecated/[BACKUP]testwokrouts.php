<html>

<head>
    <title>Exercise Selection</title>
    <link rel="stylesheet" href="workouts.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <form method="post">
                    <h3><button>rest</button>Sunday<button>new exercise</button></h3>
                        <label for="muscleGroup">Muscle Group:</label>
                        <select name="muscleGroup" id="muscleGroup">
                            <option value="">Select Muscle Group</option>
                            <option value=""></option>
                        </select>

                        <label for="equipment">Equipment:</label>
                        <select name="equipment" id="equipment">
                            <option value="">Select Equipment</option>
                            <option value=""></option>
                        </select>

                        <input type="submit" value="Show Exercises">
                        <label for="Exercises">Exercises:</label>
                        <select name="exercises" id="exercises">
                            <option value="">Select Exercise</option>
                            <option value=""></option>
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