<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygymroutine";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$muscleGroups = [];
$equipment = [];

if ($conn) {
    $muscleQuery = mysqli_query($conn, "SELECT mg_id, mg_name FROM muscleGroup");
    $mg_count = mysqli_num_rows($muscleQuery);
    while ($row = mysqli_fetch_assoc($muscleQuery)) {
        $muscleGroups[] = $row;
    }

    $equipmentQuery = mysqli_query($conn, "SELECT eq_id, eq_name FROM equipment");
    $eq_count = mysqli_num_rows($equipmentQuery);
    while ($row = mysqli_fetch_assoc($equipmentQuery)) {
        $equipment[] = $row;
    }
} else {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<html>

<head>
    <title>ADD EXERCISE</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="adminAddExercises.css">
</head>

<body>

    <div id="navigation">
        <?php include 'navadmin.php'; ?>
    </div>

    <div class="main-container">
        <div class="container-first">
            <div class="section top">
                <div class="section-header">ADD EXERCISE
                    <div class="icon">
                        <!-- <i class="fa-solid fa-calendar-day" style="color: #25a825;"></i> -->
                        <i class="material-symbols-outlined" style="position:relative; padding-left:3px;top:3px;font-size:30px;color:#25a825">sprint</i>
                    </div>
                </div>
                <?php
                if (isset($_POST['add-exercise'])) {
                    $eqid = $_POST['chosen-eq'];
                    $mgid = $_POST['chosen-mg'];
                    $exname = $_POST['chosen-exercise'];
                    $insertion_query = "INSERT INTO exercises (mg_id,eq_id,ex_name) VALUES('$eqid','$mgid','$exname') ";
                    if (!$conn->query($insertion_query)) {
                        echo $conn->error;
                    } else {
                        echo "<script>alert('$exname inserted successfully');</script>";
                    }
                }
                ?>
                <form method="post">
                    <div class="options-outer">
                        <div class="options-inner">
                            <div class="newGoalpageButton">
                                <select class="Add-page" placeholder="Muscle Group" name="chosen-eq" required>
                                    <option value="" disabled selected><span>Select Equipment</span></option>

                                    <?php foreach ($equipment as $equip) : ?>
                                        <option value="<?php echo $equip['eq_id']; ?>"><?php echo $equip['eq_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="options-inner">
                            <div class="newGoalpageButton">
                                <select class="Add-page" placeholder="Muscle Group" name="chosen-mg" required>
                                    <option value="" disabled selected><span>Select Muscle Group</span></option>
                                    <?php foreach ($muscleGroups as $group) : ?>
                                        <option value="<?php echo $group['mg_id']; ?>"><?php echo $group['mg_name']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="options-inner">
                            <div class="button-container">
                                <div class="newGoalpageButton">
                                    <input type="text" class="Add-page" placeholder="Exercise Name" name="chosen-exercise" required>
                                </div>
                                <div class="submitButton">
                                    <button class="square-button-save-new-goalpage" type="submit" name="add-exercise">
                                        <i class="fa-regular fa-floppy-disk" style="color: #25a825;font-size:25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
        <div class="container-second">
            <div class="section top">
                <div class="section-header">ADD EQUIPMENT
                    <div class="icon">
                        <!-- <i class="fa-solid fa-cloud-arrow-up" style="color: #25a825;"></i> -->
                        <i class="material-symbols-outlined" style="position:relative; padding-left:3px;top:3px;font-size:30px;color:#25a825">fitness_center</i>
                    </div>
                </div>
                <?php
                if (isset($_POST['add-equipment'])) {
                    $eq_name_eqadd = $_POST['chosen-equipment-eqadd'];
                    $eq_count = $eq_count + 1;
                    $query_add_eq = "INSERT INTO equipment (eq_id,eq_name) VALUES('$eq_count','$eq_name_eqadd')";
                    if (!$conn->query($query_add_eq)) {
                        echo $conn->error;
                    } else {
                        echo "<script>alert('$eq_name_eqadd inserted successfully');</script>";
                        echo "<script>window.location.href='adminAddExercises.php';</script>";
                    }
                }
                ?>
                <form method="post">
                    <div class="options-outer">
                        <div class="options-inner">
                            <div class="button-container">
                                <div class="newGoalpageButton">
                                    <input type="text" class="Add-page" placeholder="Equipment Name" name="chosen-equipment-eqadd" required>
                                </div>
                                <div class="submitButton">
                                    <button class="square-button-save-new-goalpage" type="submit" name="add-equipment">
                                        <i class="fa-regular fa-floppy-disk" style="color: #25a825;font-size:25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-third">
            <div class="section top">
                <div class="section-header">ADD MUSCLE GROUP
                    <div class="icon">
                        <!-- <i class="fa-solid fa-cloud-arrow-up" style="color: #25a825;"></i> -->
                        <i class="material-symbols-outlined" style="position:relative; padding-left:3px;top:3px;font-size:30px;color:#25a825">accessibility_new</i>
                    </div>
                </div>
                <?php
                if (isset($_POST['add-mooscle'])) {
                    $mg_name_eqadd = $_POST['chosen-mooscle'];
                    $mg_count = $mg_count + 1;
                    $query_add_mg = "INSERT INTO musclegroup (mg_id,mg_name) VALUES('$mg_count','$mg_name_eqadd')";
                    if (!$conn->query($query_add_mg)) {
                        echo $conn->error;
                    } else {
                        echo "<script>alert('$mg_name_eqadd inserted successfully');</script>";
                        echo "<script>window.location.href='adminAddExercises.php';</script>";
                    }
                }
                ?>
                <form method="post">
                    <div class="options-outer">
                        <div class="options-inner">
                            <div class="button-container">
                                <div class="newGoalpageButton">
                                    <input type="text" class="Add-page" placeholder="Muscle Group Name" name="chosen-mooscle" required>
                                </div>
                                <div class="submitButton">
                                    <button class="square-button-save-new-goalpage" type="submit" name="add-mooscle">
                                        <i class="fa-regular fa-floppy-disk" style="color: #25a825;font-size:25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>