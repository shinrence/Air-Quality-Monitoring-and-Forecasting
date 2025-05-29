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
  <h2 style="color: #ffcc00;">Air Quality Information: <span style="color: #9e1e32;">Hazardous ☠️</span></h2>
  <p>
    Serious health effects for the entire population. Emergency health warnings. The situation is dangerous for everyone, not just sensitive groups.
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
            <li>Remain indoors at all times. Treat this as a public health emergency.</li>
            <li>Use high-efficiency air purifiers or a filtered HVAC system continuously.</li>
            <li>Seal your home to prevent outside air from entering — use damp towels under doors and window gaps.</li>
            <li>Monitor your health closely, especially if you have existing conditions.</li>
            <li>Contact local authorities or hospitals for emergency help if symptoms arise.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>🚫 What to Avoid</td>
        <td>
          <ul style="text-align: left;">
            <li>Do not go outside for any reason unless it's an emergency.</li>
            <li>Refrain from lighting candles, cooking with strong fumes, or using aerosol products indoors.</li>
            <li>Avoid indoor workouts or strenuous activity.</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>⚠️ Emergency Guidance</td>
        <td>
          <ul style="text-align: left;">
            <li>If air purifiers or safe shelter are unavailable, consider temporary relocation.</li>
            <li>Follow local government advisories and evacuation notices if applicable.</li>
            <li>Keep emergency supplies, medications, and medical contact numbers within reach.</li>
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