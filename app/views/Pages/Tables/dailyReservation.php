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
                  <div class="details">
                        <div class="detail">
                              <h2 class="topic">Reservation ID : </h2>
                              <h2>123456789</h2>
                        </div>
                        <!-- <div class="detail">
                              <h2 class="topic">Customer : </h2>
                              <h2>Milan Bhanuka</h2>
                        </div> -->
                        <!-- <div class="detail">
                              <h2 class="topic">Reservation Date : </h2>
                              <h2>12/12/2021</h2>
                        </div>
                        <div class="detail">
                              <h2 class="topic">Reservation Time : </h2>
                              <h2>12:00-01.00</h2>
                        </div>
                        <div class="detail">
                              <h2 class="topic">Net : </h2>
                              <h2>Normal Net A</h2>
                        </div>
                        <div class="detail">
                              <h2 class="topic">Status : </h2>
                              <h2>Paid</h2>
                        </div> -->
                        dfevfuwevfyiw
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