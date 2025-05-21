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
  list-style-type: "⚠️";
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
    <h1>Air Quality Index Forecasting</h1>
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
  <h2 style="color: #ffcc00;">Air Quality Information: <span style="color: #ff5722;">Unhealthy for Sensitive Groups ⚠️</span></h2>
  <p>
    Air quality is unhealthy for people with respiratory or heart conditions, older adults, and children. The general public is not likely to be affected at this level, but caution is still advised.
  </p>

  <table>
    <thead>
      <tr>
        <th>Category</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>✅ What You Can Do</td>
        <td>
          <ul style="text-align: left;">
            <li><strong>People with asthma, heart disease, the elderly, and children</strong> should reduce prolonged or heavy exertion outdoors.</li>
            <li>Use masks if going outdoors is necessary (preferably N95 or better).</li>
            <li>Use air purifiers indoors and keep windows closed.</li>
            <li>Monitor your symptoms closely and follow your healthcare provider's plan.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>🚫 What to Avoid</td>
        <td>
          <ul style="text-align: left;">
            <li>Don’t engage in strenuous outdoor activities, especially in the morning and evening when pollution tends to spike.</li>
            <li>Avoid areas with high traffic or industrial emissions.</li>
            <li>Avoid exposure to smoke, strong odors, or burning trash.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>ℹ️ Additional Tips</td>
        <td>
          <ul style="text-align: left;">
            <li>Use air quality apps or your dashboard to track changes in real time.</li>
            <li>Encourage schools and workplaces to adjust outdoor plans accordingly.</li>
            <li>If you experience chest pain, difficulty breathing, or fatigue, seek medical attention promptly.</li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
</div>



  <footer>
    <p>© 2025 Shinrence Air Quality Dashboard. All rights reserved.</p>
  </footer>


</body>
</html>