<?php
$filter_date = date('Y-m-d');
$new_data = array_filter($data, function ($data) use ($filter_date) {
      return $data->date === $filter_date;
});
?>

<html>

<head>
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dailyReservation_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/reservationPopup.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">


</head>

<body>
      <div class="recentOrders">
            <div class="cardHeader">
                  <!-- date -->
                  <h2><?php echo date('Y-m-d');?></h2>
                  <!-- veiw all button -->
                  <a href="#" class="btn">View All</a>
            </div>

            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Customer</td>
                                    <td>Time Slot</td>
                                    <td>Net</td>
                                    <td>Status</td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php
                              foreach ($new_data as $reservation) {
                                    ?>
                                    <tr onclick="openPopup()">
                                          <td>
                                                <?php echo $reservation->name; ?>
                                          </td>
                                          <td><?php echo $reservation->timeSlot; ?></td>
                                          <td><?php echo $reservation->net; ?></td>
                                          <td><span class="status paid">Paid</span></td>
                                    </tr>
                                    <?php
                              }
                              ?>

                        </tbody>
                  </table>
            </div>
      </div>




      <!-- Popup message -->
      <div class="popupcontainer" id="popupcontainer">
            <div class="popup" id="popup">      
                  <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                  <h2>Reservation</h2>
                  <hr>
                  <div class="popupdetails">
                        <div class="popupdetail">
                              <h2><b>Reservation ID :</b> 123456789</h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Customer Name :</b> Milan Bhanuka</h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Date :</b> 2023-12-30</h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Time :</b> 10AM-12PM</h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Net :</b> Normal Net A</h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Status :</b> Paid</h2>
                        </div>
                  </div>

                  <div class="btns">
                        <button type="button">Reshedule</button>
                        <button type="button">Cancel</button>
                  </div>
            </div>
      </div>


      


      <!-- javascript -->
      <script src="<?php echo URLROOT; ?>/js/popup.js"></script>
      
</body>