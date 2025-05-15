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


    </style>
</head>
<body>
    <header>
        <h1>Air Quality Index Forecasting</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="history.php">Reports</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </header>

</div>

    </div>
</div>

<div style="display: flex; justify-content: center; width: 100%;">
    <div class="aqi-prediction-container" style="
        width: 100%;
        max-width: 1186px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0px;
        padding: 10px 20px;
        margin-top: 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    ">
        <h2 id="aqi_title" style="margin: 0;">Air Quality Prediction for --</h2>
        <div style="display: flex; align-items: center;">
            <div id="aqi_display" style="font-size: 1.6rem; font-weight: bold; margin-right: 10px;">AQI: --</div>
            <div id="aqi_level" class="level-card" style="padding: 5px 12px; border-radius: 6px;">--</div>
        </div>
    </div>
</div>



<div class="dashboard">
    <!-- First Row of Pollutants -->
    <div class="metric-card">
        <h3>PM2.5</h3>
        <div class="metric-values">
            <p><span id="pm25_val">-- µg/m³</span></p>
            <div class="level-card" id="pm25_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>PM10</h3>
        <div class="metric-values">
            <p><span id="pm10_val">-- µg/m³</span></p>
            <div class="level-card" id="pm10_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>CO</h3>
        <div class="metric-values">
            <p><span id="co_val">-- ppm</span></p>
            <div class="level-card" id="co_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>O3</h3>
        <div class="metric-values">
            <p><span id="o3_val">-- ppb</span></p>
            <div class="level-card" id="o3_level">--</div>
        </div>
    </div>

    <!-- Second Row of Pollutants -->
    <div class="metric-card">
        <h3>SO2</h3>
        <div class="metric-values">
            <p><span id="so2_val">-- ppm</span></p>
            <div class="level-card" id="so2_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>CH4</h3>
        <div class="metric-values">
            <p><span id="ch4_val">-- ppm</span></p>
            <div class="level-card" id="ch4_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>Temperature</h3>
        <div class="metric-values">
            <p><span id="temp_val">--°C</span></p>
            <div class="level-card" id="temp_level">--</div>
        </div>
    </div>

    <div class="metric-card">
        <h3>Humidity</h3>
        <div class="metric-values">
            <p><span id="hum_val">--%</span></p>
            <div class="level-card" id="hum_level">--</div>
        </div>
    </div>
</div>


<script>
function updateSensorData() {
    fetch('http://localhost/thesiss/air_quality_ml/prediction_1h.txt')
        .then(response => response.text())
        .then(text => {
            const blocks = text.trim().split('----').map(block => block.trim()).filter(b => b);
            const latestBlock = blocks[blocks.length - 1];

            const lines = latestBlock.split('\n').map(line => line.trim());
            const data = {};

            lines.forEach(line => {
                if (line.startsWith('Timestamp:')) {
                    data.timestamp = line.replace('Timestamp:', '').trim();
                } else if (line.includes(':')) {
                    const [key, value] = line.split(':').map(s => s.trim());
                    switch (key.toLowerCase()) {
                        case 'temp': data.TEMP = parseFloat(value); break;
                        case 'hum': data.HUM = parseFloat(value); break;
                        case 'ch4': data.CH4 = parseFloat(value); break;
                        case 'co': data.CO = parseFloat(value); break;
                        case 'so2': data.H2 = parseFloat(value); break; // still using H2 for compatibility
                        case 'o3': data.O3 = parseFloat(value); break;
                        case 'pm25': data.PM25 = parseFloat(value); break;
                        case 'pm10': data.PM10 = parseFloat(value); break;
                        case 'aqi': data.AQI = parseFloat(value); break;
                    }
                }
            });

            // Update AQI display
            document.getElementById('aqi_title').textContent = '1-Hour Forecast for ' + data.timestamp;
            document.getElementById('aqi_display').textContent = 'AQI Prediction: ' + data.AQI.toFixed(2);

            // Apply AQI level
            applyLevel('aqi_level', getAQILevel(data.AQI));

            // Update metric cards
            document.getElementById('pm25_val').textContent = data.PM25 + ' µg/m³';
            document.getElementById('pm10_val').textContent = data.PM10 + ' µg/m³';
            document.getElementById('co_val').textContent = data.CO + ' ppm';
            document.getElementById('o3_val').textContent = data.O3 + ' ppb';
            document.getElementById('so2_val').textContent = data.H2 + ' ppm';
            document.getElementById('ch4_val').textContent = data.CH4 + ' ppm';
            document.getElementById('temp_val').textContent = data.TEMP + '°C';
            document.getElementById('hum_val').textContent = data.HUM + '%';

            // Update level indicators
            applyLevel('pm25_level', getPM25Level(data.PM25));
            applyLevel('pm10_level', getPM10Level(data.PM10));
            applyLevel('co_level', getCOLevel(data.CO));
            applyLevel('o3_level', getO3Level(data.O3));
            applyLevel('so2_level', getSO2Level(data.H2));
            applyLevel('ch4_level', getCH4Level(data.CH4));
            applyLevel('temp_level', getTempLevel(data.TEMP));
            applyLevel('hum_level', getHumLevel(data.HUM));
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
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




