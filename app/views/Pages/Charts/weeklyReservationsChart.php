<?php

// Assuming $data contains your reservations array
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


$countList = [];
for ($i = $startOfWeek; $i <= $endOfWeek; $i += 86400) { // 86400 seconds in a day
    $date_of_week = date('Y-m-d', $i);
    $count = 0;
    foreach ($reservations as $reservation) {
        $reservationDate = strtotime($reservation->date); // Convert reservation date to timestamp
        if ($reservationDate == $i) {
            $count++;
        }
    }
    // Store the count in the list
    $countList[] = $count;
}  

// Convert countList to JSON for JavaScript
$countListJSON = json_encode($countList);

?>

<div class="chart1">
    <h1>Weekly Reservations</h1>
    <canvas id="weeklyReservations"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyReservations');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            datasets: [
                {
                    label: 'Number of Reservations',
                    data: <?= $countListJSON ?>,
                    borderWidth: 1,
                    backgroundColor: "#4F9DA9",
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
