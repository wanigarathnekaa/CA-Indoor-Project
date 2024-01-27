<div class="chart2">
      <h1>Customers</h1>
      <canvas id="customerCountChart"></canvas>
</div>

<script>
var xValues = ["Players", "Coaches"];
var yValues = [<?php echo $data1["UserCount"]?>, <?php echo $data1["CoachCount"]?>];
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

