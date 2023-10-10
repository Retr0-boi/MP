<?php
$mg_qr = "SELECT * FROM musclegroup";
$mg_req = $conn->query($mg_qr);
while ($mg_row = $mg_req->fetch_assoc()) {
      $mg_id = $mg_row['mg_id'];
      $mg_name = $mg_row['mg_name'];
      if (!isset($_SESSION[$mg_name])) {
            $_SESSION[$mg_name] = 'off';
      }
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
                              $temp = $mg_name;
                              $smg_qr = "SELECT * FROM musclegroup";
                              $smg_req = $conn->query($smg_qr);
                              while ($smg_row = $smg_req->fetch_assoc()) {
                                    $smg_name = $smg_row['mg_name'];
                                    $_SESSION[$smg_name] = 'off';
                              }
                              $_SESSION[$temp] = 'on';
                        }
                  ?>
                        <button class="option-button-msc" name="mg_<?php echo $mg_name; ?>">
                              <div class="sec options 
          <?php if ($_SESSION[$mg_name] == 'on') {
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
<div class="container-third-analytics">
</div>