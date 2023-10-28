<html>

<head>
  <title>Homepage</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div id="navigation">
    <?php include 'navmain.php'; ?>
  </div>
  <div class="main-container">
    <div class="container-first">
      <div class="section top">
        <div class="section-header">TODAY'S WORKOUT
          <div class="icon">
            <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
          </div>
          <button class="square-button-workouts"><a href="workouts.php" style='text-decoration:none;'>
              <i class="fa-solid fa-pen-to-square" style="color: #25a825;"></i>
            </a></button>
        </div>
        <ul>
          <?php include 'DashWorkout.php'; ?>
        </ul>
      </div>
      <div class="section top">
        <div class="section-header">LOG WEIGHTS
          <div class="icon">
            <i class="fa-solid fa-cloud-arrow-up" style="color: #25a825;"></i>
          </div>
        </div>
        
          
      <?php include 'DashLogWeights.php';?>
        
      </div>  
    </div>

    <div class="container-second">
      <?php include 'DashGoals.php'; ?>
    </div><!-- EEEEEEEEEEEEEEEEE DIVVVVVVVVV IS FROM THE PHP INCLUDE  -->
    <?php include 'DashReminders.php'; ?>
  </div>
  </div>
  <div class="container-third">
    
    <?php include 'DashBodyweight.php';?>
  </div>
  </div>
</body>

</html>

<!-- <div class="section top">
      <div class="section-header">Strength
        <div class="icon">
          <i class="fa-solid fa-hand-fist" style="color: #25a825;"></i>
        </div>
      </div>
      <canvas id="myLineChart"></canvas>

      <script>
        // Sample data for the line chart
        var data = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Strength',
            borderColor: 'rgb(75, 192, 192)',
            data: [10, 20, 15, 30, 25],
            fill: false
          }]
        };

        var options = {
          responsive: false, // Disable responsiveness
          maintainAspectRatio: false, // Allow chart to have custom dimensions
          scales: {
            y: {
              beginAtZero: true
            }
          }
        };

        // Get the canvas element and set its dimensions
        var canvas = document.getElementById('myLineChart');
        canvas.width = 850; // Set your desired width
        canvas.height = 250; // Set your desired height

        // Initialize the chart
        var myLineChart = new Chart(canvas.getContext('2d'), {
          type: 'line',
          data: data,
          options: options
        });

        // Get the data values
        var salesData = data.datasets[0].data;
        var lastIndex = salesData.length - 1;
        var lastValue = salesData[lastIndex];
        var secondLastValue = salesData[lastIndex - 1];

        // Determine the borderColor based on the value change
        var borderColor = 'rgb(75, 192, 192)'; // Default color
        if (lastValue > secondLastValue) {
          borderColor = 'rgb(0, 255, 0)'; // Green for increase
        } else if (lastValue < secondLastValue) {
          borderColor = 'rgb(255, 0, 0)'; // Red for decrease
        } else {
          borderColor = 'rgb(0, 0, 255)'; // Blue for no change
        }

        // Update the chart's dataset borderColor
        myLineChart.data.datasets[0].borderColor = borderColor;
        myLineChart.update(); // Update the chart to apply changes
      </script>
    </div> -->