<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Manager Dashboard</title>
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/sideBar.css">
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">


</head>

<body>

      <!-- Sidebar -->
      <?php
      $role = "Manager";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

            <!-- Cards -->
            <div class="cardBox">
                  <a class="card" href=#>
                        <div>
                              <div class="numbers">15</div>
                              <div class="cardName">Coaches</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-person"></i>
                        </div>
                  </a>

                  <a class="card" href="#">
                        <div>
                              <div class="numbers">80</div>
                              <div class="cardName">Players</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-person"></i>
                        </div>
                  </a>

                  <a class="card" href="#">
                        <div>
                              <div class="numbers">284</div>
                              <div class="cardName">Advertisement</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-file-image"></i>
                        </div>
                  </a>

                  <a class="card" href="#">
                        <div>
                              <div class="numbers"></div>
                              <div class="cardName">Reports</div>
                        </div>
                        <div class="iconBx">
                              <i class='bx bxs-report'></i>
                        </div>
                  </a>

                  <a class="card" href="#">
                        <div>
                              <div class="numbers"></div>
                              <div class="cardName">Enventory Management</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-store icon"></i>
                        </div>
                  </a>

                  <a class="card" href="#">
                        <div>
                              <div class="numbers"></div>
                              <div class="cardName">Registration</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-user-plus"></i>
                        </div>
                  </a>
            </div>

            <!-- Calander -->
            <?php
            require APPROOT . '/views/Pages/Calendar/calender.php';
            ?>

            <div style="text-align: center; margin-top: 40px;">
                  <div id="chartContainer" style="height: 370px; width: 90%; margin: 0 auto;"></div>
            </div>

      </section>


      <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
      <script src="<?php echo URLROOT; ?>/js/chart.js"></script>
</body>

</html>