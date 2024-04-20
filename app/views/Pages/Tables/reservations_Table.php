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
      <!-- Sidebar -->
      <?php
      $role = $_SESSION['user_role'];
      require APPROOT . '/views/Pages/Dashboard/header.php';
      require APPROOT . '/views/Components/Side Bars/sideBar.php';
      ?>

      <!-- <?php print_r($data); ?> -->

      <!-- Content -->
      <section class="home">

            <!-- Table Topic -->
            <div class="table-topic">
                  <div class="topic-name">
                        <h1>Reservations :
                              <?php echo count($data); ?>
                        </h1>
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
                              <option value="All">All</option>
                              <option value="Pending">Pending</option>
                              <option value="Paid">Paid</option>
                              <option value="Not Paid">Not Paid</option>
                        </select>
                  </div>
                  <div class="sort">
                        <label for="netfilter">Net :</label>
                        <select name="filter" id="netfilter">
                              <option value="All">All</option>
                              <option value="Normal Net A">Normal Net A</option>
                              <option value="Normal Net B">Normal Net B</option>
                              <option value="Machine Net">Machine Net</option>
                        </select>
                  </div>
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
                              <?php foreach ($data as $reservation): 
                                    $status_color = '';
                                    if ($reservation->paymentStatus == 'Paid') {
                                          $status_color = '#00ff00';
                                    } else if ($reservation->paymentStatus == 'Pending') {
                                          $status_color = '#ffcc00';
                                    } else {
                                          $status_color = '#ff0000';
                                    }
                                    ?>
                                    <tr>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <?php echo $reservation->id; ?>
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
                                                <?php echo $reservation->netType; ?>
                                          </td>
                                          <td onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                                <span class="status" style="background-color: <?php echo $status_color; ?>;"><?php echo $reservation->paymentStatus ?></span>
                                          </td>
                                          <td onclick="openDeletePopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
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
                                    <h2><b>Reservation ID : </b><span class="r_id"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Name : </b><span class="r_name"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Email : </b><span class="r_email"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Customer Contact Number : </b><span class="r_number"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Date : </b><span class="r_date"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Reservation Time : </b><span class="r_time"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Net : </b><span class="r_net"></span></h2>
                              </div>

                              <div class="popupdetail">
                                    <h2><b>Status : </b> <span class="r_payment"></span></h2>
                              </div>
                        </div>
                        <div class="btns">
                              <button type="button" onclick="openReschedulePopup()">Reschedule</button>
                              <button type="button" onclick="openCancelPopup()">Cancel</button>
                        </div>
                  </div>

                  <!-- Popup message for rescheduling -->
                  <div class="reschedulePopup" id="reschedulePopup">
                        <span class="close" onclick="closeReschedulePopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Reschedule Reservation</h2>
                        <hr>
                        <div class="rescheduleDetails">
                              <h4>Are You Sure You Want To Reschedule?</h4>
                              <h4 class="day">Time For Reservation - <span class="r_timeSlot_r"
                                          style="font-weight: bold;"></span></h4>
                        </div>

                        <div class="btns" id="rescheduleButtons">
                              <button type="button" class="yesButton" onclick="confirmReschedule()">Yes</button>
                              <button type="button" class="noButton" onclick="closeReschedulePopup()">No</button>
                        </div>
                  </div>

                  <!-- Popup message for Cancellation -->
                  <div class="reschedulePopup" id="cancelPopup">
                        <span class="close" onclick="closeCancelPopup()"><i class="fa-solid fa-xmark"></i></span>
                        <h2>Cancel Reservation</h2>
                        <hr>
                        <div class="CancelDetails">
                              <h4>Are You Sure You Want To Cancel The Reservation?</h4>
                              <h4 class="day">Time For Your Reservation - <span class="cancel_timeSlot"
                                          style="font-weight: bold;"></span></h4>
                              <span class="cancel_bookingId" style="font-weight:bold"></span>
                        </div>

                        <div class="btns" id="cancelButtons">
                              <button type="button" class="cyesButton" id="cancelReservation">Yes</button>
                              <button type="button" class="cnoButton" onclick="closeCancelPopup()">No</button>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="<?php echo URLROOT; ?>/js/reservationDetails_Popup.js"></script>
      <script src="<?php echo URLROOT; ?>/js/reservation_Table.js"></script>
      <script>
            $(document).ready(function () {
                  $("#netfilter").on("change", function () {
                        selectedValue = $(this).val();
                        // alert(selectedValue);
                        if (selectedValue != "All") {
                              $("table tbody tr").filter(function () {
                                    $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                              });
                        } else {
                              $("table tbody tr").show();
                        }

                  });

                  $("#payfilter").on("change", function () {
                        selectedValue = $(this).val();
                        // alert(selectedValue);
                        if (selectedValue != "All") {
                              $("table tbody tr").filter(function () {
                                    $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                              });
                        } else {
                              $("table tbody tr").show();
                        }

                  });

                  $("#date").on("change", function () {
                        selectedValue = $(this).val();
                        if (selectedValue != "All") {
                              $("table tbody tr").filter(function () {
                                    $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                              });
                        } else {
                              $("table tbody tr").show();
                        }

                  });
                  $("#searchInput").on("keyup", function () {
                        var value = $(this).val();
                        $("table tbody tr").filter(function () {
                              $(this).toggle($(this).text().indexOf(value) > -1);
                        });
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
</body>