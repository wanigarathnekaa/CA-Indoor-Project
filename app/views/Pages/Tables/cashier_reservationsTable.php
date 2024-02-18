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
      $role = "Cashier";
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- <?php print_r($data); ?> -->

      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Reservations : <?php echo count($data);?></h1>
                  </div>

                  <!-- <div class="add-btn">
                        <a href="#"><i class="fa-solid fa-calendar-plus icon"></i></i></a>
                  </div> -->
            </div>

            <!-- Table Sort -->
            <div class="tableSort">
                  <div class="sort">
                        <label for="payfilter">Status :</label>
                        <select name="filter" id="payfilter">
                              <option value="all">All</option>
                              <option value="paid">Paid</option>
                              <option value="unpaid">Unpaid</option>
                              <option value="cancelled">Cancelled</option>
                        </select>
                  </div>
                  <div class="sort">
                        <label for="netfilter">Net :</label>
                        <select name="filter" id="netfilter">
                              <option value="all">All</option>
                              <option value="netA">Normal Net A</option>
                              <option value="netB">Normal Net B</option>
                              <option value="netC">Machine Net</option>
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
                                    <th>email</th>
                                    <th>Contact Number</th>
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
                              <?php foreach ($data as $reservation): ?>
                                    <tr>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->reservation_Id; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->name; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->email; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->phoneNumber; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->date; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->timeSlot; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->net; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo "paid"; ?>
                                          </td>
                                          <td><a href="#"><i class="fa-solid fa-pen-to-square edit icon"></i></a></td>
                                          <td
                                                onclick="openDeletePopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <!-- <i class="fa-solid fa-user-slash delete icon"></i> -->
                                                <i class="fa-solid fa-trash-can delete icon"></i>
                                          </td>
                                    </tr>
                                    <?php
                              endforeach; ?>
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
                                    <h2><b>Reservation ID :</b><span class="r_id"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Name :</b><span class="r_name"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Email :</b><span class="r_email"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Contact Number :</b><span class="r_number"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Date :</b><span class="r_date"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Time :</b><span class="r_time"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Net :</b><span class="r_net"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Status :</b> <span class="r_payment">Paid</span></h2>
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
                        <form action="<?php echo URLROOT; ?>/Bookings/delete" method="POST">
                              <div class="btns">
                                    <button type="submit">Delete</button>
                                    <button type="button" onclick="closeDeletePopup()">Cancel</button>
                              </div>
                              <input hidden name='submit' id="hid_input">
                        </form>
                  </div>
            </div>

      </section>

      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/reservationDetails_Popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/reservation_Table.js"></script>
</body>