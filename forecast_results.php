<?php
// history.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pollutant History</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1e1e2f, #12121f);
      color: white;
      margin: 0;
      padding: 0;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(0, 0, 0, 0.6);
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
      border-bottom: 2px solid rgba(255, 255, 255, 0.2);
      flex-wrap: wrap;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: center;
      padding: 0;
    }

    nav ul li {
      display: inline-block;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
      font-size: 16px;
      padding: 10px;
    }

    nav ul li a:hover {
      color: #ffcc00;
    }

    .container {
      max-width: 1100px;
      margin: auto;
      padding: 20px;
    }

    select {
      margin: 10px 0;
      padding: 8px;
      background-color: #1e1e1e;
      border: 1px solid #333;
      color: #fff;
      font-size: 1rem;
      border-radius: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #444;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #333;
    }

    .toggle-button {
      margin-top: 12px;
      margin-bottom: 10px;
      float: right;
      background-color: #444;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .toggle-button:hover {
      background-color: #666;
    }

    canvas {
      margin-top: 20px;
    }

    footer {
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      background: rgba(0, 0, 0, 0.6);
    }

.container h2, .container h3 {
  color: #ffcc00;
}

.container ul {
  list-style-type: "☠️";
  padding-left: 20px;
}

.container ul li {
  margin: 5px 0;
}

table ul {
  padding-left: 18px;
  margin: 0;
}

  </style>
</head>
<body>
  <header>
    <h1>Air Quality Index Details</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="reports.php">About</a></li>
      </ul>
    </nav>
  </header>

<div class="container">
  <h2>Hourly AQI: Actual vs Predicted</h2>
  <canvas id="aqiChart" width="600" height="400"></canvas>
</div>


<script>
async function fetchAndDisplayAQI() {
  const actualUrl = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php';
  const predictedUrl = 'https://air-quality-php-backend.onrender.com/forecast_data_api.php';

  const [actualRes, predictedRes] = await Promise.all([
    fetch(actualUrl),
    fetch(predictedUrl)
  ]);

  const actualData = await actualRes.json();
  const predictedData = await predictedRes.json();

  // Aggregate actual data by hour
  const actualByHour = {};
  actualData.forEach(entry => {
    const date = new Date(entry.timestamp);
    const hour = date.toISOString().slice(0, 13); // YYYY-MM-DDTHH
    if (!actualByHour[hour]) {
      actualByHour[hour] = { total: 0, count: 0 };
    }
    actualByHour[hour].total += parseFloat(entry.aqi_total);
    actualByHour[hour].count++;
  });

  const actualAverages = {};
  for (const hour in actualByHour) {
    const avg = actualByHour[hour].total / actualByHour[hour].count;
    actualAverages[hour] = avg;
  }

  // Build labels and datasets
  const labels = predictedData.map(p => p.hour_range);
  const predictedValues = predictedData.map(p => p.values.aqi);
  const actualValues = predictedData.map(p => {
    const hourKey = new Date(p.timestamp).toISOString().slice(0, 13); // YYYY-MM-DDTHH
    return actualAverages[hourKey] !== undefined ? actualAverages[hourKey] : null;
  });

  const ctx = document.getElementById('aqiChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Predicted AQI',
          data: predictedValues,
          borderColor: 'rgba(255, 206, 86, 1)',
          backgroundColor: 'rgba(255, 206, 86, 0.2)',
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 4
        },
        {
          label: 'Actual AQI',
          data: actualValues,
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderWidth: 2,
          tension: 0.4,
          pointRadius: 4
        }
      ]
    },
    options: {
      scales: {
        y: {
          title: {
            display: true,
            text: 'AQI Value'
          },
          beginAtZero: true
        },
        x: {
          title: {
            display: true,
            text: 'Hour Range'
          }
        }
      }
    }
  });
}

fetchAndDisplayAQI();
</script>

  <footer>
    <p>© 2025 Shinrence Air Quality Dashboard. All rights reserved.</p>
  </footer>


</body>
</html>
