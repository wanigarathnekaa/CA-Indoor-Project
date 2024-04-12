<?php

// Assuming $data contains your reservations array
$reservations = $data;

// Function to get the start and end date of a week given any date
function get_week_boundaries($date) {
    $start_of_week = strtotime('last Sunday', strtotime($date));
    $end_of_week = strtotime('next Saturday', $start_of_week);
    return [$start_of_week, $end_of_week];
}

// Initialize a chart to store the number of reservations for each day
$chart = [];

// Iterate through the reservations
foreach ($reservations as $reservation) {
    $reservation_date = strtotime($reservation->date);
    list($start_of_week, $end_of_week) = get_week_boundaries(date("Y-m-d", $reservation_date));

    // If the start_of_week key doesn't exist in the chart, initialize it
    if (!isset($chart[$start_of_week])) {
        $chart[$start_of_week] = [];
    }

    // If the reservation date key doesn't exist in the chart, initialize it
    if (!isset($chart[$start_of_week][$reservation_date])) {
        $chart[$start_of_week][$reservation_date] = 0;
    }

    // Increment the count for the reservation date
    $chart[$start_of_week][$reservation_date]++;
}

// Prepare data for Chart.js
$weekly_counts = [];
$day_labels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

foreach ($chart as $week) {
    $weekly_count = [];
    foreach ($day_labels as $day) {
        // If the day doesn't exist in the current week, set count to 0
        $weekly_count[] = isset($week[strtotime($day)]) ? $week[strtotime($day)] : 0;
    }
    $weekly_counts[] = $weekly_count;
}

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
                <?php foreach ($weekly_counts as $week_count): ?>
                    {
                        label: 'Number of Reservations',
                        data: <?php echo json_encode($week_count); ?>,
                        borderWidth: -3,
                        backgroundColor: "#4F9DA9",
                    },
                <?php endforeach; ?>
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