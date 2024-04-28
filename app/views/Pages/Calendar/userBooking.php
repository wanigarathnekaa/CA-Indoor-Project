<?php
$selected_date = isset($_GET['fulldate']) ? urldecode($_GET['fulldate']) : date('Y-m-d');

$filter_date = $selected_date;
$filter_net_M = 'Machine Net';
$filter_net_A = 'Normal Net A';
$filter_net_B = 'Normal Net B';

$new_array_1 = array_filter($data, function ($item) use ($filter_date, $filter_net_M) {
    return $item->date === $filter_date && $item->netType === $filter_net_M;
});

$new_array_2 = array_filter($data, function ($item) use ($filter_date, $filter_net_A) {
    return $item->date === $filter_date && $item->netType === $filter_net_A;
});

$new_array_3 = array_filter($data, function ($item) use ($filter_date, $filter_net_B) {
    return $item->date === $filter_date && $item->netType === $filter_net_B;
});

?>

<?php if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) {
    ?>
    <form id="successForm">
        <div class="SuccessContainer">
            <div class="SuccessPopup" id="SuccessPopup">
                <img src="<?= URLROOT ?>/images/tick.png">
                <h2>Payment Successfully!</h2>
                <p>Your payment has been successfully submitted.</p>
                <button type="submit" id="paid" name="OKAY">OK</button>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var modal = document.getElementById("SuccessPopup");

            function closeModal() {
                modal.style.display = "none";
                location.reload();
            }

            var payment_status = "";
            var id_reserve = <?= json_encode($_SESSION['booking_id'] ?? null) ?>;

            function sendInvoice(reservationId) {
                $.ajax({
                    url: "<?php echo URLROOT; ?>/Bookings/sendingInvoice",
                    type: "POST",
                    data: { id: reservationId },
                    success: function (response) {
                        // alert("Failed to send invoice");
                        var notificationDiv = $('<div class="notification2"><div class="notification_body"><h3 class="notification_title"> Failed to send invoice</h3></div><div class="notification2_progress"></div></div>');
                        $('body').append(notificationDiv);
                        setTimeout(function () {
                            notificationDiv.remove();
                        }, 5000);
                        console.log("Failed to send invoice:", response);
                        setTimeout(function () {
                            closeModal();
                        }, 3000); // Close the popup after successful invoice sending
                    },
                    error: function (xhr, status, error) {
                        // alert("Invoice sent successfully");
                        var notificationDiv = $('<div class="notification"><div class="notification_body"><h3 class="notification_title">Invoice sent successfully</h3></div><div class="notification_progress"></div></div>');
                        $('body').append(notificationDiv);
                        setTimeout(function () {
                            notificationDiv.remove();
                        }, 3000);

                        console.error("Invoice sent successfully:", error);
                    }
                });
            }

            $("#paid").click(function () {
                var id = id_reserve;
                sendInvoice(id);
            });
        });
    </script>

    <?php
} ?>


<?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

// Get the current hour in the format "HH:MM" (24-hour clock)
$currentHour = date('H:i');
$timestamp = strtotime($currentHour);

// Round up the minutes to the nearest hour
$roundedTimestamp = ceil($timestamp / (60 * 60)) * (60 * 60);

// Format the rounded timestamp to output the hour and minute in "HH:00" format
$formattedTime = date('H:00', $roundedTimestamp);

$duration = 60;
$cleanup = 0;
$start = "07:00";
$end = "22:00";
function time_slot($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)) {
        $endPeriod = clone $intStart;
        // echo $endPeriod->format("H:iA");
        $endPeriod->add($interval);
        // echo $endPeriod->format("H:iA");

        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;
}

