<?php

$filter_date = date('Y-m-d'); 
$new_data = array_filter($data['logs'], function ($item) use ($filter_date) {
    $last_login_date = substr($item->last_login, 0, 10);     // get only the date 
    return $last_login_date === $filter_date; 
});

?>




<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Reservation_Table.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_coaches.css">
      <title>Coaches</title>
</head>

<body>

</body>

</html>
<html>


<body>
      <!-- Sidebar -->
      <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- Content -->
      <section class="home">

      <div class="table-topic">
                  <div class="topic-name">
                        <h1>User Account Logs :
                        <?php echo date('Y-m-d'); ?>
                        </h1>
                  </div>

                  <!-- <div class="add-btn">
                        <a href="#"><i class="fa-solid fa-calendar-plus icon"></i></i></a>
                  </div> -->
            </div>

            <div class="tableSort">
                  <!-- <div class="sort">
                        <label for="payfilter">Status :</label>
                        <select name="filter" id="payfilter">
                              <option value="All">All</option>
                              <option value="Pending">Pending</option>
                              <option value="Paid">Paid</option>
                              <option value="Not Paid">Not Paid</option>
                        </select>
                  </div> -->
                  <!-- <div class="sort">
                        <label for="netfilter">Net :</label>
                        <select name="filter" id="netfilter">
                              <option value="All">All</option>
                              <option value="Normal Net A">Normal Net A</option>
                              <option value="Normal Net B">Normal Net B</option>
                              <option value="Machine Net">Machine Net</option>
                        </select>
                  </div> -->
                  <div class="sort">
                        <label>Date :</label>
                        <input type="date" id="date" name="date">
                  </div>
                  <div class="search">
                        <label>
                              <input type="text" placeholder="Search here" id="searchInput">
                              <i class="fa-solid fa-magnifying-glass icon"></i>
                        </label>
                  </div>
            </div>



        <div class="table-container">
            <table>
                <!-- table header -->
                <thead>
                    <tr>
                    
                        <td>Name</td>
                        <td class="left-align">Email </td>
                        <td>Creation Date</td>
                        <td>Last-login</td>
                        <td>Last-logout</td>

                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
            <?php if (empty($new_data)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: red;" >No users logged in today.</td>
                </tr>
           <?php else: ?>
            
           <?php foreach ($new_data as $log): 
             
                 $status_color = '';
                 $status_colorr = '';

                 
                if (!empty($log->last_login) || !empty($log->last_logout)) {
                    $status_color = '#30c030'; // Green
                    $status_colorr = '#e03333'; // Red
                }
                  
             ?>
            <tr onclick="openLogPopup(<?php echo htmlspecialchars(json_encode($log)); ?>)" style="text-align: center;">
            <td><?php echo $log->user_name; ?></td>
            <td class="left-align"><?php echo $log->email; ?></td>
            <td><?php echo date('Y-m-d', strtotime($log->create_date)); ?></td>
            <td><span class="status" style="background-color: <?php echo $status_color; ?>;"><?php echo $log->last_login ?></span></td>
            <td><span class="status" style="background-color: <?php echo $status_colorr; ?>;"><?php echo $log->last_logout ?></span></td>

          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
          

    </tbody>
            </table>
        </div>
    </div>

  <!-- Popup message -->
<div class="popupcontainer" id="popupcontainer">
    <div class="popup" id="popup">
        <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
        <h2>User Log</h2>
        <hr>
        <div class="popupdetails">
            <div class="popupdetail">
                <h2><b>User ID :</b> <span class="l_id"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>User Name :</b> <span class="l_name"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Creation Date :</b> <span class="l_date"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Last LOGIN Time :</b> <span class="l_last_login"></span></h2>
            </div>

            <div class="popupdetail">
                <h2><b>Last LOGOUT Time :</b> <span class="l_last_logout"></span></h2>
            </div>
        </div>
    </div>
</div>

    <!-- Popup message for rescheduling -->
    <!-- <div class="popupcontainer" id="reschedulePopupContainer" style="display: none;">
        <div class="popup" id="reschedulePopup">
            <span class="close" onclick="closeReschedulePopup()"><i class="fa-solid fa-xmark"></i></span>
            <h2>Reschedule Reservation</h2>
            <hr>
            <div class="rescheduleDetails">
                <h4>Are You Sure You Want To Reschedule?</h4>
                <h4 class="day">Reservation is at Today - <span class="r_timeSlot_r" style="font-weight:bold"></span>
                </h4>
            </div>

            <div class="btns">
                <button type="button" onclick="confirmReschedule()">Yes</button>
                <button type="button" onclick="closeReschedulePopup()">No</button>
            </div>
        </div>
    </div> -->

    <!-- Popup message for Cancelling -->
    <!-- <div class="popupcontainer" id="cancelPopupContainer" style="display: none;">
        <div class="popup" id="cancelPopup">
            <span class="close" onclick="closeCancelPopup()"><i class="fa-solid fa-xmark"></i></span>
            <h2>Cancel Reservation</h2>
            <hr>
            <div class="cancelDetails">
                <h4>Are You Sure You Want To Cancel The Reservation?</h4>
                <h4 class="day" style="font-weight:450">All Time Slots Will Be Cancelled.</h4>
            </div>
            <span class="cancel_bookingId" style="font-weight:bold"></span>

            <div class="btns">
                <button type="button" id="cancelReservation">Yes</button>
                <button type="button" onclick="closeCancelPopup()">No</button>
            </div>
        </div>
    </div> -->

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/popup.js"></script>
    <script>
        $(document).ready(function () {
            $("#liveSearch").on("change", function () {
                selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").filter(function () {
                        $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                    });
                } else {
                    $("table tbody tr").show();
                }

            }); 

            $("#cancelReservation").on("click", function () {
                var bookingId = $(".cancel_bookingId").text();
                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Bookings/cancelReservation",
                    data: {
                        bookingId: bookingId
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            alert("Reservation Cancelled Successfully");
                            location.reload();
                        } else {
                            alert("Failed to Cancel the Reservation");
                        }
                    }
                });
            });
        });
    </script>
      </section>
</body>

</html>