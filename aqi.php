<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Quality Index (AQI) Guide</title>
    <link rel="stylesheet" href="styles.css"> <!-- If you have a separate CSS file -->
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

        /* Container */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            text-align: center;
        }

        /* AQI Table */
        .aqi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .aqi-table th, .aqi-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .aqi-table th {
            background-color: rgba(255, 255, 255, 0.2);
            font-size: 18px;
        }

        /* AQI Colors */
        .good { background-color: #1b5e20; color: white; } /* Dark Green */
        .moderate { background-color: #ffb300; color: black; } /* Darker Yellow */
        .unhealthy-for-sensitive-groups { background-color: #ff8f00; color: black; } /* Darker Yellow than satisfactory */
        .unhealthy { background-color: #e65100; color: white; } /* Dark Orange */
        .very-unhealthy { background-color: #b71c1c; color: white; } /* Dark Red */
        .hazardous { background-color: #4a001f; color: white; } /* Dark Maroon */

        @media screen and (max-width: 600px) {
    .container {
        padding: 15px; /* Reduce side padding for smaller screens */
    }

    .aqi-table {
        display: block;
        width: 100%;
        overflow-x: auto; /* Enables horizontal scroll if needed */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }

    .aqi-table table {
        width: 100%;
        min-width: 600px; /* Ensure the table doesn't shrink too much */
    }
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
        <h2>EPA Air Quality Index (AQI) Levels</h2>
        <p>The Air Quality Index (AQI) is used to communicate the level of air pollution and its associated health risks.</p>

        <table class="aqi-table">
            <tr>
                <th>Air Quality</th>
                <th>AQI Range</th>
                <th>Description</th>
            </tr>
            <tr class="good">
                <td>Good</td>
                <td>0 - 50</td>
                <td>Air quality is considered satisfactory, and air pollution poses little or no risk.</td>
            </tr>
            <tr class="moderate">
                <td>Moderate</td>
                <td>51 - 100</td>
                <td>Air quality is acceptable, but some pollutants may be a concern for sensitive individuals.</td>
            </tr>
            <tr class="unhealthy-for-sensitive-groups">
                <td>Unhealthy for Sensitive Groups</td>
                <td>101 - 150</td>
                <td>Members of sensitive groups may experience health effects, but the general public is unlikely to be affected.</td>
            </tr>
            <tr class="unhealthy">
                <td>Unhealthy</td>
                <td>151 - 200</td>
                <td>Everyone may begin to experience health effects; members of sensitive groups may experience more serious effects.</td>
            </tr>
            <tr class="very-unhealthy">
                <td>Very Unhealthy</td>
                <td>201 - 300</td>
                <td>Health alert: Everyone may experience more serious health effects.</td>
            </tr>
            <tr class="hazardous">
                <td>Hazardous</td>
                <td>301 - 500</td>
                <td>Health warning of emergency conditions: The entire population is more likely to be affected.</td>
            </tr>
        </table>
    </div>

    <footer>
        <p>© 2025 Air Quality Monitoring System. All rights reserved.</p>
    </footer>

</body>
</html>



