<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Coach_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
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

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Coachers : <?php echo $data1["CoachCount"]?> </h1>
                  </div>
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
                  <div class="add-btn">
                        <a href="<?php echo URLROOT;?>/Coach/register"><i class="fa-solid fa-user-plus  icon"></i></a>
                  </div>
            </div>

            <!-- Table -->
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
                              <tr onclick="openPopup()">
                                    <td>Milan Bhanuka</td>
                                    <td>vgmbhanuka@gmail.com</td>
                                    <td>0716720864</td>
                                    <td>1 year year experience in coaching</td>
                                    <td>level1, sara player, devision3 player</td>
                                    <td>lavel4 cricket coach</td>
                                    <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                    <td onclick="openDeletePopup()"><i class="fa-solid fa-user-slash delete icon"></i></td>
                                    
                              </tr>
                        </tbody>
                  </table>
            </div>


            <!-- popup -->
            <div class="popupcontainer" id="popupcontainer">
                  <!-- details popup -->
                  <div class="popup" id="popup">
                        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Reservation</h2>
                        <hr>
                        <div class="popupdetails">
                              <div class="popupdetail">
                                    <h2><b>Reservation ID :</b> </h2>
                              </div>
                        </div>

                        <!-- <div class="btns">
                              <button type="button">Reshedule</button>
                              <button type="button">Cancel</button>
                        </div> -->
                  </div>



                  <!-- delete message -->
                  <div class="deletepopup" id=deletepopup>
                        <span class="close" onclick="closeDeletePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>confirm delete</h2>

                        <div class="btns">
                              <button type="button">Delete</button>
                              <button type="button" onclick="closeDeletePopup()">Cancel</button>
                        </div>
                  </div>
            </div>

      </section>

      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/coachDetails_popup.js"></script>
</body>