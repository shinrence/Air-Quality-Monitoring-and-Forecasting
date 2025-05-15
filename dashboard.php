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
    padding: 10px;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
}

.aqi-trend-title {
    font-family: Poppins, sans-serif;
    font-size: 20px;
    color: #cccccc;
    margin-bottom: 10px;
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

.pollutant-select-bar {
    align-self: flex-start;
    background-color: rgba(255, 255, 255, 0.1); /* Dark shade matching chart container */
    padding: 0px 0px;
    border-radius: 10px;
    margin-bottom: 40px;
    margin-top: -40px;
    margin-left: -30px;
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

/* AQI Trend Chart Container */
.aqi-trend-chart-container {
    width: 94.5%; /* Adjust the overall width */
    max-width: 1300px; /* Prevents stretching on large screens */
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
.aqi-trend-title {
    position: absolute;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 22px; /* Reduce size for smaller screens */
    font-weight: bold;
    color: white;
    text-transform: uppercase;
    text-align: center;
}

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

.forecast-button-wrapper button:hover {
    background: linear-gradient(135deg, #0055FF, #0033A0);
    transform: scale(1.05);
    box-shadow: 0px 6px 15px rgba(0, 51, 160, 0.5);
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

.learn-more-button-wrapper button:hover {
    background: linear-gradient(135deg, #0055FF, #0033A0);
    transform: scale(1.05);
    box-shadow: 0px 6px 15px rgba(0, 51, 160, 0.5);
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
    padding: 20px;
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
        margin-top: -20px;
    }

    .learn-more-button-wrapper a {
        text-align: center;
        width: 100%;
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
        margin-left: 0;

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
        padding: 15px;
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
                <li><a href="history.php">Reports</a></li>
                <li><a href="about.php">About</a></li>
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

            <!-- Pie Chart -->
            <div class="pie-chart-wrapper">
            <!-- Replace your <canvas id="pollutantChart"> with this -->
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
                <option value="pm25">PM2.5</option>
                <option value="pm10">PM10</option>
                <option value="co">CO</option>
                <option value="o3">O₃</option>
                <option value="so2">SO₂</option>
                <option value="ch4">CH₄</option>
                <option value="temp">Temperature</option>
                <option value="hum">Humidity</option>
            </select>
        </div>
        <h2 class="aqi-trend-title">Pollutant Trends</h2>
        <div id="pollutantTrendContainer">
            <canvas id="pollutantTrendChart"></canvas>
        </div>
    </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("pollutantTrendChart").getContext("2d");

    // Initialize empty structures
    const pollutantData = {};
    const timeLabels = [];

    fetch('fetch_sensor_data.php')
        .then(response => response.json())
        .then(data => {
            // Populate timeLabels and pollutant data
            const pollutants = ["pm25", "pm10", "co", "o3", "so2", "ch4", "temp", "hum"];
            const labels = {
                pm25: "PM2.5 (µg/m³)",
                pm10: "PM10 (µg/m³)",
                co:   "CO (ppm)",
                o3:   "O₃ (ppb)",
                so2:  "SO₂ (ppb)",
                ch4:  "CH₄ (ppm)",
                temp: "Temperature (°C)",
                hum:  "Humidity (%)"
            };
            const colors = {
                pm25: "#3e95cd",
                pm10: "#27ae60",
                co:   "#e67e22",
                o3:   "#9b59b6",
                so2:  "#e74c3c",
                ch4:  "#f39c12",
                temp: "#3498db",
                hum:  "#1abc9c"
            };
            const maxValues = {
                pm25: 301,
                pm10: 301,
                co: 50,
                o3: 5,
                so2: 10,
                ch4: 5,
                temp: 40,
                hum: 100
            };

            // Initialize empty arrays for each pollutant
            pollutants.forEach(p => pollutantData[p] = { label: labels[p], data: [], color: colors[p], max: maxValues[p] });

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
            });

            let currentPollutant = "pm25";

            const chart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: timeLabels,
                    datasets: [{
                        label: pollutantData[currentPollutant].label,
                        data: pollutantData[currentPollutant].data,
                        borderColor: pollutantData[currentPollutant].color,
                        backgroundColor: pollutantData[currentPollutant].color + "33",
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: pollutantData[currentPollutant].color,
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
                                font: {
                                    family: "Poppins",
                                    size: 14
                                }
                            },
                            ticks: {
                                color: "#bbbbbb",
                                font: {
                                    family: "Poppins",
                                    size: 12
                                }
                            },
                            grid: {
                                color: "#444444"
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: pollutantData[currentPollutant].label,
                                color: "#cccccc",
                                font: {
                                    family: "Poppins",
                                    size: 14
                                }
                            },
                            ticks: {
                                color: "#bbbbbb",
                                font: {
                                    family: "Poppins",
                                    size: 12
                                }
                            },
                            grid: {
                                color: "#444444"
                            },
                            min: 0,
                            max: pollutantData[currentPollutant].max
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            titleColor: "#ffffff",
                            bodyColor: "#eeeeee",
                            backgroundColor: "#333333",
                            titleFont: {
                                family: "Poppins",
                                size: 14
                            },
                            bodyFont: {
                                family: "Poppins",
                                size: 12
                            }
                        }
                    }
                }
            });

            // Handle dropdown change
            document.getElementById("pollutantSelect").addEventListener("change", function () {
                currentPollutant = this.value;
                chart.data.datasets[0].label = pollutantData[currentPollutant].label;
                chart.data.datasets[0].data = pollutantData[currentPollutant].data;
                chart.data.datasets[0].borderColor = pollutantData[currentPollutant].color;
                chart.data.datasets[0].backgroundColor = pollutantData[currentPollutant].color + "33";
                chart.data.datasets[0].pointBackgroundColor = pollutantData[currentPollutant].color;
                chart.options.scales.y.title.text = pollutantData[currentPollutant].label;
                chart.options.scales.y.max = pollutantData[currentPollutant].max;
                chart.update();
            });

        })
        .catch(error => {
            console.error("Error loading sensor data:", error);
        });
});
</script>






   
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


   <div class="aqi-trend-chart-container">
   <h2 class="aqi-trend-title">AQI Trend Over Time</h2>
    <div id="aqiTrendContainer">
        <canvas id="aqiTrendChart"></canvas>
    </div>
