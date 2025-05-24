<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About - Air Quality Monitoring</title>
  <style>
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
            justify-content: flex-end;
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
        }

    

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 30px 20px;
    }

    h2 {
      color: #ffcc00;
      border-bottom: 1px solid #ffcc00;
      padding-bottom: 5px;
      margin-top: 30px;
    }

    ul {
      padding-left: 20px;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: rgba(0, 0, 0, 0.6);
      margin-top: 40px;
    }

    .pollutant-list {
      background: rgba(255, 255, 255, 0.05);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <header>
    <h1>Air Quality Monitoring</h1>
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
    <h2>About This Project</h2>
    <p>This Air Quality Monitoring System is designed to track real-time environmental data and provide clear, actionable insights to help protect health and well-being. By monitoring pollutants and weather conditions, the system helps communities stay informed about the air they breathe.</p>

    <h2>What is the Air Quality Index (AQI)?</h2>
    <p>The AQI is a standardized system used globally to measure and communicate how polluted the air currently is or how polluted it is forecast to become. It ranges from 0 (Good) to 500 (Hazardous), and higher values represent greater health concerns. It’s calculated based on pollutants such as PM2.5, PM10, CO, SO₂, O₃, and others.</p>

    <h2>Why is Monitoring Air Quality Important?</h2>
    <ul>
      <li>Protects individuals with respiratory conditions like asthma and heart disease</li>
      <li>Helps people make safe choices about outdoor activity</li>
      <li>Informs government agencies and the public of environmental health risks</li>
      <li>Supports long-term research on climate and health impacts</li>
    </ul>

    <h2>Pollutants Monitored</h2>

    <div class="pollutant-list">
      <strong>PM2.5 (Fine Particulate Matter):</strong>
      <p>Particles with a diameter of 2.5 micrometers or smaller. Can penetrate deep into the lungs and even enter the bloodstream, causing cardiovascular and respiratory issues.</p>
    </div>

    <div class="pollutant-list">
      <strong>PM10 (Inhalable Particulates):</strong>
      <p>Particles up to 10 micrometers in diameter. These can cause respiratory irritation and worsen asthma and bronchitis.</p>
    </div>

    <div class="pollutant-list">
      <strong>CO (Carbon Monoxide):</strong>
      <p>A colorless, odorless gas produced by burning fossil fuels. It interferes with oxygen transport in the body and can be life-threatening at high levels.</p>
    </div>

    <div class="pollutant-list">
      <strong>SO₂ (Sulfur Dioxide):</strong>
      <p>A gas produced from burning coal and oil. It can irritate the respiratory system and is especially dangerous to individuals with asthma.</p>
    </div>

    <div class="pollutant-list">
      <strong>O₃ (Ozone):</strong>
      <p>At ground level, ozone is harmful. It is created by chemical reactions between VOCs and NOx in sunlight. High ozone levels can trigger asthma and decrease lung function.</p>
    </div>

    <div class="pollutant-list">
      <strong>Temperature (°C):</strong>
      <p>Extreme temperatures can influence the formation of pollutants and affect human health, especially during heatwaves.</p>
    </div>

    <div class="pollutant-list">
      <strong>Humidity (%):</strong>
      <p>Humidity affects the dispersion of pollutants. Very high or very low humidity can impact breathing and comfort.</p>
    </div>

    <div class="pollutant-list">
      <strong>Heat Index:</strong>
      <p>Represents what the temperature feels like when humidity is factored in. High heat index values increase the risk of heat exhaustion and heatstroke.</p>
    </div>

    <h2>How This Website Helps</h2>
    <ul>
      <li>Provides real-time air quality data and future forecasts</li>
      <li>Gives health advice and precautionary steps for each AQI level</li>
      <li>Displays color-coded indicators and levels to aid quick decision-making</li>
      <li>Educates users on pollutant types and safe exposure levels</li>
    </ul>

    <h2>Target Users</h2>
    <p>This platform is valuable for everyone—especially sensitive groups like children, the elderly, and people with respiratory or cardiovascular illnesses. It's also helpful for outdoor workers, city planners, health professionals, and educators.</p>
  </div>

  <footer>
    <p>© 2025 Air Quality Monitoring System. All rights reserved.</p>
  </footer>
</body>
</html>
