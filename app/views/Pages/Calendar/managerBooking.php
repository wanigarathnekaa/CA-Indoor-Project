<?php
date_default_timezone_set('Asia/Colombo');

$selected_date = isset($_GET['fulldate']) ? urldecode($_GET['fulldate']) : date('Y-m-d');
$bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;

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



// if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) {
//     echo '<div class="alert">';
//     echo '<script>alert("You have confirmed your booking!");</script>';
//     echo '</div>';
//     unset($_SESSION['booking_success']);
// }
?>

<?php if (isset($_SESSION['booking_success']) && $_SESSION['booking_success'] === true) {
    ?>
    <div class="SuccessContainer">
        <div class="SuccessPopup" id="SuccessPopup">
            <img src="<?= URLROOT ?>/images/tick.png">
            <h2>Reservation Is Successful!</h2>
            <!-- <p>Your payment has been successfully submitted.</p> -->
            <button type="button" onclick="closePopup()">OK</button>
        </div>
    </div>
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
                            var_dump($new_array_2);
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
                                <?php } else if($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Normal Net A"
                                        data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Normal Net A"
                                        data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php }?> 
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
                                <?php } else if($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Normal Net B"
                                        data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Normal Net B"
                                        data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php }?> 
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
                                <?php } else if($filter_date == date('Y-m-d') && !in_array($ts, $current_timeslots)) { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Machine Net"
                                        data-date="<?php echo $filter_date; ?>" today-slot="true">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $ts; ?>" data-net-type="Machine Net"
                                        data-date="<?php echo $filter_date; ?>">
                                        <?php echo $ts; ?>
                                    </option>
                                <?php }?> 
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php if ($bookingId == 0) { ?>
                <div id="confirmationForm" style="display: none;">
                    <a href="http://localhost/C&A_Indoor_Project/Pages/Booking_Register/manager"><button class="confBut"
                            onclick="passValues()">Confirm Reservation</button></a>
                </div>
            <?php } else { ?>
                <div id="confirmationForm" style="display: none;">
                    <a
                        href='http://localhost/C&A_Indoor_Project/Pages/Booking_Register/manager?bookingID=<?php echo $bookingId; ?>&timedate=<?php echo $selected_date; ?>'>
                        <button class="confBut" onclick="passValues()">Confirm Reservation</button>
                    </a>
                </div>

            <?php } ?>

        </section>
    </div>
    <script src="<?= URLROOT ?>/js/managerBooking.js"></script>
</body>

</html>