<?php
$selected_date = isset($_GET['fulldate']) ? urldecode($_GET['fulldate']) : date('Y-m-d');

$filter_date = $selected_date;
$filter_net_M = 'Machine Net';
$filter_net_A = 'Normal Net A';
$filter_net_B = 'Normal Net B';

$new_array_1 = array_filter($data, function ($data) use ($filter_date, $filter_net_M) {
    return $data->date === $filter_date && $data->net === $filter_net_M;
});

$new_array_2 = array_filter($data, function ($data) use ($filter_date, $filter_net_A) {
    return $data->date === $filter_date && $data->net === $filter_net_A;
});

$new_array_3 = array_filter($data, function ($data) use ($filter_date, $filter_net_B) {
    return $data->date === $filter_date && $data->net === $filter_net_B;
});

if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) {
    echo '<div class="alert">';
    echo '<script>alert("You have confirmed your booking!");</script>';
    echo '</div>';
    unset($_SESSION['booking_success']);
}
?>


<?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/userbooking_style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_userbooking.css">

    <title>Booking</title>
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "User";
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
            <button class="confBut" onclick="openPopup()">Confirm Reservation</button>
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

                <div class="paymentamount">
                    <h2>Total Payment : <span class="payment"></span></h2>
                    <h4>To Confirm Your Booking : <span class="con_payment"></span></h4>
                </div>
                <hr>

                <div class="btns">
                    <button id="makePaymentBtn" type="button">Full Payment</button>
                    <button id="makePaymentBtn" type="button">Confirmation Payment</button>
                    <button id="cancelBtn" type="button">Cancel</button>
                </div>
            </div>
        </div>

    </section>

    <script src="<?php echo URLROOT; ?>/js/userBooking.js"></script>
</body>

</html>