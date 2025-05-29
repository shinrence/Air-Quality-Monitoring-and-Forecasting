<?php
// history.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  list-style-type: "🛑";
  padding-left: 20px;
}

.container ul li {
  margin: 5px 0;
}

table ul {
  padding-left: 18px;
  margin: 0;
}

@media (max-width: 768px) {

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0, 0, 0, 0.6);
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    flex-wrap: wrap;
    margin-right: -10px;

}


/* Navigation */
nav ul {
    list-style: none;
    display: flex;
    gap: 25px;
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
    font-size: 14px;
    padding: 2px;
}

nav ul li a:hover {
    color: #ffcc00;
}


    .forecast-button-wrapper a {
        text-align: center;
        width: 100%;
    }

    .forecast-button-wrapper button {
        width: 90%;
        max-width: 300px;
    }
}
  </style>
</head>
<body>
  <header>
    <h1>Air Quality Index</h1>
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
  <h2 style="color: #ffcc00;">Air Quality Information: <span style="color: #7b1fa2;">Very Unhealthy 🛑</span></h2>
  <p>
    Health warnings of emergency conditions. The entire population is more likely to be affected. Sensitive groups may experience more severe effects.
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
            <li>Stay indoors with windows and doors closed at all times.</li>
            <li>Use air purifiers or filtered air conditioning systems.</li>
            <li>Minimize indoor activities that worsen air quality (e.g., smoking, burning candles).</li>
            <li>Check on elderly family members or neighbors, especially those with respiratory or heart conditions.</li>
            <li>Follow your doctor’s instructions if you have asthma or a heart condition.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>🚫 What to Avoid</td>
        <td>
          <ul style="text-align: left;">
            <li>Avoid all outdoor activities and exercise completely.</li>
            <li>Do not open windows or ventilate your home with outside air.</li>
            <li>Stay away from traffic areas or any place with additional pollution sources.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>ℹ️ Additional Tips</td>
        <td>
          <ul style="text-align: left;">
            <li>Wear N95 masks if you must be outside briefly.</li>
            <li>Keep children, elderly people, and pets inside.</li>
            <li>Use indoor plants or HEPA filters to help clean air indoors.</li>
            <li>Have emergency contacts and medical kits ready.</li>
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