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
            background: linear-gradient(-45deg, #1e1e2f, #12121f, #232344);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            color: white;
            margin: 0;
            padding: 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        /* Navigation */
        nav ul {
            list-style: none;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0;
            margin: 0;
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
        .container {
            max-width: 1300px;
            margin: 30px auto;
            padding: 0 10px;
            display: flex;
            
        }

        /* Unified AQI Container */
        .aqi-single-container {
            position: relative;
            display: flex;
            flex-direction: column; /* change to row if needed */
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 20px;
            margin: 0 auto;
            min-height: 300px;
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            box-shadow: 0px 0px 10px rgba(255, 102, 0, 0.8);
            transform: scale(1.05);
        }

        .forecast-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    flex-wrap: wrap;
}

.metric-card {
    position: relative;
    background: rgba(255, 255, 255, 0.1);
    
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.metric-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.metric-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 2px;
    background: rgba(255, 255, 255, 0.2);
}

.metric-values p {
    font-size: 1.5rem;
    font-weight: bold;
}

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

.level-card:hover {
    transform: scale(1.1);
}

.overall-aqi {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 12px;
    width: 300px;
    margin: 0 auto;
    box-shadow: 0 2px 8px rgba(255,255,255,0.1);
}

.aqi-value {
    font-size: 48px;
    font-weight: bold;
    color: #ffcc00;
    margin-top: 10px;
}

/* Responsive */
@media (max-width: 1024px) {
    .forecast-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .forecast-grid {
        grid-template-columns: 1fr;
    }

    .overall-aqi {
        width: 100%;
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
                <li><a href="history.php">Reports</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
    <div class="aqi-single-container">
    <h2 style="text-align:center; margin-bottom: 30px;">1-Hour Air Quality Forecast</h2>
    
    <div class="forecast-grid">
        <div class="metric-card">
            <h3>PM2.5</h3>
            <div class="metric-values">
                <p>35 µg/m³</p>
            </div>
            <div class="level-card" style="background-color:#ffa500;">Moderate</div>
        </div>
        <div class="metric-card">
            <h3>PM10</h3>
            <div class="metric-values">
                <p>50 µg/m³</p>
            </div>
            <div class="level-card" style="background-color:#ff7f50;">Unhealthy for Sensitive Groups</div>
        </div>
        <div class="metric-card">
            <h3>CO</h3>
            <div class="metric-values">
                <p>0.8 ppm</p>
            </div>
            <div class="level-card" style="background-color:#90ee90;">Good</div>
        </div>
        <div class="metric-card">
            <h3>O₃</h3>
            <div class="metric-values">
                <p>30 ppb</p>
            </div>
            <div class="level-card" style="background-color:#90ee90;">Good</div>
        </div>
        <div class="metric-card">
            <h3>SO₂</h3>
            <div class="metric-values">
                <p>15 ppb</p>
            </div>
            <div class="level-card" style="background-color:#ffa500;">Moderate</div>
        </div>
        <div class="metric-card">
            <h3>CH₄</h3>
            <div class="metric-values">
                <p>1.2 ppm</p>
            </div>
            <div class="level-card" style="background-color:#90ee90;">Good</div>
        </div>
        <div class="metric-card">
            <h3>Temperature</h3>
            <div class="metric-values">
                <p>27°C</p>
            </div>
        </div>
        <div class="metric-card">
            <h3>Humidity</h3>
            <div class="metric-values">
                <p>60%</p>
            </div>
        </div>
    </div>

    <div class="overall-aqi" style="margin-top: 40px;">
        <h3>Overall Air Quality Index</h3>
        <div class="aqi-value">78</div>
    </div>
</div>


    </div>

</body>
</html>