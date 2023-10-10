<?php
if (!isset($_SESSION['bodyweight-toggle'])) {
  $_SESSION['bodyweight-toggle'] = 'on'; // Default to 'on' if not set
}

if (isset($_POST['bodyweight-edit'])) {
  // Toggle the state when the button is clicked
  $_SESSION['bodyweight-toggle'] = ($_SESSION['bodyweight-toggle'] === 'on') ? 'off' : 'on';
}
?>
<div class="section bottom">
  <div class="section-header">BodyWeight
    <div class="icon">
      <i class="fa-solid fa-weight-scale" style="color: #25a825;"></i>
    </div>
    <form class="bodyWeight-form" method="POST">
      <button type="submit" class="square-button-bodyWeight" name="bodyweight-edit">
        <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
      </button>
    </form>
  </div>
    <?php
  if ($_SESSION['bodyweight-toggle'] === 'on') :
  ?>
  <div id="chartContainer">
    <?php
    $query = "SELECT date, weight FROM bodyweight WHERE uid='$SID' ORDER BY date ASC";
    $result = $conn->query($query);

    $labels = [];
    $weightData = [];

    while ($row = $result->fetch_assoc()) {
      $labels[] = date("M", strtotime($row['date']));
      $weightData[] = $row['weight'];
    }

    $lineData2 = [
      'labels' => $labels,
      'datasets' => [
        [
          'label' => 'Body weight',
          'borderColor' => 'rgb(255, 99, 132)',
          'data' => $weightData,
          'fill' => false
        ]
      ]
    ];

    $result->close(); // Close the result set
    ?>
    <?php
    if (count($lineData2['labels']) > 0 && count($lineData2['datasets'][0]['data']) > 0) :
    ?>
      <script>
        // Sample data for Line Chart 2
        var lineData2 = <?php echo json_encode($lineData2); ?>;

        // Configuration options for Line Chart 2
        var options = {
          responsive: false,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        };

        if (lineData2.labels.length > 0 && lineData2.datasets[0].data.length > 0) {
          // Get the canvas element and initialize Line Chart 2
          var lineCanvas2 = document.getElementById('lineChart2');
          lineCanvas2.width = 850; // Set your desired width
          lineCanvas2.height = 250; // Set your desired height
          var lineChart2 = new Chart(lineCanvas2.getContext('2d'), {
            type: 'line',
            data: lineData2,
            options: options
          });

          // Get the data values
          var weightData = lineData2.datasets[0].data;
          var lastIndex = weightData.length - 1;
          var lastValue = weightData[lastIndex];
          var secondLastValue = weightData[lastIndex - 1];

          // Determine the borderColor based on the value change
          var borderColor = 'rgb(255, 99, 132)'; // Default color
          if (lastValue > secondLastValue) {
            borderColor = 'rgb(0, 255, 0)'; // Green for increase
          } else if (lastValue < secondLastValue) {
            borderColor = 'rgb(255, 0, 0)'; // Red for decrease
          } else {
            borderColor = 'rgb(0, 0, 255)'; // Blue for no change
          }

          // Update the chart's dataset borderColor
          lineChart2.data.datasets[0].borderColor = borderColor;
          lineChart2.update(); // Update the chart to apply changes
        }
      </script>
    <?php else : ?>
      <ul>
        <li style='list-style-type: none;'>Log weight to see the analytics.</li>
      </ul>
    <?php endif; ?>
  </div>
  <?php else : ?>

    <form class="add-bodyweight" method="POST">
      <div id="newBodyweight">
        <!-- New text box and button pairs will be added here -->
      </div>
      <div class="button-container">
        <div class="newBodyweightButton">
          <button class="square-button-new-bodyWeight" type="button" onclick="addNewBodyweight()">
            <i class="fa-solid fa-square-plus" style="color: #25a825;"></i>
          </button>
        </div>
        <div class="submitButton" style="display: none;">
          <button class="square-button-save-new-bodyWeight" type="submit" name="add_bodyweight">
            <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
          </button>
        </div>
      </div>
    </form>


    <script>
      function addNewBodyweight() {
        // Create a new div to contain the text box, delete button, and "Add Bodyweight" button
        var bodyweightDiv = document.createElement("div");

        // Create new input field
        var newInputBodyWeight = document.createElement("input");
        newInputBodyWeight.type = "text";
        newInputBodyWeight.name = "newBodyweight[]";
        newInputBodyWeight.className = "newBodyweight";
        newInputBodyWeight.placeholder = "Enter a new bodyweight";
        newInputBodyWeight.required = true;

        // Create a delete button for the text box
        var deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.className = "square-button-delete-bodyWeight";
        var trashIcon = document.createElement("i");
        trashIcon.className = "fa-solid fa-trash";
        trashIcon.style.color = "#ff0000";
        deleteButton.appendChild(trashIcon);
        deleteButton.onclick = function() {
          // Remove the entire div when the delete button is clicked
          bodyweightDiv.remove();
          checkSaveButtonVisibilityBodyWeight();
        };

        // Append the new elements to the div
        bodyweightDiv.appendChild(newInputBodyWeight);
        bodyweightDiv.appendChild(deleteButton);

        // Append the div to the form
        var newBodyweightDiv = document.getElementById("newBodyweight");
        newBodyweightDiv.appendChild(bodyweightDiv);

        // Show the "Add Bodyweight" button when a form is added
        checkSaveButtonVisibilityBodyWeight();
      }

      function checkSaveButtonVisibilityBodyWeight() {
        // Show the "Save BodyWeight" button when there's at least one form
        var submitButton = document.querySelector(".submitButton");
        var newBodyweightDiv = document.getElementById("newBodyweight");
        var forms = newBodyweightDiv.querySelectorAll("div");
        if (forms.length > 0) {
          submitButton.style.display = "block";
        } else {
          submitButton.style.display = "none";
        }
      }
      </script>
  <?php endif; ?>
</div>