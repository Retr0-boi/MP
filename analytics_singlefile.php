<?php
session_start();
if (!isset($_SESSION['option-toggle-current'])) {
    $_SESSION['option-toggle-current'] = 'on'; // Default to 'on' if not set
    $_SESSION['option-toggle-muscle'] = 'off';
    $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-current'])) {
    // Toggle the state when the button is clicked
    $_SESSION['option-toggle-current'] = 'on';
    $_SESSION['option-toggle-muscle'] = 'off';
    $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-muscle'])) {

    $_SESSION['option-toggle-current'] = 'off';
    $_SESSION['option-toggle-muscle'] = 'on';
    $_SESSION['option-toggle-all'] = 'off';
}
if (isset($_POST['filter-all'])) {
    $_SESSION['option-toggle-current'] = 'off';
    $_SESSION['option-toggle-muscle'] = 'off';
    $_SESSION['option-toggle-all'] = 'on';
}
?>

<html>

<head>
    <title>Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="analytics.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="navigation">
        <?php include 'navmain.php'; ?>
    </div>
    <div class="main-container-analytics">
        <?php
        $current = $_SESSION['option-toggle-current'];
        $muscle = $_SESSION['option-toggle-muscle'];
        $all = $_SESSION['option-toggle-all'];
        ?>
        <form method="post">
            <div class="container-options">
                <button class="option-button" name="filter-current">
                    <div class="sec options 
          <?php if ($current == 'on') {
                echo 'checked';
            } else {
                echo 'unchecked';
            } ?> " id="filter-current">
                        <div class="section-header-analytics">CURRENT DAY
                            <div class="icon">
                                <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="option-button" name="filter-muscle">
                    <div class="sec options <?php if ($muscle == 'on') {
                                                echo 'checked';
                                            } else {
                                                echo 'unchecked';
                                            } ?>" id="filter-muscle">
                        <div class="section-header-analytics">MUSCLE GROUP
                            <div class="icon">
                                <i class="fa-solid fa-dumbbell" style="color: #25a825;"></i>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="option-button" name="filter-all">
                    <div class="sec options 
          <?php if ($all == 'on') {
                echo 'checked';
            } else {
                echo 'unchecked';
            } ?>" id="filter-all">
                        <div class="section-header-analytics">ALL LOGS
                            <div class="icon">
                                <i class="material-symbols-outlined" style="font-size:30px;color:#25a825;position:relative;bottom:2px;">select_all</i>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </form>
        <?php
        if ($current == 'on') {
        ?>
            <div class="container-second-analytics">
                <?php
                $currentDay = date("D"); // "D" format returns abbreviated day name (e.g., Mon, Tue, etc.)
                $sql_day = "SELECT d_id,d_full FROM days WHERE day='$currentDay'";

                $result_day = $conn->query($sql_day);
                $row_day = $result_day->fetch_assoc();
                $d_id = $row_day["d_id"];
                $d_full = $row_day['d_full'];

                $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID' AND day='$d_id'";
                $result_exercises = $conn->query($sql_exercise);
                if ($result_exercises->num_rows > 0) {
                    echo "<div class='day-today'>";
                    echo "<h2>" . $d_full . "</h2>";

                    while ($row_exercise = $result_exercises->fetch_assoc()) {
                        $ex_id = $row_exercise["ex_id"];
                        $sql_ex_details = "SELECT * FROM exercises WHERE ex_id='$ex_id'";

                        $ex_name_result = $conn->query($sql_ex_details);
                        $result_ex_name = $ex_name_result->fetch_assoc();
                        $act_ex_name = $result_ex_name['ex_name'];
                        $act_ex_id = $result_ex_name['ex_id'];

                ?>
                        <div class="graph-class">
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
                                        borderColor = 'rgb(0, 0, 0)'; // Green for decrease
                                    } else if (lastValue < secondLastValue) {
                                        borderColor = 'rgb(255, 0, 0)'; // Red for decrease
                                    } else {
                                        borderColor = 'rgb(0, 0, 255)'; // Blue for no change
                                    }

                                    // Update the chart's dataset borderColor
                                    chart_<?php echo $act_ex_id; ?>.data.datasets[0].borderColor = borderColor;
                                    chart_<?php echo $act_ex_id; ?>.update(); // Update the chart to apply changes
                                }
                            </script>
                        </div>
                    <?php
                    }
                    echo "</div>";
                } else { ?>
                    <ul>
                        <li style='list-style-type: none;'>Uh oh we didn't find any logged analytics for <?php echo $d_full; ?></li>
                    </ul>
                <?php }
                ?>
            </div>
        <?php
        }
        if ($muscle == 'on') {
        ?>
            <?php
            if (!isset($_SESSION['mg_option'])) {
                $_SESSION['mg_option'] = 'off';
            }

            ?>

            <div class="main-container-analytics-msc">
                <form method="post">
                    <div class="container-options">

                        <?php
                        $mg_qr = "SELECT * FROM musclegroup";
                        $mg_req = $conn->query($mg_qr);
                        while ($mg_row = $mg_req->fetch_assoc()) :
                            $mg_id = $mg_row['mg_id'];
                            $mg_name = $mg_row['mg_name'];
                            if (isset($_POST['mg_' . $mg_name])) {
                                $_SESSION['mg_option'] = $mg_name;
                            }
                        ?>
                            <button class="option-button-msc" name="mg_<?php echo $mg_name; ?>">
                                <div class="sec options 
          <?php if ($_SESSION['mg_option'] == $mg_name) {
                                echo 'checked';
                            } else {
                                echo 'unchecked';
                            } ?> ">
                                    <div class="section-header-analytics"><?php echo $mg_name; ?>
                                        <!-- <div class="icon"> -->
                                        <!-- <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </button>

                        <?php endwhile; ?>
                    </div>
                </form>

            </div>
            <?php
            if ($_SESSION['mg_option'] != 'off') {
            ?>
                <div class="container-second-analytics">
                    <div class='day-today'>
                        <?php
                        $mg_selection = $_SESSION['mg_option'];
                        $mg_id_qry = "SELECT * FROM musclegroup WHERE mg_name='$mg_selection'";
                        $mg_id_res = $conn->query($mg_id_qry);
                        $mg_id_fetch = $mg_id_res->fetch_assoc();
                        $act_mg_id = $mg_id_fetch['mg_id'];
                        $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID'";
                        $result_exercises = $conn->query($sql_exercise);
                        if ($result_exercises->num_rows > 0) { ?>

                            <?php
                            while ($row_exercise = $result_exercises->fetch_assoc()) {
                                $ex_id = $row_exercise["ex_id"];
                                $sql_ex_details = "SELECT DISTINCT ex_name,ex_id FROM exercises WHERE ex_id='$ex_id' and mg_id='$act_mg_id'";
                                $ex_name_result = $conn->query($sql_ex_details);
                                if ($ex_name_result->num_rows > 0) {
                                    $result_ex = $ex_name_result->fetch_assoc();
                                    $act_ex_name = $result_ex['ex_name'];
                                    $act_ex_id = $result_ex['ex_id'];
                                } else {
                                    $act_ex_name = 'skip';
                                    $act_ex_id = 'skip';
                                }

                            ?>
                                <?php if ($act_ex_name != 'skip' && $act_ex_id != 'skip') { ?>


                                    <?php

                                    $idk_query = "SELECT date, weight FROM logged_weights WHERE uid='$SID' AND ex_id='$act_ex_id' ORDER BY date DESC";
                                    $result = $conn->query($idk_query);

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
                                    if (count($dataset['labels']) > 0 && count($dataset['datasets'][0]['data']) > 0) :
                                    ?>
                                        <div class="graph-class">
                                            <div class="section-header-charts">
                                                <?php echo $act_ex_name; ?>
                                            </div>
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
                                            </script>
                                        </div>
                                    <?php endif; ?>

                                <?php } else {
                                    $act_ex_name = 0;
                                    $act_ex_id = 0;
                                } ?>
                            <?php
                            }
                        } else { ?>
                            <ul>
                                <li style='list-style-type: none;'>Uh oh we didn't find any logged analytics inside the database </li>
                            </ul>
                        <?php }
                        ?>
                    </div>
                </div>
            <?php } else {
            ?>
                <div class="container-second-analytics">
                    <div class="graph-class" style="width:100%;margin-top:20px;margin-right:20px;">
                        <center>
                            <h4>Please choose a muscle group</h4>
                        </center>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
        if ($all == 'on') { ?>
            <div class="container-second-analytics">
                <?php
                $sql_exercise = "SELECT * FROM workouts WHERE UID = '$SID'";
                $result_exercises = $conn->query($sql_exercise);
                if ($result_exercises->num_rows > 0) {
                    echo "<div class='day-today'>";

                    while ($row_exercise = $result_exercises->fetch_assoc()) {
                        $ex_id = $row_exercise["ex_id"];
                        $sql_ex_details = "SELECT * FROM exercises WHERE ex_id='$ex_id'";

                        $ex_name_result = $conn->query($sql_ex_details);
                        $result_ex_name = $ex_name_result->fetch_assoc();
                        $act_ex_name = $result_ex_name['ex_name'];
                        $act_ex_id = $result_ex_name['ex_id'];

                ?>
                        <div class="graph-class">
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
                                        borderColor = 'rgb(0, 0, 0)'; // Green for decrease
                                    } else if (lastValue < secondLastValue) {
                                        borderColor = 'rgb(255, 0, 0)'; // Red for decrease
                                    } else {
                                        borderColor = 'rgb(0, 0, 255)'; // Blue for no change
                                    }

                                    // Update the chart's dataset borderColor
                                    chart_<?php echo $act_ex_id; ?>.data.datasets[0].borderColor = borderColor;
                                    chart_<?php echo $act_ex_id; ?>.update(); // Update the chart to apply changes
                                }
                            </script>
                        </div>
                    <?php
                    }
                    echo "</div>";
                } else { ?>
                    <ul>
                        <li style='list-style-type: none;'>Uh oh we didn't find any logged analytics for <?php echo $d_full; ?></li>
                    </ul>
                <?php }
                ?>
            </div>
        <?php   }
        ?>
    </div>
</body>

</html>