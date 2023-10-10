$(document).ready(function() {
    // Event listener for the "Get Exercises" button
    $("#get-exercises").click(function() {
        var day = $("#day").val();
        var muscleGroup = $("#muscle-group").val();
        var equipment = $("#equipment").val();
        
        if (day === "rest") {
            // Clear the previous exercise options
            $("#exercises").empty();
            return;
        }
        // Make an AJAX request to fetch the exercises based on the selected parameters
        $.ajax({
            type: "GET",
            url: "get_exercises.php",
            data: {
                day: day,
                muscleGroup: muscleGroup,
                equipment: equipment
            },
            dataType: "json",
            success: function(response) {
                // Clear the previous exercise options
                $("#exercises").empty();

                // Append the new exercise options
                response.forEach(function(exercise) {
                    $("#exercises").append("<option value='" + exercise.ex_id + "'>" + exercise.ex_name + "</option>");
                });
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
});