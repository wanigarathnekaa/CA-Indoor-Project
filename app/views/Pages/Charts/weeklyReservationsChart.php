<?php
$link = mysqli_connect("localhost", "root", "", "c&a_indoor_net");
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$counts = array(
    'Sunday' => 0,
    'Monday' => 0,
    'Tuesday' => 0,
    'Wednesday' => 0,
    'Thursday' => 0,
    'Friday' => 0,
    'Saturday' => 0
);

$res = mysqli_query($link, "SELECT DAYNAME(date) AS day_name, COUNT(*) AS reservation_count FROM reservation GROUP BY DAYOFWEEK(date)");

while ($row = mysqli_fetch_assoc($res)) {
    $day_name = $row['day_name'];
    $counts[$day_name] = $row['reservation_count'];
}

mysqli_close($link);
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
                  datasets: [{
                        label: 'Number of Reservations',
                        data: [<?php echo implode(',', $counts); ?>],
                        borderWidth: 1,
                        backgroundColor: "#4F9DA9",
                  }]
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
