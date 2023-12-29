<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Player_Table_Style.css">
      <title>Players</title>
</head>
<body>
      
</body>
</html>
<html>


<body>
      <!-- Sidebar -->
      <?php
            $role = "Manager";
            require APPROOT . '/views/Pages/Dashboard/header.php';
            require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Players : <?php echo $data1["UserCount"]?>  </h1>
                  </div>
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
                  <!-- <div class="add-btn">
                        <a href="<?php echo URLROOT;?>/Coach/register"><i class="fa-solid fa-user-plus  icon"></i></a>
                  </div> -->
            </div>

            <!-- Table -->
            <div class="table-container">
                  <table >
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Player ID</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Mobile</td>
                                    <td>Address</td>
                                    <td></td>
                                    <td></td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <tr onclick="window.location.href='#';">
                                    <td>1</td>
                                    <td>Milan Bhanuka</td>
                                    <td>vgmbhanuka@gmail.com</td>
                                    <td>0716720864</td>
                                    <td>Colombo</td>
                                    <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                    <td><a href="#"><i class="fa-solid fa-user-slash delete icon"></i><a></td>    
                              </tr>
                        </tbody>
                  </table>
            </div>
      </section>
</body>