<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/adminDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/charts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/charts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>


<body>

    <!-- Sidebar -->
    <?php
        $role = "Admin";
        require APPROOT.'/views/Pages/Dashboard/header.php';
        require APPROOT.'/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">

        <!-- Cards -->
        <div class="cardBox">
            <a class="card" href="http://localhost/C&A_Indoor_Project/Pages/managerTable/user">
                <div>
                    <div class="numbers"><?php echo $data["ManagerCount"]?></div>
                    <div class="cardName">Managers</div>
                </div>
                <div class="iconBx">
                <i class="fa-solid fa-user-tie"></i>
                </div>
            </a>
        

            <a class="card" href="http://localhost/C&A_Indoor_Project/Pages/coachTable/user">

                <div>
                  <div class="numbers"><?php echo $data["CoachCount"]?></div>

                    <div class="cardName">Coaches</div>
                </div>
                <div class="iconBx">
                    <i class="fa-solid fa-user-group"></i>
                </div>
            </a>

            <a class="card" href="http://localhost/C&A_Indoor_Project/Pages/playerTable/user">
                <div>
                    <div class="numbers"><?php echo $data["UserCount"]?></div>
                    <div class="cardName">Players</div>
                </div>
                <div class="iconBx">
                        <i class="fa-solid fa-users"></i>
                </div>
            </a>

            <a class="card" href="http://localhost/C&A_Indoor_Project/Pages/reservationTable/user">
                        <div>
                              <div class="numbers"><?php echo $data["Reserve_Count"]?></div>
                              <div class="cardName">Reservations</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-calendar-days"></i>
                        </div>
                  </a>
             <a class="card" href="C&A_Indoor_Project/Pages/View_Advertisement/manager">
                        <div>
                              <div class="numbers"><?php echo $data["advertCount"]?></div>
                              <div class="cardName">Advertisements</div>

                        </div>
                        <div class="iconBx">
                              <i class="fa-brands fa-adversal"></i>
                              <!-- <i class="fa-solid fa-file-contract"></i> -->
                        </div>
              </a>

            <a class="card" href="C&A_Indoor_Project/Reports/view1">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Reports</div>
                </div>
                <div class="iconBx">
                    <i class='bx bxs-report'></i>
                </div>
            </a>

          
            <a class="card" href="C&A_Indoor_Project/Complaint/viewComplaints">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Complaints</div>
                </div>

                <div class="iconBx">
                    <i class="fa-solid fa-comments"></i>
                </div>
            </a>
        </div>
         
            <div class="charts">
                  <!-- Weekly Reservations chart -->
    <!-- Weekly Reservations chart -->
    <a class="card" href="C&A_Indoor_Project/Complaint/viewComplaints">
        <?php require APPROOT . '/views/Pages/Charts/weeklyReservationsChart.php'; ?>
    </a>



                  <!-- Customers Count chart -->
                  <?php
                        require APPROOT . '/views/Pages/Charts/customersCountChart.php';
                  ?>

                  <!-- Reservations Net chart -->
                  <?php
                        require APPROOT . '/views/Pages/Charts/reservationsNetChart.php';
                  ?>
            </div>


    </section>



    <!-- javascripts -->
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>
</html>