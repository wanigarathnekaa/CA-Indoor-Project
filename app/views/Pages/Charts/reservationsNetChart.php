<?php
$link = mysqli_connect("localhost", "root", "", "c&a_indoor_net");
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query to get the count of reservations for each "Net" type
$res_net_counts = mysqli_query($link, "SELECT net, COUNT(*) AS reservation_count FROM reservation GROUP BY net");
$net_counts = array();
while ($row = mysqli_fetch_assoc($res_net_counts)) {
    // Merge "B" and "Net B" counts into a single count for "Net B"
    if ($row['net'] == 'B' || $row['net'] == 'Normal Net B') {
        $net = 'Normal Net B';
    } else {
        $net = $row['net'];
    }
    if (isset($net_counts[$net])) {
        $net_counts[$net] += $row['reservation_count'];
    } else {
        $net_counts[$net] = $row['reservation_count'];
    }
}

mysqli_close($link);
?>

<div class="chart3">
    <h1>Reservations</h1>
    <canvas id="reservationCountChart"></canvas>
</div>

<script>
    var xValues = <?php echo json_encode(array_keys($net_counts)); ?>;
    var yValues = <?php echo json_encode(array_values($net_counts)); ?>;
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
