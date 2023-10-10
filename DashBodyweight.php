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
        $labels[] = ($row['date']);
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
  //       echo "lineData2 Contents:";
  // echo "<pre>";
  // var_dump($lineData2);
  // echo "</pre>";
  ?>
      <canvas id="lineChart2"></canvas>
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
            lineCanvas2.width = 1800; // Set your desired width
            lineCanvas2.height = 228; // Set your desired height
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
              borderColor = 'rgb(255, 0, 0)'; // Green for decrease
            } else if (lastValue < secondLastValue) {
              borderColor = 'rgb(0, 255, 0)'; // Red for decrease
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
          <input type="numbers" class="newBodyweight" placeholder="Enter Bodyweight (KG)" name="bdweight" required>
        </div>
          <!-- <button class="square-button-delete-bodyWeight" > -->
          <!-- <i class="fa-solid fa-trash" style="color: #ff0000;"></i> -->
          <!-- </button> -->
        
        <div class="submitButton" >
          <button class="square-button-save-new-bodyWeight" type="submit" name="add_bodyweight">
            <i class="fa-regular fa-floppy-disk" style="color: #25a825;"></i>
          </button>
        </div>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>
<?php
if(isset($_POST['add_bodyweight'])){
    $bodyweight = $_POST['bdweight'];
    $sql="INSERT INTO bodyweight (uid,weight,date) VALUES('$SID','$bodyweight',CURDATE())";
    if (!$conn->query($sql) === TRUE)
        echo "<p>Bodyweight insertion unsuccessful: " . $bodyweight . "<br></p>";
      else {

        $_SESSION['bodyweight-toggle'] = 'on';
        echo '<script>window.location.href = "dashboard.php";</script>';
      }
} 
?>