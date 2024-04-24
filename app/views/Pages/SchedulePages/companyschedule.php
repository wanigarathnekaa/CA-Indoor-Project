<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Schedule</title>
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/sideBar.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/userSchedule.css">

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
            <!-- Your Reservations -->
            <div class="sec-reservation">
                  <div class="tagrow">
                        <!-- <h2>Reservations</h2> -->
                  </div>
                  <div class="details row1">                  
                        <!-- Calander -->
                        <div class="calanderdiv">
                              <iframe src="http://localhost/C&A_Indoor_Project/Pages/userCalendar/user" frameborder="0"></iframe>                        
                        </div>
                        <!-- daily Reservations -->
                        <div class="tablediv">
                              <?php
                                    require APPROOT . '/views/Pages/Tables/dailyReservation.php';
                              ?>
                        </div>
                  </div>
            </div>


            
            <div class="sec-reservation">
                  
                  <div class="details row3">
                        <!-- upcomming Reservations -->
                        <div class="tablediv">
                              <?php
                                    require APPROOT . '/views/Pages/Tables/permanentReservations.php';
                              ?>    
                        </div>
                        
                        
                        
                  </div>
            </div>
      </section>
      
</body>
</html>