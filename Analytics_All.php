<div class="container-second-analytics">
  <div class='day-today'>

    <?php
    $sql_exercise = "SELECT DISTINCT ex_id FROM workouts WHERE UID = '$SID'";
    $result_exercises = $conn->query($sql_exercise);
    if ($result_exercises->num_rows > 0) {

      while ($row_exercise = $result_exercises->fetch_assoc()) {
        $ex_id = $row_exercise["ex_id"];
        $sql_ex_details = "SELECT DISTINCT ex_name,ex_id FROM exercises WHERE ex_id='$ex_id'";

        $ex_name_result = $conn->query($sql_ex_details);
        $result_ex_name = $ex_name_result->fetch_assoc();
        $act_ex_name = $result_ex_name['ex_name'];
        $act_ex_id = $result_ex_name['ex_id'];

    ?>
        <div class="graph-class" id="<?php echo $act_ex_name; ?>">
          <div class="section-header-charts">
            <?php echo $act_ex_name; ?>
          </div>

          <?php

          $query = "SELECT date, weight FROM logged_weights WHERE uid='$SID' AND ex_id='$ex_id' ORDER BY date ASC";
          $result = $conn->query($query);

          $labels = [];
          $weightData = [];

          while ($row = $result->fetch_assoc()) {
            $labels[] = ($row['date']);
            $weightData[] = $row['weight'];
          }

          $dataset = [
            'labels' => $labels,
            'datasets' => [
              [
                'label' => $act_ex_name,
                'borderColor' => 'rgb(255, 99, 132)',
                'data' => $weightData,
                'fill' => false
              ]
            ]
          ];
          $result->close();
          ?>

          <canvas id="chart_<?php echo $act_ex_id; ?>"></canvas>
          <script>
            var dataset = <?php echo json_encode($dataset); ?>;

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

            if (dataset.labels.length > 0 && dataset.datasets[0].data.length > 0) {
              console.log('chart_<?php echo $act_ex_id; ?>');
              console.log(dataset.labels.length);
              console.log(dataset.datasets[0].data.length);

              // Get the canvas element and initialize Line Chart 2
              var line_canvas = document.getElementById('chart_<?php echo $act_ex_id; ?>');
              line_canvas.width = 550; // Set your desired width
              line_canvas.height = 150; // Set your desired height
              var chart_<?php echo $act_ex_id; ?> = new Chart(line_canvas.getContext('2d'), {
                type: 'line',
                data: dataset,
                options: options
              });

              // Get the data values
              var weightData = dataset.datasets[0].data;
              var lastIndex = weightData.length - 1;
              var lastValue = weightData[lastIndex];
              var secondLastValue = weightData[lastIndex - 1];

              // Determine the borderColor based on the value change
              var borderColor = 'rgb(255, 99, 132)'; // Default color
              if (lastValue > secondLastValue) {
                borderColor = 'rgb(0, 255, 0)'; // Green for decrease
              } else if (lastValue < secondLastValue) {
                borderColor = 'rgb(255, 0, 0)'; // Red for decrease
              } else {
                borderColor = 'rgb(0, 0, 255)'; // Blue for no change
              }

              // Update the chart's dataset borderColor
              chart_<?php echo $act_ex_id; ?>.data.datasets[0].borderColor = borderColor;
              chart_<?php echo $act_ex_id; ?>.update(); // Update the chart to apply changes
            }
            else
            {
              var divElement =document.getElementById('<?php echo $act_ex_name; ?>');
              console.log("The div is blank.");
              divElement.style.display = "none";
            }
          </script>
        </div>
       
      <?php
      }
      echo "</div>";
    } else { ?>
      <ul>
        <li style='list-style-type: none;'>Uh oh we didn't find any logged analytics on our database</li>
      </ul>
    <?php }
    ?>
  </div>
</div>