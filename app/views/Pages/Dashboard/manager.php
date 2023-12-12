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
      <?php
      $role = "Manager";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <section class="home">
            <div class="cardscontainer">
                  <a class="card" href="#">
                        <i class="fa-solid fa-image-portrait icon"></i>
                        <div>
                              <h2>Coaches</h2>
                              <!-- <p>Total Coaches: 5</p> -->
                        </div>
                  </a>
                  <a class="card" href="#">
                        <i class="fa-solid fa-image-portrait icon"></i>
                        <div>
                              <h2>Players</h2>
                              <!-- <p>Total Players: 23</p> -->
                        </div>
                  </a>
                  <a class="card" href="#">
                        <i class="fa-solid fa-file-image icon"></i>
                        <div>
                              <h2>Advertisement</h2>
                              <!-- <p>Total Advertisement: 10</p> -->
                        </div>
                  </a>
                  <a class="card" href="#">
                        <i class="fa-solid fa-file-lines icon"></i>
                        <div>
                              <h2>Reports</h2>
                              <!-- <p>Total Advertisement: 10</p> -->
                        </div>
                  </a>
                  <a class="card" href="#">
                        <i class="fa-solid fa-store icon"></i>
                        <div>
                              <h2>Enventory Management</h2>
                              <!-- <p>Total Advertisement: 10</p> -->
                        </div>
                  </a>
                  <a class="card" href="#">
                        <!-- <i class="fa-solid fa-user-plus icon"></i> -->
                        <!-- <i class="bx bxs-user-plus icon"></i> -->
                        <i class="fa-regular fa-id-badge icon"></i>
                        <div>
                              <h2>Registration</h2>
                              <!-- <p>Total Advertisement: 10</p> -->
                        </div>
                  </a>
            </div>
            <?php
            require APPROOT . '/views/Pages/Calendar/calender.php';
            ?>


      </section>


      <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>

</body>

</html>