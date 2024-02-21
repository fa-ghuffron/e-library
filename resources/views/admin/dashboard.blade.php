<x-dashboard-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
          body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
          }
          canvas {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: auto;
            max-height: 600px;
          }
        </style>
      </head>

      <body>

        <label for="yearToggle">Select Year:</label>
        <select id="yearToggle" onchange="updateChart()">
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
        </select>

        <canvas id="myChart" width="900" height="400"></canvas>

        <script>
          const chartData = {
            '2022': { Peminjaman: [65, 59, 80, 81, 56], Pengembalian: [45, 75, 60, 92, 40] },
            '2023': { Peminjaman: [30, 45, 53, 7, 50], Pengembalian: [30, 20, 55, 40, 20] },
            '2024': { Peminjaman: [80, 50, 75, 65, 90], Pengembalian: [20, 30, 45, 60, 70] },
          };

          const data = {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [
              {
                label: 'Column 1',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                borderRadius: 20,
                data: chartData['2022'].Peminjaman,
              },
              {
                label: 'Column 2',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                borderRadius: 20,
                data: chartData['2022'].Pengembalian,
              },
            ],
          };

          const options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            grid: {
              color: '#ccc',
            },
            ticks: {
              color: '#666',
              stepSize: 20,
            },
          },
          x: {
            grid: {
              display: false,
            },
            ticks: {
              color: '#666',
            },
          },
        },
        plugins: {
          legend: {
            labels: {
              color: '#333',
            },
          },
        },
      };


          const ctx = document.getElementById('myChart').getContext('2d');
          const myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options,
          });

          function updateChart() {
            const selectedYear = document.getElementById('yearToggle').value;
            myChart.data.datasets[0].data = chartData[selectedYear].Peminjaman;
            myChart.data.datasets[1].data = chartData[selectedYear].Pengembalian;
            myChart.update();
          }
        </script>
      </body>
</x-dashboard-layout>
