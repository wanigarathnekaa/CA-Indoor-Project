<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cashier Dashboard</title>

      <!-- Stylesheets -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/cashierDashboard.css">
      
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">      
</head>

<body>
      <!-- Sidebar -->
      <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

            <!-- Cards -->
            <div class="cardBox">
                  <a class="card" href="C&A_Indoor_Project/Pages/coachTable/cashier">
                        <div class="infor">
                              <div class="numbers"><?php echo $data1["CoachCount"]?></div>
                              <div class="cardName">Coaches</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-user-group"></i>
                        </div>
                  </a>

                  <a class="card" href="C&A_Indoor_Project/Pages/playerTable/cashier">
                        <div>
                              <div class="numbers"><?php echo $data1["UserCount"]?></div>
                              <div class="cardName">Players</div>
                        </div>
                        <div class="iconBx">
                              <i class="fa-solid fa-users"></i>
                        </div>
                  </a>

                  <a class="card" href="C&A_Indoor_Project/Pages/reservationTable/cashier">
                        <div>
                              <div class="numbers"><?php echo $data1["Reserve_Count"]?></div>
                              <div class="cardName">Time Slot<br>Reservations</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-calendar-days"></i>
                        </div>
                  </a>

                  <a class="card" href="C&A_Indoor_Project/Pages/bookingTable/cashier">
                        <div>
                              <div class="numbers"><?php echo $data1["bookingCount"]?></div>
                              <div class="cardName">All Bookings</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-calendar-days"></i>
                        </div>
                  </a>

                  <a class="card" href="C&A_Indoor_Project/Pages/orderTable/cashier">
                        <div>
                              <div class="numbers"><?php echo $data1["orderCount"]?></div>
                              <div class="cardName">All Orders</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-calendar-days"></i>
                        </div>
                  </a>

                  <a class="card" href="C&A_Indoor_Project/Pages/Cancel_Order_Table/cashier">
                        <div>
                              <div class="numbers"><?php echo $data1["cancelOrderCount"]?></div>
                              <div class="cardName">Cancelled Orders</div>
                        </div>

                        <div class="iconBx">
                              <i class="fa-solid fa-calendar-days"></i>
                        </div>
                  </a>
            </div>

            

            <!--Reservation Details -->
            <div class="details">
                  <!-- Recent Reservations -->
                  <div class="tablediv">
                        <?php
                              require APPROOT . '/views/Pages/Tables/cashierReservation.php';
                        ?>
                  </div>
                  
                  <!-- Calander -->
                  <div class="calanderdiv">
                        <iframe src="http://localhost/C&A_Indoor_Project/Pages/Calendar/User" frameborder="0"></iframe>                        
                  </div>
            </div> 
      </section>


      <!-- javascripts -->
      <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
</body>

</html>