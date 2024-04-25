<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/permeneReservation_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/notification.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
      <title>Permanent Reservation</title>
</head>

<body>
      <div class="permaner">
            <div class="cardHeader">
                  <!-- date -->
                  <h2>
                        Permanent Reservations
                  </h2>
                  <!-- <div class="serachselect">
                        <i class="fa-solid fa-magnifying-glass icon"></i>
                        <select id="liveSearch" class="btn">
                              <option value="All">All</option>
                              <option value="Normal Net A">Normal Net A</option>
                              <option value="Normal Net B">Normal Net B</option>
                              <option value="Machine Net">Machine Net</option>
                        </select>
                  </div> -->
            </div>

            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Starting Date</th>
                                    <th>Time Duration</th>
                                    <th>Day</th>
                                    <th>Status</th>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php
                              foreach ($data['permanentBookings'] as $permanentBookings) { 
                                    $status_color = '';
                                    if($permanentBookings->status == 'Cancelled')   
                                          $status_color = '#e03333';
                                    else if($permanentBookings->status == 'Finished')
                                          $status_color = '#e0da33';
                                    else if($permanentBookings->status == 'ongoing')
                                          $status_color = '#30c030';     
                                    ?>

                                    <tr
                                          onclick="openPermanentPopup(<?php echo htmlspecialchars(json_encode($permanentBookings)); ?>)">
                                          <td>
                                                <?php echo $permanentBookings->id; ?>
                                          </td>
                                          <td>
                                                <?php echo $permanentBookings->name; ?>
                                          </td>
                                          <td>
                                                <?php echo $permanentBookings->email; ?>
                                          </td>
                                          <td>
                                                <?php echo $permanentBookings->date; ?>
                                          </td>
                                          <td>
                                                <?php echo $permanentBookings->timeDuration; ?>
                                          </td>
                                          <td>
                                                <?php echo $permanentBookings->day; ?>
                                          </td>
                                          <td>
                                                <span style="background-color: <?php echo $status_color; ?>" class="status"><?php echo $permanentBookings->status; ?></span>
                                          </td>
                                    </tr>
                                    <?php
                              }
                              ?>

                        </tbody>
                  </table>
            </div>
      </div>

      <!-- Popup message -->
      <div class="popupcontainer2" id="popupcontainer2">
            <div class="popup2" id="popup2">
                  <span class="close" onclick="closePermanentPopup()"> <i class="fa-solid fa-xmark"></i></span>
                  <h2>Permanent Reservation</h2>
                  <hr>
                  <div class="popupdetails">
                        <div class="popupdetail">
                              <h2><b>Reservation ID :</b> <span class="p_id"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Customer Name :</b> <span class="p_name"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Email :</b> <span class="p_email"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Phone Number :</b> <span class="p_phone"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Starting Date :</b> <span class="p_date"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Time Duration :</b> <span class="p_timeDuration"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Time Slot A :</b> <span class="p_timeSlotA"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Time Slot B :</b> <span class="p_timeSlotB"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Machine Net :</b> <span class="p_timeSlotM"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Day :</b> <span class="p_day"></span></h2>
                        </div>

                        <div class="btns">

                              <button type="button" onclick="cancelReservation()">Cancel Reservation</button>
                              <button type="button" onclick="closePermanentPopup()">Close</button>
                        </div>
                  </div>
            </div>
      </div>



      <!-- JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="<?php echo URLROOT; ?>/js/permanetPopup.js"></script>
      <script>
            function cancelReservation() {
                  var pId = document.querySelector('.p_id').innerText;
                  var pDate = document.querySelector('.p_date').innerText;
                  var pTimeDuration = document.querySelector('.p_timeDuration').innerText;
                  var pDay = document.querySelector('.p_day').innerText;
                  var timeSlotA = JSON.parse(document.querySelector('.p_timeSlotA').innerText);
                  var timeSlotB = JSON.parse(document.querySelector('.p_timeSlotB').innerText);
                  var timeSlotM = JSON.parse(document.querySelector('.p_timeSlotM').innerText);

                  $.ajax({
                        type: 'POST',
                        url: '<?php echo URLROOT; ?>/Bookings/cancelPermanentReservation',
                        data: {
                              pId: pId,
                              pDate: pDate,
                              pTimeDuration: pTimeDuration,
                              pDay: pDay,
                              timeSlotA: JSON.stringify(timeSlotA),
                              timeSlotB: JSON.stringify(timeSlotB),
                              timeSlotM: JSON.stringify(timeSlotM)
                        },
                        success: function (response) {
                              console.log(response);
                              if(response.status == 'success'){
                                    var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Reservation Cancelled Successfully</h3></div><div class="notification_progress"></div></div>');
                                    $('body').append(notificationDiv);
                                    setTimeout(function() {
                                          notificationDiv.remove();
                                    }, 3000);
                                    setTimeout(function() {
                                                location.reload();
                                    }, 2000);
                              }else{
                                    var notificationDiv = $('<div class="notification2"><div class="notification_body"><h3 class="notification_title">Failed to Cancel Reservation</h3></div><div class="notification_progress"></div></div>');
                                    $('body').append(notificationDiv);
                                    setTimeout(function() {
                                          notificationDiv.remove();
                                    }, 3000);
                                    
                              }
                        }
                  });
            }


      </script>

</body>

</html>