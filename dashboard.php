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

/* Main Container */
/* Main Container */
.container {
    max-width: 1200px;
    margin: 30px auto;
}

body {
    background: linear-gradient(-45deg, #1e1e2f, #12121f, #232344);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}


@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}


button:hover {
    background: linear-gradient(135deg, #ffcc00, #ff6600);
    box-shadow: 0px 0px 10px rgba(255, 102, 0, 0.8);
    transform: scale(1.05);
}

/* Flex container for two equal sections */
.aqi-main-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: stretch; /* Ensures equal height */
    gap: 45px; /* Space between containers */
    width: 100%;
    max-width: 1200px;
}

/* Ensuring equal width & height for both containers */
.aqi-container,
.aqi-trend-container {
    position: relative; 
    flex: 1; /* Equal width */
    display: flex;
    flex-direction: row; /* Ensures contents stack properly */
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    padding: 20px;
    margin: 0;
    min-height: 300px; /* Ensures equal height, adjust as needed */
    margin-left: -12px;
    margin-right: -12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    
}

.pollutant-trend-chart-container {
    width: 100%;
    height: 300px;
    padding: 20px 10px 10px 10px;
    display: flex;
    flex-direction: column;
    position: relative;
}

.aqi-trend-title {
    margin-top: -55px;
    margin-left: 70px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 18px; /* Reduce size for smaller screens */
    font-weight: bold;
    color: white;
    text-transform: uppercase;
    text-align: center;
}

#pollutantTrendContainer {
    flex-grow: 1;
    position: relative;
    height: 100%;
}

#pollutantTrendChart {
    width: 100% !important;
    height: 100% !important;
}

/* Updated select bar */
.pollutant-select-bar {
    align-self: flex-start;
    padding: 5px 10px;
    border-radius: 10px;
    margin-bottom: 20px;
    margin-top: -35px;
    margin-left: 170px;
    z-index: 2;
    position: relative;
}

#pollutantSelect {
    background-color: #333333;
    color: #ffffff;
    border: none;
    font-family: Poppins, sans-serif;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 14px;
}

/* Responsive styling for mobile */
@media screen and (max-width: 600px) {
   

    .pollutant-select-bar {
        width: 100%;
        align-self: center;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 20px;
        margin-right: 170px;
    }

    .aqi-trend-title {
        font-size: 18px;
        margin-top: -100px;
        margin-left: 150px;
        margin-bottom: 70px;
    }
}


/* AQI Trend Chart Container */
.aqi-trend-chart-container {
    width: 94.5%; /* Adjust the overall width */
    max-width: 1200px; /* Prevents stretching on large screens */
    height: auto; /* Auto height to fit content */
    display: flex;
    flex-direction: column; /* Ensures text & chart are stacked properly */
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 15px; /* Reduce padding for compactness */
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    margin: 20px auto;
    position: relative; /* Keeps title positioning */
}

/* AQI Trend Chart */
#aqiTrendContainer {
    width: 100%;
    max-width: 100%;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Adjust chart size */
#aqiTrendChart {
    width: 100%; /* Reduce width for better fit */
    max-width: 1000px; /* Set a maximum width */
    height: 350px; /* Adjust height */
    margin: 50px auto 20px; /* Adjust margins */
    margin-top: 80px;
}

/* AQI Trend Title */


/* Responsive Design for Mobile */
@media screen and (max-width: 768px) {
    .aqi-trend-chart-container {
        width: 90%;
        padding: 10px; /* Reduce padding */
    }

    .aqi-trend-title {
        font-size: 18px; /* Smaller font for mobile */
        top: 10px; /* Adjust position */
    }

    #aqiTrendChart {
        width: 95%; /* Make chart adapt */
        max-width: 600px; /* Reduce max width */
        height: 300px; /* Adjust height */
    }
}

@media screen and (max-width: 480px) {
    .aqi-trend-chart-container {
        width: 87%;
        padding: 8px; /* Compact padding */
        margin-left: 20px ;
    }

    .aqi-trend-title {
        font-size: 15px; /* Even smaller text */
        top: 8px;
    }

    #aqiTrendChart {
        width: 100%;
        max-width: 500px;
        height: 250px;
        margin-top: 60px;
    }
}


.aqi-circle-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 200px; /* Space between AQI circle and pie chart */
    margin-top: -50px;
}

.pie-chart-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 90px;
    margin-right: 50px;
    margin-top: -50px;
}

.pie-chart-wrapper canvas {
    max-width: 250px;
    max-height: 250px;
}



/* AQI Text on Top Left */
.aqi-label {
    position: absolute;
    top: 10px; /* Adjust vertical position */
    left: 10px; /* Adjust horizontal position */
    font-size: 18px;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}


.forecast-button-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 220px;
    margin-left: -362px;
}

.forecast-button-wrapper button {
    padding: 8px 16px;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    background: #0033A0;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 10px rgba(0, 51, 160, 0.3);
}


.forecast-button-wrapper button:active {
    transform: scale(0.98);
    box-shadow: 0px 3px 8px rgba(0, 51, 160, 0.5);
}

.learn-more-button-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 220px; /* Adjust spacing below the first button */
    margin-left: -235px;
}

.learn-more-button-wrapper button {
    padding: 8px 16px;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    background: #0033A0;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 10px rgba(0, 51, 160, 0.3);
}



.learn-more-button-wrapper button:active {
    transform: scale(0.98);
    box-shadow: 0px 3px 8px rgba(0, 51, 160, 0.5);
}

.aqi-precaution-wrapper {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0px;
    max-width: 1000px;
}

.lottie-animation {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 200px;
}

.aqi-precaution-text {
    flex: 2;
    text-align: left;
    color: white;
    font-size: 18px;
}


/* Responsive Styles */
@media (max-width: 768px) {
    .learn-more-button-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-left: 0;
        margin-top: 10px;
    }

    .learn-more-button-wrapper a {
        text-align: center;
        width: 100%;
        margin-top: -30px;
    }

    .learn-more-button-wrapper button {
        width: 90%;
        max-width: 300px;
    }
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

.aqi-bottom-container {
    display: flex;
    justify-content: center; /* centers children horizontally */
    gap: 45px; /* spacing between containers */
    width: 100%;
    max-width: 1200px; /* same as top container */
    margin: 0 auto; /* center the flex container itself */
    margin-top: -20px;
}

.aqi-statement-container,
.aqi-secondary-container {
    position: relative;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    padding:0px 15px;
    margin-left: -12px;
    margin-right: -12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 12px;
    font-weight: bold;
    transition: background 0.3s ease;
}
#aqiDetailsLink {
    margin-left: 5px;
}

.aqi-statement-content {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    width: 100%;
}

.aqi-icon {
    font-size: 35px;
    margin-top: 5px;
    flex-shrink: 0;
}

