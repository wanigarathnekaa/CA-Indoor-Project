<?php
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

    $calendar = "<center><h2 class='date'>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . $prev_month . "&year=" . $prev_year . "' target='_self'_>Prev Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender'>Current Month</a> ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='http://localhost/C&A_Indoor_Project/Pages/Calendar/calender?month=" . $next_month . "&year=" . $next_year . "'>NextMonth</a></center> ";

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
        }
        else {
            // $calendar .= "<td class='$today'><h4>$currentDay</h4><a href='http://localhost/C&A_Indoor_Project/Pages/Booking/user' class = 'btn btn-success btn-xs' target='_top'>Book</a></td>";
            $calendar .= "<td class='$today'><a href='http://localhost/C&A_Indoor_Project/Pages/Booking/user?fulldate=$date' class = 'btn btn-success btn-xs' target='_top'><h4>$currentDay</h4></a></td>";
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