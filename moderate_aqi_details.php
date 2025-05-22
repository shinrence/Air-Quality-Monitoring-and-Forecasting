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
  list-style-type: "🟡";
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
  <h2 style="color: #ffcc00;">Air Quality Information: <span style="color: #ff9800;">Moderate 🟡</span></h2>
  <p>Air quality is acceptable; however, there may be some health concerns for a small number of sensitive individuals.</p>

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
            <li>Most people can continue outdoor activities as usual.</li>
            <li>Monitor air quality if you have respiratory conditions (e.g., asthma).</li>
            <li>Consider reducing strenuous exercise outdoors if you notice symptoms like coughing or shortness of breath.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>🚫 What to Avoid</td>
        <td>
          <ul style="text-align: left;">
            <li>Don't ignore symptoms like throat irritation or fatigue during outdoor activity.</li>
            <li>Limit outdoor exposure for sensitive groups during peak pollution hours.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>ℹ️ Additional Tips</td>
        <td>
          <ul style="text-align: left;">
            <li>Keep windows closed during heavy traffic hours.</li>
            <li>Use air purifiers indoors if you're sensitive to pollutants.</li>
            <li>Check local air quality updates regularly (e.g., via your dashboard).</li>
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