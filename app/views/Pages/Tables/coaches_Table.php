<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Table_Style.css">
      <title>Coaches</title>
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

            <!-- Coaches Table -->
            <div class="table-container">
                  <table >
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Mobile</td>
                                    <td>Experience</td>
                                    <td>Speciality</td>
                                    <td>Certificate</td>
                                    <td></td>
                                    <td></td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <a href="#">
                                    <tr>
                                          <td>Milan Bhanuka</td>
                                          <td>vgmbhanuka@gmail.com</td>
                                          <td>0716720864</td>
                                          <td>1 year year experience in coaching</td>
                                          <td>level1, sara player, devision3 player</td>
                                          <td>lavel4 cricket coach</td>
                                          <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                          <td><a href="#"><i class="fa-solid fa-user-slash delete icon"></i><a></td>
                                          
                                    </tr>
                              </a>

                              <tr>
                                    <td>Milan Bhanuka</td>
                                    <td>vgmbhanuka@gmail.com</td>
                                    <td>0716720864</td>
                                    <td>1 year year experience in coaching</td>
                                    <td>level1, sara player, devision3 player</td>
                                    <td>lavel4 cricket coach</td>
                                    <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                    <td><a href="#"><i class="fa-solid fa-user-slash delete icon"></i><a></td>
                                    
                              </tr>

                        </tbody>
                  </table>
            </div>
      </section>
</body>