</div>

<script>
function updateAQICircle(aqi) {
    let circle = document.getElementById("aqiCircle");
    let text = document.getElementById("aqiText");
    let statusText = document.getElementById("aqiStatusText");

    // AQI levels and colors
    let aqiLevels = [
        { level: "Good", max: 50, color: "#388e3c" }, // Green
        { level: "Satisfactory", max: 100, color: "#ff9800" }, // Yellow
        { level: "Moderate", max: 150, color: "#ff5722" }, // Orange
        { level: "Poor", max: 200, color: "#d32f2f" }, // Red
        { level: "Very Poor", max: 300, color: "#7b1fa2" }, // Purple
        { level: "Severe", max: 500, color: "#9e1e32" } // Maroon
    ];

    // Determine the AQI status and color
    let selectedLevel = aqiLevels.find(level => aqi <= level.max) || aqiLevels[aqiLevels.length - 1];

    // Set full circle color
    circle.style.stroke = selectedLevel.color;
    circle.style.strokeDasharray = "282.6"; // Full circle
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
            } else {
                let aqi = data.AQI;  // Assuming 'AQI' is the field in the JSON
                updateAQICircle(aqi);
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
function updateMainPollutantDisplay(pollutants) {
    let maxAQI = -1;
    let mainPollutant = "---";

    // Debug: print all AQI values to console
    console.log("Pollutant AQIs:", pollutants);

    for (let key in pollutants) {
        const aqi = Number(pollutants[key]); // Ensure it's a number
        if (!isNaN(aqi) && aqi > maxAQI) {
            maxAQI = aqi;
            mainPollutant = key;
        }
    }

    // Update the pollutant name inside the circle
    document.getElementById("mainPollutantText").textContent = mainPollutant.toUpperCase();
}

// Function to fetch data from latest_data_api.php and update main pollutant
function fetchAndUpdateMainPollutant() {
    fetch("latest_data_api.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error:", data.error);
                return;
            }

            // Convert AQI values to numbers if needed
            const pollutants = {
                "PM2.5": data.AQI_PM25,
                "PM10": data.AQI_PM10,
                "CO": data.AQI_CO,
                "O3": data.AQI_O3,
                "SO2": data.AQI_SO2,
                "CH4": data.AQI_CH4
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

    let aqiData = [50, 60, 70, 65, 80, 90, 85, 30]; // AQI values
    let timeLabels = ["10 AM", "11 AM", "12 PM", "1 PM", "2 PM", "3 PM", "4 PM", "5 PM"]; // Time labels

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
                tension: 0.4 // Smooth curve
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
            font: {
                family: "Poppins",
                size: 14
            }
        },
        ticks: {
            color: "#bbbbbb",
            font: {
                family: "Poppins",
                size: 12
            }
        },
        grid: {
            color: "#444444" // Dark gray for grid lines (lighter than black)
        }
    },
    y: {
        title: {
            display: true,
            text: "AQI Value",
            color: "#cccccc",
            font: {
                family: "Poppins",
                size: 14
            }
        },
        ticks: {
            color: "#bbbbbb",
            font: {
                family: "Poppins",
                size: 12
            }
        },
        grid: {
            color: "#444444" // Dark gray for Y-axis grid lines
        },
        min: 0,
        max: 300
    }
}
,
            plugins: {
                legend: {
                    display: false // Hide legend to save space
                },
                tooltip: {
                    titleColor: "#ffffff",
                    bodyColor: "#eeeeee",
                    backgroundColor: "#333333",
                    titleFont: {
                        family: "Poppins",
                        size: 14
                    },
                    bodyFont: {
                        family: "Poppins",
                        size: 12
                    }
                }
            }
        }
    });

    // Function to Update Chart Dynamically
    function updateChart(newAQI, newLabel) {
        if (aqiData.length >= 7) {
            aqiData.shift();
            timeLabels.shift();
        }
        aqiData.push(newAQI);
        timeLabels.push(newLabel);
        aqiTrendChart.update();
    }
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

            const so2 = data.H2;

            document.getElementById('pm25_val').textContent = data.PM25 + ' µg/m³';
            document.getElementById('pm10_val').textContent = data.PM10 + ' µg/m³';
            document.getElementById('co_val').textContent = data.CO + ' ppm';
            document.getElementById('o3_val').textContent = data.O3 + ' ppb';
            document.getElementById('so2_val').textContent = so2 + ' ppm';
            document.getElementById('ch4_val').textContent = data.CH4 + ' ppm';
            document.getElementById('temp_val').textContent = data.TEMP + '°C';
            document.getElementById('hum_val').textContent = data.HUM + '%';

            applyLevel('pm25_level', getPM25Level(data.PM25));
            applyLevel('pm10_level', getPM10Level(data.PM10));
            applyLevel('co_level', getCOLevel(data.CO));
            applyLevel('o3_level', getO3Level(data.O3));
            applyLevel('so2_level', getSO2Level(so2));
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

