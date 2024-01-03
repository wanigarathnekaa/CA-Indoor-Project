<div class="chart3">
      <h1>Reservations</h1>
      <canvas id="reservationCountChart"></canvas>
</div>

<script>
var xValues = ["Net A", "Net B", "Machine Net"];
var yValues = [10, 15,36];
var barColors = ["#2e8a99","#4F9DA9","#A7D8D7"];

new Chart("reservationCountChart", {
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

