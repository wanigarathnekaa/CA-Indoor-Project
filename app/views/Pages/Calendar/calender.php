<?php

$bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;
function build_calendar($month, $year)
{
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $lastDayOfMonth = mktime(0, 0, 0, $month, date('t', $firstDayOfMonth), $year);
    $dateToday = date('Y-m-d');
    $lastReservationDay = strtotime('+14 days');

    $bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;
    $calendar = "<center><h2 class='date'>" . date('F', $firstDayOfMonth) . " $year</h2>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . date('m', strtotime('-1 month', $firstDayOfMonth)) . "&year=" . date('Y', strtotime('-1 month', $firstDayOfMonth)) . "&bookingID=" . $bookingId . "' target='_self'_>Prev Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . date('m') . "&year=" . date('Y') . "&bookingID=" . $bookingId . "'>Current Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . date('m', strtotime('+1 month', $firstDayOfMonth)) . "&year=" . date('Y', strtotime('+1 month', $firstDayOfMonth)) . "&bookingID=" . $bookingId . "'>Next Month</a></center> ";

    $calendar .= "<br><table class='calander'> ";
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $calendar .= "</tr><tr>";
    $currentDay = 1;

    while ($currentDay <= date('t', $firstDayOfMonth) && $firstDayOfMonth <= $lastReservationDay) {
        $dayOfWeek = date('w', $firstDayOfMonth);
        if ($dayOfWeek == 0) {
            $calendar .= "</tr><tr>";
        }

        $date = date('Y-m-d', $firstDayOfMonth);
        $today = ($date == $dateToday) ? 'today' : '';

        if ($date < $dateToday) {
            $calendar .= "<td class='empty'></td>";
        } else {
            $calendar .= "<td class='$today'><a href='http://localhost/C&A_Indoor_Project/Pages/Manager_Booking/manager?fulldate=$date&bookingID=" . $bookingId . "' class = 'btn btn-success btn-xs' target='_top'><h4>" . date('j', $firstDayOfMonth) . "</h4></a></td>";
        }

        $firstDayOfMonth = strtotime('+1 day', $firstDayOfMonth);
        $currentDay++;
    }

    if ($dayOfWeek < 6) {
        $remainingDays = 6 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr></table>";

    return $calendar;
}

?>

<html>

<head>
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/calander_style.css">
</head>

<body>
    <div class="calander-container">
                <?php
                $dateComponent = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponent['mon'];
                    $year = $dateComponent['year'];
                }

                echo build_calendar($month, $year);
                ?>
    </div>
</body>

</html>