<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/coachavailabilitycalander.css">
      <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/userSchedule.css"> -->
      <title>Coach Availability Calander</title>
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
            <div class="main">
                  <div class="calanderdiv">
                              <!-- <iframe src="http://localhost/C&A_Indoor_Project/Pages/Calendar/C&A" frameborder="0"></iframe>-->
                                    <iframe src="<?php echo URLROOT; ?>/Pages/CoachCalendar/coach" frameborder="0"></iframe>
                  </div>
            </div>
      </section>
</body>
</html>