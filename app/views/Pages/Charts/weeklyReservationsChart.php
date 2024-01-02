<div>
      <h1>Weekly Reservations</h1>
      <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
      const ctx = document.getElementById('myChart');
      new Chart(ctx, {
            type: 'bar',
            data: {
                  labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                  datasets: [{
                        label: 'Number of Reservations',
                        data: [12, 19, 3, 5, 2, 3,10],
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