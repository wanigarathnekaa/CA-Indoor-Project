<html>

<head>
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dailyReservation_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">


</head>

<body>
      <div class="recentOrders">
            <div class="cardHeader">
                  <!-- date -->
                  <h2>
                        Upcoming Reservations 
                  </h2>
                  <!-- veiw all button -->
                  <a href="#" class="btn">View All</a>
            </div>

            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Date</td>
                                    <td>Time Slot</td>
                                    <td>Net</td>
                                    <td>Status</td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <tr>
                                    <td>2024-10-10</td>
                                    <td>10:00 - 11:00</td>
                                    <td>Net 1</td>
                                    <td><span class="status paid">Paid</span></td>
                              </tr>
                        </tbody>
                  </table>
            </div>
      </div>




      <!-- Popup message -->
      <!-- <div class="popupcontainer" id="popupcontainer">
            <div class="popup" id="popup">
                  <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                  <h2>Reservation</h2>
                  <hr>
                  <div class="popupdetails">
                        <div class="popupdetail">
                              <h2><b>Reservation ID :</b> <span class = "r_id"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Customer Name :</b> <span class = "r_name"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Date :</b> <span class = "r_date"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Time :</b> <span class = "r_timeSlot"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Net :</b> <span class = "r_net"></span></h2>
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
      </div> -->





      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/popup.js"></script>

</body>