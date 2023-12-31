<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- css -->
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Player_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
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
                              <tr>
                                    <td onclick="openPopup()">1</td>
                                    <td onclick="openPopup()">Milan Bhanuka</td>
                                    <td onclick="openPopup()">vgmbhanuka@gmail.com</td>
                                    <td onclick="openPopup()">0716720864</td>
                                    <td onclick="openPopup()">Colombo</td>
                                    <td><a href="#"><i class="fa-solid fa-user-pen edit icon"></i></a></td>
                                    <td onclick="openDeletePopup()"><i class="fa-solid fa-user-slash delete icon"></i></td>    
                              </tr>
                        </tbody>
                  </table>
            </div>


            <!-- popup windows -->
            <div class="popupcontainer" id="popupcontainer">

                  <!-- details popup window-->
                  <div class="popup" id="popup">
                        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Milan Bhanuka</h2>
                        <hr>
                        <div class="popupdetails">
                              <div class="popupdetail">
                                    <h2><b>Player ID : </b></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>User Name : </b></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Email : </b></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Mobile Number : </b></h2>
                              </div>
                              <div class="popupdetail">
                                    <h2><b>Address : </b></h2>
                              </div>
                        </div>
                  </div>

                  
                  <!-- confirm delete popup window -->
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
      <script src="<?php echo URLROOT; ?>/js/playerDetails_popup.js"></script>
</body>