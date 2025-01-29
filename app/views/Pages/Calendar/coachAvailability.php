<?php
date_default_timezone_set('Asia/Colombo');

$bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;
function build_calendar($month, $year)
{
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));

    $today_date = new DateTime(); // Current date and time

    // Get the last date of the month
    $last_date_of_month = date('Y-m-t', strtotime($today_date->format('Y-m')));

    // Get the third week's last date of the month
    $third_week_last_date = date('Y-m-d', strtotime($last_date_of_month . " -8 day"));

    // Get the first day of next month
    $first_day_next_month = date('Y-m-01', strtotime($today_date->format('Y-m') . ' +1 month'));

    // Get the last date of next month
    $last_date_next_month = date('Y-m-t', strtotime($first_day_next_month));

    $bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : 0;
    $calendar = "<center><h2 class='date'>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/CoachCalendar/calender?month=" . $prev_month . "&year=" . $prev_year . "&bookingID=" . $bookingId . "' target='_self'_>Prev Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/CoachCalendar/calender&bookingID=" . $bookingId . "'>Current Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/CoachCalendar/calender?month=" . $next_month . "&year=" . $next_year . "&bookingID=" . $bookingId . "'>NextMonth</a></center> ";

    $calendar .= "<br><table class='calander'> ";
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $calendar .= "</tr><tr>";
    $currentDay = 1;
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    if($dateToday >= $third_week_last_date && $dateToday <= $last_date_of_month){
        $last_date_of_month = $last_date_next_month;
    }

    // echo "Today's date: $dateToday";
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayName = strtolower(date('l', strtotime($date)));
        $today = ($date == $dateToday) ? 'today' : '';

        if ($date < date('Y-m-d')) {
            $calendar .= "<a class = 'btn btn-danger btn-xs'><td class='$today'><h4>$currentDay</h4></td></a>";
        } else if ($date <= $last_date_of_month) {
            $bookingId = isset($_GET['bookingID']) ? urldecode($_GET['bookingID']) : '';
            $calendar .= "<td class='$today'><a href='http://localhost/C&A_Indoor_Project/Pages/coachAvailability/coach?fulldate=$date&bookingID=" . $bookingId . "' class = 'btn btn-success btn-xs' target='_top'><h4>$currentDay</h4></a></td>";
        } else {
            $calendar .= "<a class = 'btn btn-danger btn-xs'><td class='$today'><h4>$currentDay</h4></td></a>";
        }
        // echo $today;


        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek < 7) {
        $remainingDays = 7 - $dayOfWeek;
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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/calander_style.css">
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