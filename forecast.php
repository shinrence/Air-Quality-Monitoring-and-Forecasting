<?php
// Include any necessary files for database connection or API calls to get air quality data
// Example: You could fetch the data from a database or an API.

// Function to determine the level of concern based on the value of each pollutant

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Quality Monitoring Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>



    <style>
        /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1e1e2f, #12121f);
    color: white;
    margin: 0;
    padding: 0;
}

/* Header */
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

/* Navigation */
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

@media (max-width: 768px) {

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    flex-wrap: wrap;
    margin-right: -5px;

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

/* Dashboard Container */
.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px; /* Increased spacing between cards */
    margin-top: 20px;
    max-width: 1230px; /* Restrict width */
    margin-left: auto;
    margin-right: auto;
    padding: 0 20px; /* Prevents pushing to screen edge */
    justify-content: center;
}

/* Pollutant Cards */
.metric-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Glow effect based on severity */
.metric-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Divider Line */
.metric-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 2px;
    background: rgba(255, 255, 255, 0.2);
}

/* Pollutant Value */
.metric-values p {
    font-size: 1.5rem;
    font-weight: bold;
}

/* Level Indicator */
.level-card {
    padding: 6px 12px;
    border-radius: 8px;
    text-align: center;
    font-weight: bold;
    color: white;
    margin-top: 10px;
    display: inline-block;
    transition: transform 0.3s ease;
}

/* Hover Effect */
.level-card:hover {
    transform: scale(1.1);
}


/* Footer */
footer {
    text-align: center;
    padding: 20px;
    margin-top: 40px;
    background: rgba(0, 0, 0, 0.6);
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
  text-align: center;
}