@media screen and (max-width: 600px) {
    .aqi-bottom-container {
        flex-direction: column;
        align-items: center;
        gap: 0px;
        margin-top: 0px;
        padding: 0 10px; /* Prevent edge overflow */
        width: 94%;
    }

    .aqi-statement-container,
    .aqi-secondary-container {
        width: 100%;
        margin-left: 8px; !important;
        margin-right: 0 !important;
        padding: 15px;
        box-sizing: border-box; /* Ensures padding stays within width */
        margin-bottom: 20px;
    }

    .aqi-statement-content {
        flex-direction: column;
    
    }

    .aqi-icon {
        margin-top: 0;
        margin-bottom: 0px;
        margin-left: 115px;
        font-size: 60px;
        align-items: center;
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
    position: relative;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 24px;
    height: 24px;
    background-color: gray; /* Default, will be updated dynamically */
    color: white;
    font-weight: bold;
    font-size: 14px;
    text-align: center;
    line-height: 24px;
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.2s ease;
    z-index: 10;
}

.info-icon:hover {
    transform: scale(1.1);
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

@media (max-width: 768px) {
    /* Adjust container width */
    .container {
        width: 90%;
        margin: 5px auto;
        padding: 10px;
    }

    /* Stack AQI and Trend containers vertically */
    .aqi-main-container {
        flex-direction: column;
        gap: 20px;
    }

    .aqi-container,
    .aqi-trend-container {
        flex-direction: column;
        width: 90%;
        min-height: auto;
        padding: 15px;
        margin-left: 0;
        margin-right: 0;
    }

    


    /* Center AQI circle and pie chart */
    .aqi-circle-wrapper {
        margin-right: 0;
        margin-bottom: 15px;
        margin-top: 20px;
    }

    .pie-chart-wrapper {
        margin-left: 50px; 
        margin-top: -80px;
    }

    .pie-chart-wrapper canvas {
        max-width: 200px;
        max-height: 200px;
    }

    /* Adjust Legend Position */
    .pie-chart-wrapper .chartjs-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    .pie-chart-wrapper .chartjs-legend ul {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 0;
    }

    .pie-chart-wrapper .chartjs-legend li {
        list-style: none;
        margin: 5px;
        font-size: 12px; /* Reduce text size slightly */
        white-space: nowrap; /* Prevent text from breaking awkwardly */
    }

    /* Adjust buttons for better fit */
    .forecast-button-wrapper{
        margin-top: 15px;
        margin-bottom: 50px;
        margin-left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .learn-more-button-wrapper {
        margin-top: -10px;
        margin-left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .forecast-button-wrapper button,
    .learn-more-button-wrapper button {
        width: 90%;
        max-width: 280px;
    }

    /* Adjust dashboard grid for mobile */
    .dashboard {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 10px;
        padding: 10px;
        margin-left: 10px;
        align-items: center;
        margin-top: -10px;
    }

    /* Reduce metric card size */
    .metric-card {
        padding: 15px;
    }

    /* Footer */
    footer {
        padding: 20px;
        font-size: 14px;
    }
}

/* Responsive adjustments */
@media (max-width: 1024px) { /* Tablets */
    h1 {
        font-size: 2rem;
        
    }

    h2 {
        font-size: 1.8rem;
    }

    h3 {
        font-size: 1.3rem;
    }

    p {
        font-size: 1.1rem;
    }

    .dashboard {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}

@media (max-width: 768px) { /* Mobile & small tablets */
    .container {
        width: 95%; /* Adjust width */
        padding: 15px;
    }

    
@media (max-width: 480px) { /* Small phones */
    h1 {
        font-size: 1.6rem;
    }

    h2 {
        font-size: 1.4rem;
    }

    h3 {
        font-size: 1.1rem;
    }

    p {
        font-size: 0.9rem;
    }

    .dashboard {
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 10px;
    }

    .metric-card {
        padding: 10px;
    }

    .btn {
        font-size: 0.9rem;
        padding: 8px 16px;
    }

    .icon-container {
        width: 60px; /* Smaller icons for small screens */
        height: 60px;
    }
}



    </style>
</head>
<body>
    <header>
        <h1>Air Quality Index Monitoring</h1>
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
    <div class="aqi-main-container">
        <!-- First Section: AQI Circle & Pie Chart -->
        <div class="aqi-container">
            <div class="aqi-label">AQI</div>

            <!-- AQI Circle -->
            <div class="aqi-circle-wrapper">
                <svg width="150" height="150" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" stroke="#ccc" stroke-width="10" fill="none"></circle>
                    <circle id="aqiCircle" cx="50" cy="50" r="45" stroke-width="10" fill="none"
                        transform="rotate(-90 50 50)"></circle>
                    <text x="50" y="45" font-size="18" text-anchor="middle" fill="white" font-weight="bold"
                        id="aqiText">--</text>
                    <text x="50" y="60" font-size="10" text-anchor="middle" fill="white" font-weight="bold"
                        id="aqiStatusText">--</text>
                </svg>
            </div>

            <!-- Forecast Button -->
            <div class="forecast-button-wrapper">
                <a href="forecast.php">
                    <button>View AQI Forecast</button>
                </a>
            </div>

            <!-- Main Pollutant Circle -->
            <div class="pie-chart-wrapper">
<div style="display: flex; justify-content: center; align-items: center; height: 300px;">

  <svg width="150" height="150" viewBox="0 0 100 100">
      <circle cx="50" cy="50" r="45" stroke="#ccc" stroke-width="10" fill="none"></circle>
      <circle id="mainPollutantCircle" cx="50" cy="50" r="45" stroke="#005B96" stroke-width="10" fill="none" transform="rotate(-90 50 50)"></circle>

      <!-- Main Pollutant Name -->
      <text id="mainPollutantText" x="50" y="43" font-size="16" text-anchor="middle" fill="white" font-weight="bold">---</text>

      <!-- Static Label -->
      <text id="mainPollutantLabel" x="50" y="60" font-size="9" text-anchor="middle" fill="white" font-weight="bold">Main Pollutant</text>
  </svg>


</div>

            </div>

            <!-- Learn More Button -->
            <div class="learn-more-button-wrapper">
                <a href="aqi.php">
                    <button>View More AQI Details</button>
                </a>
            </div>
        </div>

        <!-- Second Section: AQI Trend Chart -->
        <!-- PM2.5 Trend Chart Section -->
        <!-- Pollutant Trend Chart Section -->
        <div class="aqi-trend-container">
<div class="pollutant-trend-chart-container">
        <div class="pollutant-select-bar">
            <select id="pollutantSelect">
                <option value="pm25">Particulate Matter 2.5</option>
                <option value="pm10">Partuculate Matter 10</option>
                <option value="co">Carbon Monoxide</option>
                <option value="o3">Ground-Level Ozone</option>
                <option value="so2">Sulfur Dioxide</option>
                <option value="temp">Temperature</option>
                <option value="hum">Humidity</option>
                <option value="ch4">Heat Index</option>
                <option value="aqi">Overall AQI</option>
            </select>
        </div>
        <h3 class="aqi-trend-title">Pollutant Trends</h3>
        <div id="pollutantTrendContainer">
            <canvas id="pollutantTrendChart"></canvas>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("pollutantTrendChart").getContext("2d");

    const aqiLevels = [
        { level: "Good", max: 50, color: "#388e3c" },
        { level: "Moderate", max: 100, color: "#ff9800" },
        { level: "Unhealthy for Sensitive Groups", max: 150, color: "#ff5722" },
        { level: "Unhealthy", max: 200, color: "#d32f2f" },
        { level: "Very Unhealthy", max: 300, color: "#7b1fa2" },
        { level: "Hazardous", max: 500, color: "#9e1e32" }
    ];

    const pollutantData = {};
    const timeLabels = [];

    fetch('fetch_sensor_data.php')
        .then(response => response.json())
        .then(data => {
            const pollutants = ["pm25", "pm10", "co", "o3", "so2", "ch4", "temp", "hum", "aqi"];
            const labels = {
                pm25: "PM2.5 (µg/m³)",
                pm10: "PM10 (µg/m³)",
                co:   "CO (ppm)",
                o3:   "O₃ (ppb)",
                so2:  "SO₂ (ppb)",
                ch4:  "Heat Index (°C",
                temp: "Temperature (°C)",
                hum:  "Humidity (%)",
                aqi:  "Air Quality Index"
            };
            const maxValues = {
                pm25: 301,
                pm10: 301,
                co: 100,
                o3: 50,
                so2: 10,
                ch4: 50,
                temp: 50,
                hum: 100,
                aqi: 500
            };

            pollutants.forEach(p => pollutantData[p] = { label: labels[p], data: [], max: maxValues[p] });

            data.forEach(entry => {
                const hour = new Date(entry.hour);
                const label = hour.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                timeLabels.push(label);

                pollutantData.pm25.data.push(parseFloat(entry.avg_pm25));
                pollutantData.pm10.data.push(parseFloat(entry.avg_pm10));
                pollutantData.co.data.push(parseFloat(entry.avg_co));
                pollutantData.o3.data.push(parseFloat(entry.avg_o3));
                pollutantData.so2.data.push(parseFloat(entry.avg_so2));
                pollutantData.ch4.data.push(parseFloat(entry.avg_ch4));
                pollutantData.temp.data.push(parseFloat(entry.avg_temp));
                pollutantData.hum.data.push(parseFloat(entry.avg_hum));
                pollutantData.aqi.data.push(parseFloat(entry.avg_aqi));
            });

            // Fetch latest AQI data
            fetch('latest_data_api.php')
                .then(response => response.json())
                .then(latest => {
                    const aqiKeys = {
                        aqi_pm25: "pm25",
                        aqi_pm10: "pm10",
                        aqi_co: "co",
                        aqi_o3: "o3",
                        aqi_so2: "so2"
                    };

                    let maxAQI = -1;
                    let defaultPollutant = "pm25";

                    for (const [aqiKey, pollutantKey] of Object.entries(aqiKeys)) {
                        const value = parseFloat(latest[aqiKey]);
                        if (!isNaN(value) && value > maxAQI) {
                            maxAQI = value;
                            defaultPollutant = pollutantKey;
                        }
                    }

                    document.getElementById("pollutantSelect").value = defaultPollutant;

                    let chart = createChart(defaultPollutant);

                    document.getElementById("pollutantSelect").addEventListener("change", function () {
                        const selected = this.value;
                        chart.destroy();
                        chart = createChart(selected);
                    });
                });
        })
        .catch(error => {
            console.error("Error loading sensor data:", error);
        });

    function getAQIColor(value) {
        for (const level of aqiLevels) {
            if (value <= level.max) {
                return level.color;
            }
        }
        return "#9e1e32"; // default to hazardous
    }

    function calculateAverage(dataArray) {
        const sum = dataArray.reduce((acc, val) => acc + val, 0);
        return dataArray.length ? sum / dataArray.length : 0;
    }

    function updateChartColor(pollutantKey) {
        const avg = calculateAverage(pollutantData[pollutantKey].data);
        return getAQIColor(avg);
    }

    function createChart(pollutantKey) {
        const avgColor = updateChartColor(pollutantKey);

        return new Chart(ctx, {
            type: "line",
            data: {
                labels: timeLabels,
                datasets: [{
                    label: pollutantData[pollutantKey].label,
                    data: pollutantData[pollutantKey].data,
                    borderColor: avgColor,
                    backgroundColor: avgColor + "33",
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: avgColor,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Time",
                            color: "#cccccc",
                            font: { family: "Poppins", size: 14 }
                        },
                        ticks: {
                            color: "#bbbbbb",
                            font: { family: "Poppins", size: 12 }
                        },
                        grid: { color: "#444444" }
                    },
                    y: {
                        title: {
                            display: true,
                            text: pollutantData[pollutantKey].label,
                            color: "#cccccc",
                            font: { family: "Poppins", size: 14 }
                        },
                        ticks: {
                            color: "#bbbbbb",
                            font: { family: "Poppins", size: 12 }
                        },
                        grid: { color: "#444444" },
                        min: 0,
                        max: pollutantData[pollutantKey].max
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        titleColor: "#ffffff",
                        bodyColor: "#eeeeee",
                        backgroundColor: "#333333",
                        titleFont: { family: "Poppins", size: 14 },
                        bodyFont: { family: "Poppins", size: 12 }
                    }
                }
            }
        });
    }
});
</script>



</div>

    </div>
</div>

<div class="aqi-bottom-container">
    <!-- First Bottom Container: Cautionary Statement -->
    <div class="aqi-statement-container">
  <div class="aqi-statement-content">
    <span id="aqiIcon" class="aqi-icon">🌫️</span>
    <p id="aqiCautionaryStatement">
      Loading... <a id="aqiDetailsLink" href="#" style="color: #000000; display: none;">View More</a>
    </p>
  </div>
</div>


    <!-- Second Bottom Container: Reserved for future use -->
    <div class="aqi-secondary-container">
        <p>Reserved for additional AQI-related content.</p>
    </div>
</div>


<script>
async function updateCautionaryStatement() {
    try {
        const response = await fetch('latest_data_api.php');
        const data = await response.json();
        const aqi = parseInt(data.aqi_total);

        

        const levels = [
            { level: "Good", max: 50, color: "#388e3c", statement: "Air quality is considered satisfactory, and air pollution poses little or no risk." },
            { level: "Moderate", max: 100, color: "#ff9800", statement: "Air quality is acceptable, but some pollutants may be a concern for sensitive individuals." },
            { level: "Unhealthy for Sensitive Groups", max: 150, color: "#ff5722", statement: "Members of sensitive groups may experience health effects, but the general public is unlikely to be affected." },
            { level: "Unhealthy", max: 200, color: "#d32f2f", statement: "Everyone may begin to experience health effects; members of sensitive groups may experience more serious effects." },
            { level: "Very Unhealthy", max: 300, color: "#7b1fa2", statement: "Health alert: Everyone may experience more serious health effects." },
            { level: "Hazardous", max: 500, color: "#9e1e32", statement: "Air quality level is dangerous. The entire population is more likely to be affected." }
        ];

        const icons = {
    "Good": "🟢",
    "Moderate": "😊",
    "Unhealthy for Sensitive Groups": "😐",
    "Unhealthy": "😷",
    "Very Unhealthy": "🤢",
    "Hazardous": "☠️"
};

const levelInfo = levels.find(l => aqi <= l.max);
const levelName = levelInfo.level.toLowerCase().replace(/\s+/g, '_');
const link = document.getElementById('aqiDetailsLink');
const icon = document.getElementById('aqiIcon');

const statementText = `Air Quality Level is ${levelInfo.level}. ${levelInfo.statement}`;

const container = document.querySelector('.aqi-statement-container');
const paragraph = document.getElementById('aqiCautionaryStatement');

container.style.backgroundColor = levelInfo.color;
paragraph.childNodes[0].nodeValue = statementText + " ";
link.href = `${levelName}_aqi_details.php`;
link.style.display = 'inline';

icon.textContent = icons[levelInfo.level];


        container.style.backgroundColor = levelInfo.color;
            //container.style.border = `3px solid ${levelInfo.color}`;
        paragraph.childNodes[0].nodeValue = statementText + " "; // replace only the text before the link
        link.href = `${levelName}_aqi_details.php`;
        link.style.display = 'inline';

    } catch (error) {
        console.error('Error fetching AQI data:', error);
        document.getElementById('aqiCautionaryStatement').textContent = "Unable to load AQI statement.";
        document.getElementById('aqiDetailsLink').style.display = 'none';
    }
}


// Call the function on page load
updateCautionaryStatement();

setInterval(updateCautionaryStatement, 5000); //   

</script>

<div class="dashboard">
    <!-- First Row of Pollutants -->
    <div class="metric-card">
    <div class="info-icon" id="pm25_info" onclick="showInfo('pm25')">i</div>
    <h3>Particulate Matter 2.5</h3>
    <div class="metric-values">
        <p><span id="pm25_val">-- µg/m³</span></p>
        <div class="level-card" id="pm25_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="pm10_info" onclick="showInfo('pm10')">i</div>
    <h3>Particulate Matter 10</h3>
    <div class="metric-values">
        <p><span id="pm10_val">-- µg/m³</span></p>
        <div class="level-card" id="pm10_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="co_info" onclick="showInfo('co')">i</div>
    <h3>Carbon Monoxide</h3>
    <div class="metric-values">
        <p><span id="co_val">-- ppm</span></p>
        <div class="level-card" id="co_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="o3_info" onclick="showInfo('o3')">i</div>
    <h3>Ground-Level Ozone</h3>
    <div class="metric-values">
        <p><span id="o3_val">-- ppb</span></p>
        <div class="level-card" id="o3_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="so2_info" onclick="showInfo('so2')">i</div>
    <h3>Sulfur Dioxide</h3>
    <div class="metric-values">
        <p><span id="so2_val">-- ppb</span></p>
        <div class="level-card" id="so2_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="temp_info" onclick="showInfo('temp')">i</div>
    <h3>Temperature</h3>
    <div class="metric-values">
        <p><span id="temp_val">-- °C</span></p>
        <div class="level-card" id="temp_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="hum_info" onclick="showInfo('hum')">i</div>
    <h3>Humidity</h3>
    <div class="metric-values">
        <p><span id="hum_val">-- %</span></p>
        <div class="level-card" id="hum_level">--</div>
    </div>
</div>

<div class="metric-card">
    <div class="info-icon" id="ch4_info" onclick="showInfo('ch4')">i</div>
    <h3>Heat Index</h3>
    <div class="metric-values">
        <p><span id="ch4_val">-- °C</span></p>
        <div class="level-card" id="ch4_level">--</div>
    </div>
</div>

</div>

<div id="overlay" style="
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9998;
    display: none;
"></div>


<script>

const aqiGuidelines = {
    pm25: {
        good: "It’s a great day to be active outside.",
        moderate: "Unusually sensitive people: Consider making outdoor activities shorter and less intense. Watch for symptoms such as coughing or shortness of breath.",
        usg: "Sensitive groups: Make outdoor activities shorter and less intense. It’s OK to be active outdoors but take more breaks.",
        unhealthy: "Sensitive groups: Do not do long or intense outdoor activities. Everyone else: Reduce long or intense outdoor activity.",
        veryUnhealthy: "Sensitive groups: Avoid all physical activity outdoors. Everyone else: Avoid long or intense outdoor exertion.",
        hazardous: "Everyone: Avoid all physical activity outdoors."
    },
    pm10: {
        good: "It’s a great day to be active outside.",
        moderate: "Unusually sensitive people: Consider making outdoor activities shorter and less intense. Watch for symptoms such as coughing or shortness of breath.",
        usg: "Sensitive groups: Make outdoor activities shorter and less intense.",
        unhealthy: "Sensitive groups: Consider rescheduling or moving all activities inside. Everyone else: Keep outdoor activities shorter.",
        veryUnhealthy: "Sensitive groups: Avoid all physical activity outdoors. Everyone else: Limit outdoor physical activity.",
        hazardous: "Everyone: Avoid all physical activity outdoors."
    },
    co: {
        good: "It’s a great day to be active outside.",
        moderate: "It’s a great day to be active outside.",
        usg: "Sensitive group: Limit heavy exertion outdoors and avoid sources of CO, such as heavy traffic.",
        unhealthy: "Sensitive group: Limit moderate outdoor exertion and avoid sources of CO, such as heavy traffic.",
        veryUnhealthy: "Sensitive group: Avoid outdoor exertion and sources of CO.",
        hazardous: "Sensitive group: Avoid outdoor exertion and sources of CO. Everyone else: Limit heavy outdoor exertion."
    },
    o3: {
        good: "It’s a great day to be active outside.",
        moderate: "Unusually sensitive people: Consider making outdoor activities shorter and less intense.",
        usg: "Sensitive groups: Make outdoor activities shorter and less intense. Plan outdoor activities in the morning.",
        unhealthy: "Sensitive groups: Avoid long or intense outdoor activities. Everyone else: Reduce long or intense outdoor activity.",
        veryUnhealthy: "Sensitive groups: Avoid all physical activity outdoors. Everyone else: Avoid long or intense outdoor exertion.",
        hazardous: "Everyone: Avoid all physical activity outdoors."
    },
    so2: {
        good: "It’s a great day to be active outside.",
        moderate: "It’s a great day to be active outside.",
        usg: "Sensitive groups: Consider limiting outdoor exertion.",
        unhealthy: "Sensitive groups: Limit outdoor exertion.",
        veryUnhealthy: "Sensitive groups: Avoid outdoor exertion. Everyone else: Reduce outdoor exertion.",
        hazardous: "Sensitive groups: Remain indoors. Everyone else: Avoid outdoor exertion."
    },
    temp: {
        cool: "Comfortable for outdoor activity. Light jacket may be needed.",
        good: "Perfect temperature for most people to enjoy outdoor activities.",
        warm: "Mild heat. Stay hydrated and avoid overexertion.",
        hot: "Limit strenuous activity and take cooling breaks.",
        veryHot: "Avoid outdoor exertion. Stay indoors during peak heat hours.",
        extremeHeat: "Extreme caution: Risk of heatstroke. Stay indoors and keep cool."
    },

    // 💧 Humidity Guidelines
    hum: {
        tooDry: "Air is very dry. Use a humidifier and drink plenty of water.",
        optimal: "Ideal indoor humidity for comfort and health.",
        tooHumid: "Can feel muggy or uncomfortable. Watch for mold and allergies."
    },

    // 🌡️ Heat Index / CH₄ as Heat Indicator
    ch4: {
        good: "Feels comfortable. No heat-related risk.",
        caution: "Mild discomfort possible. Take regular water breaks.",
        extremeCaution: "Increased risk of heat-related illness. Limit prolonged exposure.",
        danger: "Avoid heavy activity. Seek shade or air-conditioned places.",
        extremeDanger: "Severe risk of heatstroke. Avoid going outdoors."
    }
};

async function updateDashboardFromAPI() {
    try {
        const res = await fetch('latest_data_api.php');
        const data = await res.json();

        const pollutants = {
            pm25: { val: parseFloat(data.pm25), getLevel: getPM25Level },
            pm10: { val: parseFloat(data.pm10), getLevel: getPM10Level },
            co: { val: parseFloat(data.co), getLevel: getCOLevel },
            o3: { val: parseFloat(data.o3), getLevel: getO3Level },
            so2: { val: parseFloat(data.h2), getLevel: getSO2Level }, // note lowercase 'h2'
            ch4: { val: parseFloat(data.ch4), getLevel: getCH4Level },
            temp: { val: parseFloat(data.temp), getLevel: getTempLevel },
            hum: { val: parseFloat(data.hum), getLevel: getHumLevel },
        };

        for (const key in pollutants) {
            const { val, getLevel } = pollutants[key];
            const level = getLevel(val);

            // Update level card text and color
            const levelEl = document.getElementById(`${key}_level`);
            const infoEl = document.getElementById(`${key}_info`);

            if (levelEl) {
                levelEl.textContent = level.level;
                levelEl.style.backgroundColor = level.color;
            }

            // Update info icon to match level color
            // Show/hide info icon based on level category
            const visibleLevels = ['usg', 'unhealthy', 'veryUnhealthy', 'hazardous',
                'warm', 'hot', 'veryHot', 'extremeHeat',
                'tooDry', 'tooHumid',
                'caution', 'extremeCaution', 'danger', 'extremeDanger'];

            if (infoEl) {
                infoEl.style.backgroundColor = level.color;

                if (visibleLevels.includes(level.key)) {
                    infoEl.style.display = 'block';
                } else {
                    infoEl.style.display = 'none';
                }
            }

            // Update value text
            const valEl = document.getElementById(`${key}_val`);
            if (valEl) {
                let unit = '';
                if (key === 'temp') unit = '°C';
                else if (key === 'hum') unit = '%';
                else if (['pm25', 'pm10'].includes(key)) unit = ' µg/m³';
                else if (['co'].includes(key)) unit = ' ppm';
                else if (['ch4'].includes(key)) unit = ' °C';
                else if (key === 'so2') unit = ' ppb';
                else if (key === 'o3') unit = ' ppb';

                valEl.textContent = `${val.toFixed(1)}${unit}`;
            }
        }
    } catch (err) {
        console.error('Failed to load air quality data:', err);
    }
}


// Sign icons for each AQI level
const levelSigns = {
    // AQI Levels
    good: "✅",
    moderate: "🟡",
    usg: "⚠️",             // Unhealthy for Sensitive Groups
    unhealthy: "🟥",
    veryUnhealthy: "🛑",
    hazardous: "☠️",

    // Temperature Levels
    cool: "❄️",
    warm: "🌤️",
    hot: "🔥",
    veryHot: "🌡️",
    extremeHeat: "☀️☠️",

    // Humidity Levels
    tooDry: "💧🚫",
    optimal: "💧✅",
    tooHumid: "💦⚠️",

    // CH₄ Levels
    caution: "🟠",
    extremeCaution: "🔶",
    danger: "🚨",
    extremeDanger: "☣️"
};


// Flag to prevent multiple cards
let infoCardOpen = false;

function showInfo(metric) {
    if (infoCardOpen) return; // Prevent opening multiple cards

    const levelEl = document.getElementById(`${metric}_level`);
    const infoEl = document.getElementById(`${metric}_info`);
    const levelText = levelEl?.textContent.toLowerCase();

    let category = levelText.replace(/\s+/g, '').toLowerCase(); // default fallback

// Normalize custom mappings
const levelMap = {
    'cool': 'cool',
    'good': 'good',
    'warm': 'warm',
    'hot': 'hot',
    'veryhot': 'veryHot',
    'extremeheat': 'extremeHeat',
    'toodry': 'tooDry',
    'optimal': 'optimal',
    'toohumid': 'tooHumid',
    'caution': 'caution',
    'extremecaution': 'extremeCaution',
    'danger': 'danger',
    'extremedanger': 'extremeDanger',
    'moderate': 'moderate',
    'sensitive': 'usg',
    'unhealthy': 'unhealthy',
    'veryunhealthy': 'veryUnhealthy',
    'hazardous': 'hazardous'
};

category = levelMap[category] || 'good';


    const guideline = aqiGuidelines[metric]?.[category] || "No guideline available.";
    const iconColor = window.getComputedStyle(infoEl).backgroundColor;
    const sign = levelSigns[category] || "";

    // Create overlay for dimming background
    const overlay = document.createElement("div");
    overlay.id = "infoOverlay";
    Object.assign(overlay.style, {
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100vw',
        height: '100vh',
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        zIndex: 9998
    });

    // Create the info card
    const card = document.createElement("div");
    card.className = "info-card";
    card.innerHTML = `
        <strong>${sign} ${metric.toUpperCase()} - ${levelEl.textContent}</strong>
        <p>${guideline}</p>
        <button id="closeInfoCard">Close</button>
    `;

    // Style the card
    Object.assign(card.style, {
        position: 'fixed',
        top: '35%',
        left: '50%',
        transform: 'translateX(-50%)',
        background: '#232323',
        backdropFilter: 'blur(10px)',
        padding: '20px',
        borderRadius: '10px',
        zIndex: 9999,
        boxShadow: '0px 4px 10px rgba(0, 0, 0, 0.2)',
        maxWidth: '450px',
        width: '90%',
        fontFamily: 'Poppins, sans-serif',
        color: '#ffffff',
        textAlign: 'center',
        border: '1px solid rgba(255, 255, 255, 0.2)'
    });

    // Add to DOM
    document.body.appendChild(overlay);
    document.body.appendChild(card);

    // Prevent multiple cards
    infoCardOpen = true;

    // Close handler
    document.getElementById("closeInfoCard").onclick = function () {
        card.remove();
        overlay.remove();
        infoCardOpen = false;
    };
}

// Initial load and auto-refresh every 5 seconds
window.onload = function () {
    updateDashboardFromAPI();
    setInterval(updateDashboardFromAPI, 5000);
};
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Request notification permission
    if ("Notification" in window && Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    // AQI Description based on ranges
    function getAQIDescription(aqi) {
        if (aqi <= 50) return { level: "Good", message: "Air quality is satisfactory." };
        if (aqi <= 100) return { level: "Moderate", message: "Acceptable, but some pollutants may affect sensitive individuals." };
        if (aqi <= 150) return { level: "Unhealthy for Sensitive Groups", message: "Sensitive individuals may experience effects." };
        if (aqi <= 200) return { level: "Unhealthy", message: "Everyone may begin to experience health effects." };
        if (aqi <= 300) return { level: "Very Unhealthy", message: "Health alert: more serious health effects possible." };
        return { level: "Hazardous", message: "Health warning: everyone may be affected." };
    }

    // Fetch AQI and trigger notification
    function fetchAQIAndNotify() {
        fetch("https://air-quality-php-backend.onrender.com/latest_data_api.php")
            .then(response => response.json())
            .then(data => {
                const aqi = parseInt(data.aqi_total);
                const { level, message } = getAQIDescription(aqi);

                if (Notification.permission === "granted") {
                    new Notification(`AQI Update: ${level} (${aqi})`, {
                        body: message,
                        icon: "https://cdn-icons-png.flaticon.com/512/219/219816.png" // Optional icon
                    });
                }
            })
            .catch(console.error);
    }

    // Check AQI every 5 minutes (adjust as needed)
    fetchAQIAndNotify();
    setInterval(fetchAQIAndNotify, 5 * 60 * 1000);
});
</script>


<script>
function updateAQICircle(aqi) {
    let circle = document.getElementById("aqiCircle");
    let text = document.getElementById("aqiText");
    let statusText = document.getElementById("aqiStatusText");

    // AQI levels and colors
    const aqiLevels = [
        { level: "Good", max: 50, color: "#388e3c" }, // Green
        { level: "Moderate", max: 100, color: "#ff9800" }, // Yellow
        { level: "Unhealthy for Sensitive Groups", max: 150, color: "#ff5722" }, // Orange
        { level: "Unhealthy", max: 200, color: "#d32f2f" }, // Red
        { level: "Very Unhealthy", max: 300, color: "#7b1fa2" }, // Purple
        { level: "Hazardous", max: 500, color: "#9e1e32" } // Maroon
    ];

    // Ensure aqi is number
    aqi = Number(aqi);

    // Determine the AQI status and color
    const selectedLevel = aqiLevels.find(level => aqi <= level.max) || aqiLevels[aqiLevels.length - 1];

    // Set full circle color
    circle.style.stroke = selectedLevel.color;
    circle.style.strokeDasharray = "282.6"; // Full circle circumference
    circle.style.strokeDashoffset = "0"; // No offset

    // Update AQI Value
    text.textContent = aqi;

    // Update AQI Status inside the circle
    statusText.textContent = selectedLevel.level;
}

// Function to fetch the AQI data
function fetchAndUpdateAQI() {
    fetch('latest_data_api.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching AQI data:', data.error);
            } else if (data.aqi_total !== undefined && !isNaN(data.aqi_total)) {
                updateAQICircle(data.aqi_total);
            } else {
                console.warn('AQI total not found or invalid in API response');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// Initial fetch and update
fetchAndUpdateAQI();

// Refresh every 5 seconds
setInterval(fetchAndUpdateAQI, 5000);
</script>


<script> 
function getAQIColor(aqi) {
    if (aqi <= 50) return "#388e3c"; // Good - Green
    if (aqi <= 100) return "#ff9800"; // Satisfactory - Yellow
    if (aqi <= 150) return "#ff5722"; // Moderate - Orange
    if (aqi <= 200) return "#d32f2f"; // Poor - Red
    if (aqi <= 300) return "#7b1fa2"; // Very Poor - Purple
    return "#9e1e32"; // Severe - Maroon
}

function updateMainPollutantDisplay(pollutants) {
    let maxAQI = -1;
    let mainPollutant = "---";

    for (let key in pollutants) {
        const aqi = Number(pollutants[key]);
        if (!isNaN(aqi) && aqi > maxAQI) {
            maxAQI = aqi;
            mainPollutant = key;
        }
    }

    // Update the pollutant name inside the circle
    document.getElementById("mainPollutantText").textContent = mainPollutant.toUpperCase();

    // Update the circle stroke color based on AQI level
    const color = getAQIColor(maxAQI);
    document.getElementById("mainPollutantCircle").setAttribute("stroke", color);
}

function fetchAndUpdateMainPollutant() {
    fetch("latest_data_api.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error:", data.error);
                return;
            }

            // Use lowercase keys from API response
            const pollutants = {
                "PM2.5": data.aqi_pm25,
                "PM10": data.aqi_pm10,
                "CO": data.aqi_co,
                "O3": data.aqi_o3,
                "SO2": data.aqi_so2,
                // "CH4": data.aqi_ch4 // Not available in your API response
            };

            updateMainPollutantDisplay(pollutants);
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
}

// Initial fetch and refresh every 5 seconds
fetchAndUpdateMainPollutant();
setInterval(fetchAndUpdateMainPollutant, 5000);
</script>






<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("aqiTrendChart").getContext("2d");

    let aqiData = [];
    let timeLabels = [];

    // Initialize chart (empty)
    var aqiTrendChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: timeLabels,
            datasets: [{
                label: "AQI Trend",
                data: aqiData,
                borderColor: "#ff5733",
                backgroundColor: "rgba(255, 87, 51, 0.2)",
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: "#ff5733",
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "Time",
                        color: "#cccccc",
                        font: { family: "Poppins", size: 14 }
                    },
                    ticks: {
                        color: "#bbbbbb",
                        font: { family: "Poppins", size: 12 }
                    },
                    grid: {
                        color: "#444444"
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: "AQI Value",
                        color: "#cccccc",
                        font: { family: "Poppins", size: 14 }
                    },
                    ticks: {
                        color: "#bbbbbb",
                        font: { family: "Poppins", size: 12 }
                    },
                    grid: {
                        color: "#444444"
                    },
                    min: 0,
                    max: 300
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    titleColor: "#ffffff",
                    bodyColor: "#eeeeee",
                    backgroundColor: "#333333",
                    titleFont: { family: "Poppins", size: 14 },
                    bodyFont: { family: "Poppins", size: 12 }
                }
            }
        }
    });

    // Fetch and update chart
    fetch('fetch_sensor_data.php')
        .then(response => response.json())
        .then(data => {
            const sortedData = data.sort((a, b) => new Date(a.hour) - new Date(b.hour));
            
            sortedData.forEach(entry => {
                let date = new Date(entry.hour);
                let formattedHour = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                aqiData.push(entry.avg_aqi);
                timeLabels.push(formattedHour);
            });

            aqiTrendChart.update();
        })
        .catch(error => {
            console.error("Failed to load AQI data:", error);
        });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const levels = [
        { level: "Good", max: 50, color: "#388e3c" },
        { level: "Moderate", max: 100, color: "#ff9800" },
        { level: "Unhealthy for Sensitive Groups", max: 150, color: "#ff5722" },
        { level: "Unhealthy", max: 200, color: "#d32f2f" },
        { level: "Very Unhealthy", max: 300, color: "#7b1fa2" },
        { level: "Hazardous", max: 500, color: "#9e1e32" }
    ];

    function updateButtonStyles(aqi) {
        const level = levels.find(l => aqi <= l.max) || levels[levels.length - 1];
        const baseColor = level.color;
        const hoverColor = lightenDarkenColor(baseColor, 40); // Lighter color for hover

        const styleId = 'dynamic-aqi-button-style';
        let styleTag = document.getElementById(styleId);
        if (!styleTag) {
            styleTag = document.createElement('style');
            styleTag.id = styleId;
            document.head.appendChild(styleTag);
        }

        styleTag.textContent = `
            .forecast-button-wrapper button,
            .learn-more-button-wrapper button {
                background-color: ${baseColor} !important;
                box-shadow: 0px 4px 10px ${baseColor}80 !important;
                transition: all 0.3s ease-in-out !important;
            }

            .forecast-button-wrapper button:hover,
            .learn-more-button-wrapper button:hover {
                background-color: ${hoverColor} !important;
                box-shadow: 0px 6px 15px ${hoverColor}cc !important;
                transform: scale(1.05) !important;
            }

            .forecast-button-wrapper button:active,
            .learn-more-button-wrapper button:active {
                transform: scale(0.98) !important;
                box-shadow: 0px 3px 8px ${baseColor}cc !important;
            }
        `;
    }

    function fetchAQIandUpdate() {
        fetch('latest_data_api.php')
            .then(res => res.json())
            .then(data => {
                const aqi = parseInt(data.aqi_total);
                if (!isNaN(aqi)) {
                    updateButtonStyles(aqi);
                } else {
                    console.warn('aqi_total not found or invalid in API response');
                }
            })
            .catch(err => console.error('Failed to fetch AQI:', err));
    }

    function lightenDarkenColor(col, amt) {
        let usePound = false;
        if (col[0] === "#") {
            col = col.slice(1);
            usePound = true;
        }

        const num = parseInt(col, 16);
        let r = (num >> 16) + amt;
        let g = ((num >> 8) & 0x00FF) + amt;
        let b = (num & 0x0000FF) + amt;

        r = Math.max(Math.min(255, r), 0);
        g = Math.max(Math.min(255, g), 0);
        b = Math.max(Math.min(255, b), 0);

        return (usePound ? "#" : "") + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    }

    fetchAQIandUpdate();                   // Initial update
    setInterval(fetchAQIandUpdate, 5000);  // Repeat every 5 seconds
});
</script>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".aqi-secondary-container");

    // Health risk messages ~ 25 words each
    const healthMessages = {
        pm25: "PM2.5 exposure can cause respiratory issues, aggravate asthma, and increase risk of heart disease and lung cancer.",
        pm10: "PM10 particles penetrate lungs causing coughing, wheezing, and increased risk of respiratory infections and chronic bronchitis.",
        co: "Carbon monoxide reduces oxygen delivery in the body, causing headaches, dizziness, and potentially fatal poisoning in high levels.",
        o3: "Ozone exposure irritates airways, reduces lung function, and worsens asthma and other chronic respiratory diseases.",
        so2: "Sulfur dioxide inflames respiratory tract, triggers asthma attacks, and can cause long-term lung damage with prolonged exposure.",
        temp: "Extreme temperatures increase risk of heat exhaustion, heat stroke, dehydration, and can worsen cardiovascular and respiratory diseases.",
        humidity: "High humidity can worsen breathing difficulties, promote mold growth, and increase discomfort for people with asthma.",
        heatIndex: "Heat index measures combined effects of heat and humidity, indicating risk for heat-related illnesses including heat stroke."
    };

    // AQI background colors based on your guideline
    function getAQIColor(aqi) {
        if (aqi <= 50) return "#388e3c";       // Good - Green
        if (aqi <= 100) return "#ff9800";      // Satisfactory - Yellow
        if (aqi <= 150) return "#ff5722";      // Moderate - Orange
        if (aqi <= 200) return "#d32f2f";      // Poor - Red
        if (aqi <= 300) return "#7b1fa2";      // Very Poor - Purple
        return "#9e1e32";                      // Severe - Maroon
    }

    // Pollutants order for slideshow
    const pollutants = ["pm25", "pm10", "co", "o3", "so2", "temp", "humidity", "heatIndex"];

    let currentIndex = 0;

    // Function to update the slide text and background color
    function updateSlide() {
        fetch('latest_data_api.php')
            .then(res => res.json())
            .then(data => {
                // Use overall AQI from aqi_total or compute max of individual pollutants
                const overallAQI = data.aqi_total || Math.max(
                    data.aqi_pm25 || 0,
                    data.aqi_pm10 || 0,
                    data.aqi_co || 0,
                    data.aqi_o3 || 0,
                    data.aqi_so2 || 0
                );

                // Update background color
                container.style.backgroundColor = getAQIColor(overallAQI);

                // Get current pollutant key
                const pollutantKey = pollutants[currentIndex];

                // Show health message or fallback
                container.textContent = healthMessages[pollutantKey] || "No data available.";

                // Advance index looping
                currentIndex = (currentIndex + 1) % pollutants.length;
            })
            .catch(() => {
                container.style.backgroundColor = "#388e3c"; // Good - Green fallback
                const pollutantKey = pollutants[currentIndex];
                container.textContent = healthMessages[pollutantKey] || "No data available.";
                currentIndex = (currentIndex + 1) % pollutants.length;
            });
    }

    // Initial call
    updateSlide();

    // Switch slide every 10 seconds (matching your comment)
    setInterval(updateSlide, 10000);
});
</script>