$current_timeslots = time_slot($duration, $cleanup, $formattedTime, $end);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/userbooking_style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_userbooking.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/notification.css">

    <style>
        <?php if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) { ?>
            .content-container {
                display: none;
            }

            .SuccessContainer {
                display: block;
            }

            <?php unset($_SESSION['booking_success']);
        } ?>
    </style>

    <title>Booking</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="content-container">
        <?php
        $role = $_SESSION['user_role'];
        require APPROOT . '/views/Pages/Dashboard/header.php';
        require APPROOT . '/views/Components/Side Bars/sideBar.php';
        ?>

        <section class="home">
            <h1 class="text-center">Book on Date:
                <?php echo date($selected_date, strtotime(date("Y/m/d"))); ?>
            </h1>
            <div class="timeSlots">
                <div class="slot">
                    <h1 class="netType">Normal Net A</h1>
                    <div class="form-group">
                        <select name="language" class="custom-select" multiple>
                            <?php
                            $timeslots = time_slot($duration, $cleanup, $start, $end);

                            foreach ($timeslots as $ts) {
                                ?>
                                <?php
                                $found = false;
                                foreach ($new_array_2 as $reservation) {
                                    if ($reservation->timeSlot === $ts) {
                                        $found = true;
                                        break;
                                    }
                                }
                                if ($found) { ?>
                                    <option value="<?php echo $ts; ?>" data-booked="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else if ($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Normal Net A"
                                            data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } else { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Normal Net A"
                                            data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="slot">
                    <h1 class="netType">Normal Net B</h1>
                    <div class="form-group">
                        <select name="language" class="custom-select" multiple>
                            <?php
                            $timeslots = time_slot($duration, $cleanup, $start, $end);
                            foreach ($timeslots as $ts) {
                                ?>
                                <?php
                                $found = false;
                                foreach ($new_array_3 as $reservation) {
                                    if ($reservation->timeSlot === $ts) {
                                        $found = true;
                                        break;
                                    }
                                }
                                if ($found) { ?>
                                    <option value="<?php echo $ts; ?>" data-booked="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else if ($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Normal Net B"
                                            data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } else { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Normal Net B"
                                            data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="slot">
                    <h1 class="netType">Machine Net</h1>
                    <div class="form-group">
                        <select name="language" class="custom-select" multiple>
                            <?php
                            $timeslots = time_slot($duration, $cleanup, $start, $end);
                            foreach ($timeslots as $ts) {
                                ?>
                                <?php
                                $found = false;
                                foreach ($new_array_1 as $reservation) {
                                    if ($reservation->timeSlot === $ts) {
                                        $found = true;
                                        break;
                                    }
                                }
                                if ($found) { ?>
                                    <option value="<?php echo $ts; ?>" data-booked="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else if ($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Machine Net"
                                            data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } else { ?>
                                        <option value="<?php echo $ts; ?>" data-net-type="Machine Net"
                                            data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                        </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div id="confirmationForm" style="display: none;">
                <button class="confBut"
                    onclick="openPopup((<?php echo htmlspecialchars(json_encode($selected_date)); ?>))">Confirm
                    Reservation</button>
            </div>



            <!-- Popup message -->
            <div class="popupcontainer" id="popupcontainer">
                <div class="popup" id="popup">
                    <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                    <h2>Chosen Time Slots</h2>
                    <hr>
                    <div class="popupdetails">
                        <table class="popupdetailtable">
                            <thead>
                                <tr>
                                    <th>Time Slot</th>
                                    <th>Net</th>
                                </tr>
                            </thead>
                            <tbody class="popupTableBody" id="popupTableBody"></tbody>
                        </table>
                    </div>

                        <div class="input-field">
                            <label>Choose a coach?</label>
                            <select name="coach" id="coach">
                                <option disabled selected>Select the coach</option>
                            </select>
                        </div>

                    <div class="paymentamount">
                        <h2>Total Payment : <span class="payment"></span></h2>
                        <h4>To Confirm Your Booking : <span class="con_payment"></span></h4>
                    </div>
                    <hr>

                    <div class="btns">
                        <button id="makePaymentBtn" type="button">Full Payment</button>
                        <button id="makePaymentBtnCon" type="button">Confirmation Payment</button>
                        <button id="cancelBtn" type="button">Cancel</button>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="<?php echo URLROOT; ?>/js/userBooking.js"></script>
</body>

</html>