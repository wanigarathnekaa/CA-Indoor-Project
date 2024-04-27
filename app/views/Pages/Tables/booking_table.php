<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Reservation_Table.css">
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
                        <td>Reservation ID</td>
                        <td>Customer</td>
                        <td>Customer Email</td>
                        <td>Phone Number</td>
                        <td>Date</td>
                        <td>Booking Price</td>
                        <td>Paid Price</td>
                        <td>Status</td>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <?php
                    foreach ($data as $reservation) {
                        $status_color = '';
                        if ($reservation->paymentStatus == 'Paid') {
                            $status_color = '#33c030';
                        } elseif ($reservation->paymentStatus == 'Pending') {
                            $status_color = '#ffcc00';
                        } else {
                            $status_color = '#e03333';
                        }
                    ?>
                        <tr>
                            <td>
                                <?php echo $reservation->id; ?>
                            </td>
                            <td>
                                <?php echo $reservation->name; ?>
                            </td>
                            <td>
                                <?php echo $reservation->email; ?>
                            </td>
                            <td>
                                <?php echo $reservation->phoneNumber; ?>
                            </td>
                            <td>
                                <?php echo $reservation->date; ?>
                            </td>
                            <td>
                                <?php echo $reservation->bookingPrice; ?>
                            </td>
                            <td>
                                <?php echo $reservation->paidPrice; ?>
                            </td>
                            <td><span class="status" style="background-color: <?php echo $status_color; ?>;"><?php echo $reservation->paymentStatus ?></span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Popup message -->
        <div id="reservationModal" class="modal">
            <div class="modal-content">
                <div class="title">
                    <h2 class="modal-title">Reservation Details</h2>
                </div>
                <hr>

                <div class="customerDetails">
                    <h3>Customer Details</h3>
                    <div>
                        <span id="name" class="name"></span><br>
                        <span id="email" class="email"></span><br>
                        <span id="phone" class="phone"></span><br>
                    </div>
                </div>

                <div class="orderItems">
                    <h3>Reserved Time Slots</h3>
                    <table id="timeSlotTable">
                        <thead>
                            <tr>
                                <th>Normal Net A</th>
                                <th>Normal Net B</th>
                                <th>Machine Net</th>
                            </tr>
                        </thead>
                        <tbody id="timeSlots">
                            <!-- Order items will be appended here -->
                        </tbody>
                    </table>
                </div>

                <div class="paymentDetails">
                    <h3>Payment Details</h3>
                    <span id="PaymentStatus" class="PaymentStatus"></span>
                    <span id="PaidAmount" class="PaidAmount"></span>
                    <span id="BookingPrice" class="BookingPrice"></span>
                    <span id="PaymentToBeMade" class="PaymentToBeMade"></span>
                    <span id="paidMsj" class="paidMsj" style="color: red;"></span>
                </div>

                <hr>

                <div class="btn">
                    <input type="hidden" id="form_type" name="form_type">
                    <button type="button" id="paid">Pay</button>
                    <button type="button" onclick="closeModal()">close</button>
                </div>
            </div>
        </div>

        </div>

    </section>

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var modal = document.getElementById("reservationModal");

        function closeModal() {
            modal.style.display = "none";
            location.reload();
        }

        $(document).ready(function() {

            $("#payfilter").on("change", function() {
                var selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").hide().filter(function() {
                        // Check if the row contains the selected value
                        return $(this).text().indexOf(selectedValue) > -1;
                    }).show();
                    // Hide rows with "Not Paid" if "Paid" is selected
                    if (selectedValue === "Paid") {
                        $("table tbody tr").filter(function() {
                            return $(this).text().indexOf("Not Paid") > -1;
                        }).hide();
                    }
                } else {
                    // Show all rows when "All" is selected
                    $("table tbody tr").show();
                }
            });


            $("#date").on("change", function() {
                selectedValue = $(this).val();
                if (selectedValue != "All") {
                    $("table tbody tr").filter(function() {
                        $(this).toggle($(this).text().indexOf(selectedValue) > -1);
                    });
                } else {
                    $("table tbody tr").show();
                }

            });
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(value) > -1);
                });
            });

            var payment_status = "";
            var id_reserve = "";

            $('#reservationTable tbody tr').click(function() {
                console.log("clicked");
                var id = $(this).find('td').eq(0).text();
                id_reserve = id;
                $("#reservationModal").css("display", "block");
                console.log(id);
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Bookings/getReservationDetails",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);

                        // Assuming the response is an array and you want to use the first item
                        var data = response[0];

                        $(".name").text("Name: " + data.name);
                        $(".email").text("Email: " + data.email);
                        $(".phone").text("Phone: " + data.phoneNumber);
                        $(".PaymentStatus").text("Payment Status: " + data.paymentStatus);
                        $(".PaidAmount").text("Paid Amount: " + data.paidPrice);
                        $(".BookingPrice").text("Booking Price: " + data.bookingPrice);
                        $(".PaymentToBeMade").text("Payment To Be Made: " + (data.bookingPrice - data.paidPrice));
                        payment_status = data.paymentStatus;
                        console.log(data.date);

                        if (new Date(data.date) < new Date().setHours(0, 0, 0, 0)) {
                            $("#paid").css("color", "black");
                            $(".paidMsj").text("Panelty for late payment should be collected.");
                        } else {
                            $("#paid").css("color", "white");
                            $("#paid").prop("disabled", false);
                        }


                        var timeSlots = data.timeSlots;
                        var timeSlotTable = $("#timeSlotTable tbody");
                        timeSlotTable.empty();

                        var netATimeSlots = [];
                        var netBTimeSlots = [];
                        var machineTimeSlots = [];

                        // Separate time slots based on netType
                        for (var i = 0; i < response.length; i++) {
                            var netType = response[i].netType;
                            var timeSlot = response[i].timeSlot;

                            if (netType === 'Normal Net A') {
                                netATimeSlots.push(timeSlot);
                            } else if (netType === 'Normal Net B') {
                                netBTimeSlots.push(timeSlot);
                            } else if (netType === 'Machine Net') {
                                machineTimeSlots.push(timeSlot);
                            }
                        }

                        // Determine the maximum length among the time slot arrays
                        var maxLength = Math.max(netATimeSlots.length, netBTimeSlots.length, machineTimeSlots.length);

                        // Build the table rows column-wise
                        for (var i = 0; i < maxLength; i++) {
                            var netATime = i < netATimeSlots.length ? netATimeSlots[i] : '';
                            var netBTime = i < netBTimeSlots.length ? netBTimeSlots[i] : '';
                            var machineTime = i < machineTimeSlots.length ? machineTimeSlots[i] : '';

                            var row = "<tr>" +
                                "<td>" + netATime + "</td>" +
                                "<td>" + netBTime + "</td>" +
                                "<td>" + machineTime + "</td>" +
                                "</tr>";

                            timeSlotTable.append(row);
                        }
                    }

                });
            });

            $("#paid").click(function() {
                var id = id_reserve;
                console.log(id);
                console.log(payment_status);
                if (payment_status == "Paid") {
                    $(".paidMsj").text("Payment has already been made");
                    return;
                }

                $.ajax({
                    url: "<?php echo URLROOT; ?>/Bookings/updateReservation",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == "success") {
                            alert("Payment successful");
                            closeModal();
                        } else {
                            alert("Payment failed");
                        }
                    }
                });
            });
        });
    </script>
</body>