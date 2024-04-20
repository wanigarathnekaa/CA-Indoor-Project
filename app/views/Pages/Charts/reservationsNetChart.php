<?php
$reservations = $data['bookings']; // Make sure $data is initialized with your reservations data

// Get today's date
$today = date('Y-m-d');
$today_name = date('l');

// Get the starting date (Sunday) of the current week
if ($today_name == 'Sunday') {
    $startOfWeek = strtotime('today');
} else {
    $startOfWeek = strtotime('last sunday');
}

$startOfWeekFormatted = date('Y-m-d', $startOfWeek);

// Get the ending date (Saturday) of the current week
if ($today_name == 'Saturday') {
    $endOfWeek = strtotime('today');
} else {
    $endOfWeek = strtotime('next saturday');
}

$endOfWeekFormatted = date('Y-m-d', $endOfWeek);

$count_A = 0;
$count_B = 0;
$count_M = 0;
for ($i = $startOfWeek; $i <= $endOfWeek; $i += 86400) { // 86400 seconds in a day
    foreach ($reservations as $reservation) {
        $reservationDate = strtotime($reservation->date); 
        if ($reservationDate == $i) {
            if ($reservation->netType == "Machine Net") {
                $count_M++;
            } elseif ($reservation->netType == "Normal Net A") {
                $count_A++;
            } elseif ($reservation->netType == "Normal Net B") {
                $count_B++;
            }
        }
    }
}  

$nameList = ["Machine Net", "Normal Net A", "Normal Net B"];
$countList = [$count_M, $count_A, $count_B];

?>

<div class="chart3">
    <h1>Reservations</h1>
    <canvas id="reservationCountChart"></canvas>
</div>

<script>
    var xValues = <?php echo json_encode($nameList); ?>;
    var yValues = <?php echo json_encode($countList); ?>;
    console.log(xValues);
    console.log(yValues);
    var barColors = ["#2e8a99", "#4F9DA9", "#A7D8D7"];

    new Chart("reservationCountChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {}
    });
</script>
