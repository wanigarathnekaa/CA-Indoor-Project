<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/managerDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>

    <!-- Sidebar -->
    <?php
        $role = "Owner";
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">

        <!-- Cards -->
        <div class="cardBox">
            <a class="card" href="C&A_Indoor_Project/Pages/managerTable/owner">
                <div>
                    <div class="numbers"><?php echo $data1["ManagerCount"]?></div>
                    <div class="cardName">Managers</div>
                </div>
                <div class="iconBx">
                <i class="fa-solid fa-user-tie"></i>
                </div>
            </a>

            <a class="card" href="C&A_Indoor_Project/Pages/coachTable/owner">
                <div>
                    <div class="numbers"><?php echo $data1["CoachCount"]?></div>
                    <div class="cardName">Coaches</div>
                </div>
                <div class="iconBx">
                    <i class="fa-solid fa-user-group"></i>
                </div>
            </a>

            <a class="card" href="C&A_Indoor_Project/Pages/playerTable/owner">
                <div>
                    <div class="numbers"><?php echo $data1["UserCount"]?></div>
                    <div class="cardName">Players</div>
                </div>
                <div class="iconBx">
                        <i class="fa-solid fa-users"></i>
                </div>
            </a>

            <a class="card" href="C&A_Indoor_Project/Pages/View_Advertisement/owner">
                <div>
                    <div class="numbers"><?php echo $data1["advertCount"]?></div>
                    <div class="cardName">Advertisement</div>
                </div>
                <div class="iconBx">
                        <i class="fa-brands fa-adversal"></i>
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

            <a class="card" href="<?php echo URLROOT;?>/Pages/Manager_Registration/manager">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Registration</div>
                </div>

                <div class="iconBx">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </a>

            <a class="card" href="#">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Confirmation Fee</div>
                </div>

                <div class="iconBx">
                    <i class="fa-solid fa-comments-dollar"></i>
                </div>
            </a>
        </div>

        <!--Reservation Details -->
        <div class="details">
            <!-- Recent Reservations -->
            <div class="tablediv">
                <?php
                        require APPROOT . '/views/Pages/Tables/dailyReservation.php';
                ?>
            </div>
            
            <!-- Calander -->
            <div class="calanderdiv">
                <iframe src="http://localhost/C&A_Indoor_Project/Pages/Calendar/User" frameborder="0"></iframe>                        
            </div>
        </div>

        <!-- chart -->
        <div class="charts">
            <!-- Weekly Reservations chart -->
            <?php
                require APPROOT . '/views/Pages/Charts/weeklyReservationsChart.php';
            ?>

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