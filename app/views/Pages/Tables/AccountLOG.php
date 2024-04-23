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
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Accountlog.css">
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

    <div class="recentOrders">
    <div class="cardHeader">
        <!-- date -->
        <h2>
                <?php echo date('Y-m-d'); ?>
            </h2>
    <h2>User Account Logs</h2>
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

                 
                if (!empty($log->last_login) && !empty($log->last_logout)) {
                    $status_color = '#00ff00'; // Green
                    $status_colorr = '#ff0000'; // Red
                }
                  
             ?>
            <tr onclick="openPopupCoachSession(<?php echo htmlspecialchars(json_encode($log)); ?>)" style="text-align: center;">
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
            <h2>Reservation</h2>
            <hr>
            <div class="popupdetails">
                <div class="popupdetail">
                    <h2><b>Reservation ID :</b> <span class="r_id"></span></h2>
                </div>

                <div class="popupdetail">
                    <h2><b>Customer Name :</b> <span class="r_name"></span></h2>
                </div>

                <div class="popupdetail">
                    <h2><b>Reservation Date :</b> <span class="r_date"></span></h2>
                </div>

                <div class="popupdetail">
                    <h2><b>Reservation Time :</b> <span class="r_timeSlot"></span></h2>
                </div>

                <div class="popupdetail">
                    <h2><b>Net :</b> <span class="r_net"></span></h2>
                </div>

                <div class="popupdetail">
                    <h2><b>Status :</b> <span class="r_payment"></span></h2>
                </div>
            </div>

            <div class="btns">
                <button type="button" onclick="openReschedulePopup()">Reschedule</button>
                <button type="button" onclick="openCancelPopup()">Cancel</button>
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