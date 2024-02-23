<?php
$link = mysqli_connect("localhost", "root", "71571698", "c&a_indoor_net");
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query to get the count of coaches
$res_coaches = mysqli_query($link, "SELECT COUNT(*) AS coach_count FROM coaches");
$row_coaches = mysqli_fetch_assoc($res_coaches);
$coach_count = $row_coaches['coach_count'];

// Query to get the total count of users (players + coaches)
$res_total_users = mysqli_query($link, "SELECT COUNT(*) AS total_user_count FROM user");
$row_total_users = mysqli_fetch_assoc($res_total_users);
$total_user_count = $row_total_users['total_user_count'];

// Calculate the count of players
$player_count = $total_user_count - $coach_count;

mysqli_close($link);
?>

<div class="chart2">
      <h1>Customers</h1>
      <canvas id="customerCountChart"></canvas>
</div>

<script>
var xValues = ["Players", "Coaches"];
var yValues = [<?php echo $player_count ?>, <?php echo $coach_count ?>];
var barColors = ["#4F9DA9","#A7D8D7"];

new Chart("customerCountChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
      
  }
});
</script>
