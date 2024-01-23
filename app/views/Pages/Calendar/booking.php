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
    echo '<div id="popup-container" class="popup-container">';
    echo '  <div class="popup">';
    echo '    <span class="close-btn" onclick="closePopup()">&times;</span>';
    echo '    <p>You have confirmed your booking!</p>';
    echo '  </div>';
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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bookingtimes_style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_userbooking.css">

    <title>Booking</title>
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "Manager";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <div class="container">
            <h1 class="text-center">Book on Date:
                <?php echo date($selected_date, strtotime(date("Y/m/d"))); ?>
            </h1>
            <hr>

            <div class="timeSlots">

                <!-- net A -->
                <div class="slot">
                    <h1 class="netType">Normal Net A</h1>
                    <div class="row">
                        <?php
                        $timeslots = time_slot($duration, $cleanup, $start, $end);
                        foreach ($timeslots as $ts) {
                            ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                    $found = false;
                                    foreach ($new_array_2 as $reservation) {
                                        if ($reservation->timeSlot === $ts) {
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if ($found) { ?>
                                        <button class="btn btn-danger">
                                            <?php echo $ts; ?>
                                        </button>
                                    <?php } else { ?>
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Booking_Register/user?timeslot=<?php echo urlencode($ts); ?>&timedate=<?php echo $selected_date; ?>&net=Normal Net A"
                                            style="text-decoration: none; color:inherit;">
                                            <button class="btn btn-success">
                                                <?php echo $ts; ?>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- net B -->
                <div class="slot">
                    <h1 class="netType">Normal Net B</h1>
                    <div class="row">
                        <?php
                        $timeslots = time_slot($duration, $cleanup, $start, $end);
                        foreach ($timeslots as $ts) {
                            ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                    $found = false;
                                    foreach ($new_array_3 as $reservation) {
                                        if ($reservation->timeSlot === $ts) {
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if ($found) { ?>
                                        <button class="btn btn-danger">
                                            <?php echo $ts; ?>
                                        </button>
                                    <?php } else { ?>
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Booking_Register/user?timeslot=<?php echo urlencode($ts); ?>&timedate=<?php echo $selected_date; ?>&net=Normal Net B"
                                            style="text-decoration: none; color:inherit;">
                                            <button class="btn btn-success">
                                                <?php echo $ts; ?>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Machine net -->
                <div class="slot">
                    <h1 class="netType">Machine Net</h1>
                    <div class="row">
                        <?php
                        $timeslots = time_slot($duration, $cleanup, $start, $end);
                        foreach ($timeslots as $ts) {
                            ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                    $found = false;
                                    foreach ($new_array_1 as $reservation) {
                                        if ($reservation->timeSlot === $ts) {
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if ($found) { ?>
                                        <button class="btn btn-danger">
                                            <?php echo $ts; ?>
                                        </button>
                                    <?php } else { ?>
                                        <a href="http://localhost/C&A_Indoor_Project/Pages/Booking_Register/user?timeslot=<?php echo urlencode($ts); ?>&timedate=<?php echo $selected_date; ?>&net=Machine Net"
                                            style="text-decoration: none; color:inherit;">
                                            <button class="btn btn-success">
                                                <?php echo $ts; ?>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function closePopup() {
            document.getElementById('popup-container').style.display = 'none';
        }

        // Show the popup when the page is loaded
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('popup-container').style.display = 'block';
        });

    </script>

</body>

</html>