@media screen and (max-width: 600px) {
  table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
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

</div>

    </div>
</div>

<!-- Prediction Header -->
<!-- AQI Prediction Container -->
<div class="aqi-prediction-container" style="margin-top: 0px; padding: 10px; border-radius: 12px;">
  <h2 id="timestamp" style="text-align: center; color: white; margin-bottom: 10px;">Date: --</h2>

  <!-- Scrollable wrapper -->
  <div style="overflow-x: auto;">

    <table style="min-width: 800px; width: 100%; border-collapse: collapse; table-layout: fixed; color: white; text-align: center;">
      <thead>
        <tr style="background-color: #2a2a2a;">
          <th rowspan="2" style="border: 1px solid #444; padding: 10px;">Hour</th>
          <th style="border: 1px solid #444; padding: 10px;">PM2.5</th>
          <th style="border: 1px solid #444; padding: 10px;">PM10</th>
          <th style="border: 1px solid #444; padding: 10px;">CO</th>
          <th style="border: 1px solid #444; padding: 10px;">O₃</th>
          <th style="border: 1px solid #444; padding: 10px;">SO₂</th>
          <th style="border: 1px solid #444; padding: 10px;">Heat Index</th>
          <th style="border: 1px solid #444; padding: 10px;">Temp</th>
          <th style="border: 1px solid #444; padding: 10px;">Humidity</th>
          <th style="border: 1px solid #444; padding: 10px;">AQI</th>
        </tr>
      </thead>

      <tbody>
        <tr id="value-row" style="background-color: #292929;">
          <!-- JS will insert <td> with padding and borders here -->
        </tr>
        <tr id="level-row" style="background-color: #202020;">
          <!-- JS will insert <td> with padding, color, borders here -->
        </tr>
      </tbody>
    </table>

  </div> <!-- end of scrollable wrapper -->

</div>

<script>
function updateSensorData() {
    fetch('forecast_data_api.php')
        .then(response => response.json())
        .then(data => {
            const latestBlocks = data.slice(-8); // Get the latest 8 blocks only

            // Update the timestamp to reflect the range
            const firstTimestamp = latestBlocks[0].timestamp;
            const lastTimestamp = latestBlocks[latestBlocks.length - 1].timestamp;
            document.getElementById('timestamp').textContent = `8-Hour Air Quality Forecast: ${firstTimestamp} - ${lastTimestamp}`;

            const tbody = document.querySelector('.aqi-prediction-container tbody');
            tbody.innerHTML = ''; // Clear previous rows

            latestBlocks.forEach(item => {
                const hour = item.hour_range;
                const values = item.values;

                // Map h2 to so2
                values.so2 = values.h2;

                const pollutants = ['pm25', 'pm10', 'co', 'o3', 'so2', 'ch4', 'temp', 'hum', 'aqi'];

                const valueRow = document.createElement('tr');
                valueRow.style.backgroundColor = '#292929';

                const levelRow = document.createElement('tr');
                levelRow.style.backgroundColor = '#000000';

                const hourCell = document.createElement('td');
                hourCell.textContent = hour;
                hourCell.setAttribute('rowspan', '2');
                hourCell.style.border = '1px solid #444';
                hourCell.style.padding = '10px';
                hourCell.style.backgroundColor = '#2a2a2a';
                hourCell.style.fontWeight = 'bold';
                valueRow.appendChild(hourCell);

                pollutants.forEach(key => {
                    const val = values[key];
                    const tdValue = document.createElement('td');
                    const tdLevel = document.createElement('td');

                    tdValue.textContent = (key === 'temp') ? `${val}°C` :
                                          (key === 'hum') ? `${val}%` :
                                          (key === 'o3') ? `${val} ppm` :
                                          (key === 'pm25') ? `${val} µg/m³` :
                                          (key === 'pm10') ? `${val} µg/m³` :
                                          (key === 'co') ? `${val} ppm` :
                                          (key === 'so2') ? `${val} ppb` :
                                          (key === 'ch4') ? `${val} °C` :
                                          (key === 'aqi') ? val.toFixed(2) :
                                          `${val}`;

                    tdValue.style.padding = '10px';
                    tdValue.style.border = '1px solid #444';
                    tdValue.style.boxSizing = 'border-box';

                    let levelInfo;
                    switch (key) {
                        case 'pm25': levelInfo = getPM25Level(val); break;
                        case 'pm10': levelInfo = getPM10Level(val); break;
                        case 'co': levelInfo = getCOLevel(val); break;
                        case 'o3': levelInfo = getO3Level(val); break;
                        case 'so2': levelInfo = getSO2Level(val); break;
                        case 'ch4': levelInfo = getCH4Level(val); break;
                        case 'temp': levelInfo = getTempLevel(val); break;
                        case 'hum': levelInfo = getHumLevel(val); break;
                        case 'aqi': levelInfo = getAQILevel(val); break;
                    }

                    tdLevel.textContent = levelInfo.level;
                    tdLevel.style.backgroundColor = levelInfo.color;
                    tdLevel.style.padding = '2px';
                    tdLevel.style.margin = '0';
                    tdLevel.style.border = '1px solid #555';
                    tdLevel.style.boxSizing = 'border-box';

                    valueRow.appendChild(tdValue);
                    levelRow.appendChild(tdLevel);
                });

                tbody.appendChild(valueRow);
                tbody.appendChild(levelRow);

                // Add spacer
                const spacer = document.createElement('tr');
                const spacerTd = document.createElement('td');
                spacerTd.colSpan = 10;
                spacerTd.style.height = '10px';
                spacer.appendChild(spacerTd);
                tbody.appendChild(spacer);
            });
        })
        .catch(error => console.error('Error fetching prediction data:', error));
}



function applyLevel(elementId, levelInfo) {
    const el = document.getElementById(elementId);
    el.textContent = levelInfo.level;
    el.style.backgroundColor = levelInfo.color;
}

function getAQILevel(v) {
    if (v <= 50) return { level: 'Good', color: 'green' };
    if (v <= 100) return { level: 'Moderate', color: 'yellow' };
    if (v <= 150) return { level: 'Unhealthy for Sensitive', color: 'orange' };
    if (v <= 200) return { level: 'Unhealthy', color: 'red' };
    if (v <= 300) return { level: 'Very Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

// Threshold Functions
function getPM25Level(v) {
    if (v <= 9) return { level: 'Good', color: 'green' };
    if (v <= 35.4) return { level: 'Moderate', color: 'yellow' };
    if (v <= 55.4) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 120.4) return { level: 'Unhealthy', color: 'red' };
    if (v <= 225.4) return { level: 'Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

function getPM10Level(v) {
    if (v <= 54) return { level: 'Good', color: 'green' };
    if (v <= 154) return { level: 'Moderate', color: 'yellow' };
    if (v <= 254) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 354) return { level: 'Unhealthy', color: 'red' };
    if (v <= 424) return { level: 'Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

function getCOLevel(v) {
    if (v <= 35) return { level: 'Good', color: 'green' };
    if (v <= 50) return { level: 'Moderate', color: 'yellow' };
    if (v <= 69) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 89) return { level: 'Unhealthy', color: 'red' };
    if (v <= 109) return { level: 'Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

function getO3Level(v) {
    if (v <= 0.074) return { level: 'Good', color: 'green' };
    if (v <= 0.124) return { level: 'Moderate', color: 'yellow' };
    if (v <= 0.164) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 0.204) return { level: 'Unhealthy', color: 'red' };
    if (v <= 0.404) return { level: 'Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

function getSO2Level(v) {
    if (v <= 35) return { level: 'Good', color: 'green' };
    if (v <= 75) return { level: 'Moderate', color: 'yellow' };
    if (v <= 185) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 304) return { level: 'Unhealthy', color: 'red' };
    if (v <= 604) return { level: 'Unhealthy', color: 'purple' };
    return { level: 'Hazardous', color: 'maroon' };
}

function getCH4Level(v) {
    if (v <= 50) return { level: 'Good', color: 'green' };
    if (v <= 100) return { level: 'Moderate', color: 'yellow' };
    if (v <= 200) return { level: 'Unhealthy', color: 'orange' };
    if (v <= 400) return { level: 'Unhealthy', color: 'red' };
    return { level: 'Hazardous', color: 'purple' };
}

// Temperature Level Function
function getTempLevel(v) {
    if (v <= 25) return { level: 'Cool', color: 'blue' };
    if (v <= 31) return { level: 'Good', color: 'lightblue' };
    if (v <= 32) return { level: 'Warm', color: 'yellow' };
    if (v <= 35) return { level: 'Hot', color: 'orange' };
    if (v <= 40) return { level: 'Very Hot', color: 'red' };
    return { level: 'Extreme Heat', color: 'darkred' };
}

// Humidity Level Function
function getHumLevel(v) {
    if (v <= 39) return { level: 'Too Dry', color: 'brown' };
    if (v <= 60) return { level: 'Optimal', color: 'green' };
    return { level: 'Too Humid', color: 'purple' };
}

// Start once and repeat every 5 seconds
updateSensorData();
setInterval(updateSensorData, 5000);
</script>

    <footer>
        <p>© 2025 Shinrence Air Quality Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>




