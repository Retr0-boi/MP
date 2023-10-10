$(document).ready(function () {
    // Fetch the options for muscle groups, equipment, and exercises
    $.ajax({
        type: "GET",
        url: "generate_options.php",
        dataType: "json",
        success: function (response) {
            console.log("Logging response");
            console.log(response); // Log the response for debugging purposes

            // Populate the muscle group dropdowns
            $(".muscle-group").each(function () {
                var dropdown = $(this);
                dropdown.append("<option value='rest'>Rest Day</option>");
                response.muscleGroups.forEach(function (muscleGroup) {
                    dropdown.append("<option value='" + muscleGroup.mg_id + "'>" + muscleGroup.mg_name + "</option>");
                });
            });

            // Populate the equipment dropdowns
            $(".equipment").each(function () {
                var dropdown = $(this);
                response.equipment.forEach(function (equipment) {
                    dropdown.append("<option value='" + equipment.eq_id + "'>" + equipment.eq_name + "</option>");
                });
            });
        },
        error: function (xhr, status, error) {
            console.log("Error:" + error);
        }
    });

    // Event listener for the muscle group dropdowns
    $(".muscle-group").change(function () {
        var row = $(this).closest("tr");
        var muscleGroup = $(this).val();
        var equipmentDropdown = row.find(".equipment");
        var exerciseDropdown = row.find(".exercises");

        // Clear the equipment and exercise dropdowns
        equipmentDropdown.empty();
        exerciseDropdown.empty();

        // Check if it's a rest day
        if (muscleGroup === "rest") {
            return;
        }

        // Fetch the options for exercises based on the selected muscle group
        $.ajax({
            type: "GET",
            url: "get_exercises.php",
            data: {
                muscleGroup: muscleGroup
            },
            dataType: "json",
            success: function (response) {
                // Populate the exercise dropdown
                response.exercises.forEach(function (exercise) {
                    exerciseDropdown.append("<option value='" + exercise.ex_id + "'>" + exercise.ex_name + "</option>");
                });
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });

    // Event listener for the add exercise button
    $(".add-exercise").click(function () {
        var row = $(this).closest("tr");
        var selectedExercise = row.find(".exercises option:selected");
        var selectedExerciseName = selectedExercise.text();
        var exerciseList = row.find(".exercise-list");

        // Check if exercise is selected
        if (selectedExercise.val() !== "") {
            // Add the selected exercise to the exercise list
            exerciseList.append("<li>" + selectedExerciseName + "</li>");
        }
    });
});
// first commit test
