<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/reservation_Table.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
      <title>Reservation</title>
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
                        <h1>Reservations : 25
                        </h1>
                  </div>
                  
                  <!-- <div class="add-btn">
                        <a href="#"><i class="fa-solid fa-calendar-plus icon"></i></i></a>
                  </div> -->
            </div>

            <!-- Table Sort -->
            <div class="tableSort">
                  <div class="sort">
                        <label>Status :</label>
                        <select name="filter" id="filter">
                              <option value="all">All</option>
                              <option value="paid">Paid</option>
                              <option value="unpaid">Unpaid</option>
                              <option value="cancelled">Cancelled</option>
                        </select>
                  </div>
                  <div class="sort">
                        <label>Net :</label>
                        <select name="filter" id="filter">
                              <option value="all">All</option>
                              <option value="netA">Net A</option>
                              <option value="netB">Net B</option>
                              <option value="netC">Net C</option>
                        </select>   
                  </div>
                  <div class="sort">
                        <label>Date :</label>
                        <input type="date" id="date" name="date">
                  </div>
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here" id="searchInput" onkeyup="search()">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                  <table id=reservationTable>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <th>Reservation ID</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Net</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <tr>
                                    <td onclick="openPopup()">1</td>
                                    <td onclick="openPopup()">John Doe</td>
                                    <td onclick="openPopup()">2021/10/10</td>
                                    <td onclick="openPopup()">10.00 AM</td>
                                    <td onclick="openPopup()">Net A</td>
                                    <td onclick="openPopup()"><span class="status paid">Paid</span></td>
                                    <td><a href="#"><i class="fa-solid fa-pen-to-square edit icon"></i></a></td>
                                    <td onclick="openDeletePopup()"><i class="fa-solid fa-trash-can delete icon"></i></td>
                              </tr>

                              <tr>
                                    <td onclick="openPopup()">2</td>
                                    <td onclick="openPopup()">Milan</td>
                                    <td onclick="openPopup()">2021/10/10</td>
                                    <td onclick="openPopup()">10.00 AM</td>
                                    <td onclick="openPopup()">Net A</td>
                                    <td onclick="openPopup()"><span class="status paid">Paid</span></td>
                                    <td><a href="#"><i class="fa-solid fa-pen-to-square edit icon"></i></a></td>
                                    <td onclick="openDeletePopup()"><i class="fa-solid fa-trash-can delete icon"></i></td>
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
                                    <h2><b>Reservation ID :</b></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Name :</b></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Date :</b></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Time :</b></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Net :</b></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Status :</b> <span class = "r_payment">Paid</span></h2>
                              </div>
                        </div>

                        <div class="btns">
                              <button type="button">Reshedule</button>
                              <button type="button">Cancel</button>
                        </div>
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
      <script src="<?php echo URLROOT; ?>/js/reservation_Table.js"></script>
</body>