<script>
function updateSensorData() {
    fetch('latest_data_api.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error:", data.error);
                return;
            }

            const so2 = data.h2; // "h2" is used as SO2

            document.getElementById('pm25_val').textContent = data.pm25 + ' µg/m³';
            document.getElementById('pm10_val').textContent = data.pm10 + ' µg/m³';
            document.getElementById('co_val').textContent = data.co + ' ppm';
            document.getElementById('o3_val').textContent = data.o3 + ' ppb';
            document.getElementById('so2_val').textContent = so2 + ' ppb';
            document.getElementById('ch4_val').textContent = data.ch4 + ' °C';
            document.getElementById('temp_val').textContent = data.temp + '°C';
            document.getElementById('hum_val').textContent = data.hum + '%';

            applyLevel('pm25_level', getPM25Level(data.pm25));
            applyLevel('pm10_level', getPM10Level(data.pm10));
            applyLevel('co_level', getCOLevel(data.co));
            applyLevel('o3_level', getO3Level(data.o3));
            applyLevel('so2_level', getSO2Level(so2));
            applyLevel('ch4_level', getCH4Level(data.ch4));

            applyLevel('temp_level', getTempLevel(data.temp));
            applyLevel('hum_level', getHumLevel(data.hum));
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

function getPM25Level(v) {
    if (v <= 9) return { level: 'Good', color: '#388e3c', key: "good" };
    if (v <= 35.4) return { level: 'Moderate', color: '#ff9800', key: "moderate" };
    if (v <= 55.4) return { level: 'Unhealthy for Sensitive Groups', color: '#ff5722', key: "usg" };
    if (v <= 120.4) return { level: 'Unhealthy', color: '#d32f2f', key: "unhealthy" };
    if (v <= 225.4) return { level: 'Very Unhealthy', color: '#7b1fa2', key: "veryUnhealthy" };
    return { level: 'Hazardous', color: '#9e1e32', key: "hazardous" };
}

function getPM10Level(v) {
    if (v <= 54) return { level: 'Good', color: '#388e3c', key: "good" };
    if (v <= 154) return { level: 'Moderate', color: '#ff9800', key: "moderate" };
    if (v <= 254) return { level: 'Unhealthy for Sensitive Groups', color: '#ff5722', key: "usg" };
    if (v <= 354) return { level: 'Unhealthy', color: '#d32f2f', key: "unhealthy" };
    if (v <= 424) return { level: 'Very Unhealthy', color: '#7b1fa2', key: "veryUnhealthy" };
    return { level: 'Hazardous', color: '#9e1e32', key: "hazardous" };
}

function getCOLevel(v) {
    if (v <= 35) return { level: 'Good', color: '#388e3c', key: "good" };
    if (v <= 80) return { level: 'Moderate', color: '#ff9800', key: "moderate" };
    if (v <= 100) return { level: 'Unhealthy for Sensitive Groups', color: '#ff5722', key: "usg" };
    if (v <= 200) return { level: 'Unhealthy', color: '#d32f2f', key: "unhealthy" };
    if (v <= 400) return { level: 'Very Unhealthy', color: '#7b1fa2', key: "veryUnhealthy" };
    return { level: 'Hazardous', color: '#9e1e32', key: "hazardous" };
}

function getO3Level(v) {
    if (v <= 54) return { level: 'Good', color: '#388e3c', key: "good" };
    if (v <= 124) return { level: 'Moderate', color: '#ff9800', key: "moderate" };
    if (v <= 164) return { level: 'Unhealthy for Sensitive Groups', color: '#ff5722', key: "usg" };
    if (v <= 204) return { level: 'Unhealthy', color: '#d32f2f', key: "unhealthy" };
    if (v <= 404) return { level: 'Very Unhealthy', color: '#7b1fa2', key: "veryUnhealthy" };
    return { level: 'Hazardous', color: '#9e1e32', key: "hazardous" };
}

function getSO2Level(v) {
    if (v <= 35) return { level: 'Good', color: '#388e3c', key: "good" };
    if (v <= 75) return { level: 'Moderate', color: '#ff9800', key: "moderate" };
    if (v <= 185) return { level: 'Unhealthy for Sensitive Groups', color: '#ff5722', key: "usg" };
    if (v <= 304) return { level: 'Unhealthy', color: '#d32f2f', key: "unhealthy" };
    if (v <= 604) return { level: 'Very Unhealthy', color: '#7b1fa2', key: "veryUnhealthy" };
    return { level: 'Hazardous', color: '#9e1e32', key: "hazardous" };
}

function getTempLevel(v) {
    if (v <= 25) return { level: 'Cool', color: '#388e3c', key: 'cool'}; // slight semantic tweak
    if (v <= 31) return { level: 'Good', color: '#388e3c', key: 'good' };
    if (v <= 32) return { level: 'Warm', color: '#ff9800', key: 'warm' };
    if (v <= 35) return { level: 'Hot', color: '#ff5722', key: 'hot' };
    if (v <= 40) return { level: 'Very Hot', color: '#d32f2f', key: 'veryHot' };
    return { level: 'Extreme Heat', color: '#9e1e32', key: 'extremeHeat' };
}

function getHumLevel(v) {
    if (v <= 39) return { level: 'Too Dry', color: '#ff5722', key: 'tooDry' };
    if (v <= 60) return { level: 'Optimal', color: '#388e3c', key: 'optimal' };
    return { level: 'Too Humid', color: '#ff9800', key: 'tooHumid' };
}

function getCH4Level(v) {
    if (v >= 52) return { level: 'Danger', color: '#d32f2f', key: 'danger' };
    if (v >= 42) return { level: 'Extreme Caution', color: '#ff5722', key: 'extremeCaution' };
    if (v >= 33) return { level: 'Caution', color: '#ff9800', key: 'caution' };
    if (v > 0)    return { level: 'Good', color: '#388e3c', key: 'good' };
    return { level: 'Extreme Danger', color: '#9e1e32', key: 'extremeDanger' };
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

