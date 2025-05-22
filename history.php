
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
  </style>
</head>
<body>
  <header>
    <h1>Air Quality Index History</h1>
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
    <h2>Pollutant Data History</h2>
    <button id="toggleView" class="toggle-button" style="display: none;">View Chart</button>
    <label for="pollutant">Select Pollutant:</label>
    <select id="pollutant">
      <option value="">-- Select Pollutant --</option>
      <option value="temp">Temperature</option>
      <option value="hum">Humidity</option>
      <option value="ch4">Heat Index</option>
      <option value="co">CO</option>
      <option value="so2">SO₂</option>
      <option value="o3">O₃</option>
      <option value="pm25">PM2.5</option>
      <option value="pm10">PM10</option>
      <option value="aqi_total">AQI - Overall</option>
    </select>


    <label for="date">Select Date:</label>
    <select id="date" disabled></select>

    <label for="start-hour">Start Hour:</label>
<select id="start-hour" disabled></select>

<label for="end-hour">End Hour:</label>
<select id="end-hour" disabled></select>


    <div id="data-display"></div>

    
  </div>

  <footer>
    <p>© 2025 Shinrence Air Quality Dashboard. All rights reserved.</p>
  </footer>

  <script>
    let allData = [];
    let selectedPollutant = '';
    let selectedDate = '';
    let currentView = 'table';
    const pollutantSelect = document.getElementById('pollutant');
    const dateSelect = document.getElementById('date');
    const dataDisplay = document.getElementById('data-display');
    const toggleBtn = document.getElementById('toggleView');
    const startHourSelect = document.getElementById('start-hour');
    const endHourSelect = document.getElementById('end-hour');


    fetch('history_log_api.php')
      .then(response => response.json())
      .then(data => {
        allData = data;
      });

    pollutantSelect.addEventListener('change', () => {
      selectedPollutant = pollutantSelect.value;
      dataDisplay.innerHTML = '';
      toggleBtn.style.display = 'none';
      dateSelect.innerHTML = '';
      if (!selectedPollutant) {
        dateSelect.disabled = true;
        return;
      }

      const dates = Array.from(new Set(allData.map(entry => entry.timestamp.split(' ')[0])));
      dateSelect.innerHTML = '<option value="">-- Select Date --</option>';
      dates.forEach(date => {
        const opt = document.createElement('option');
        opt.value = date;
        opt.textContent = date;
        dateSelect.appendChild(opt);
      });
      dateSelect.disabled = false;
    });

    dateSelect.addEventListener('change', () => {
  selectedDate = dateSelect.value;
  if (!selectedDate || !selectedPollutant) return;

  // Populate hour options based on selected date
  const hours = Array.from(
    new Set(
      allData
        .filter(entry => entry.timestamp.startsWith(selectedDate))
        .map(entry => entry.timestamp.split(' ')[1].split(':')[0])
    )
  ).sort((a, b) => a - b);

  startHourSelect.innerHTML = '<option value="">-- Start Hour --</option>';
  endHourSelect.innerHTML = '<option value="">-- End Hour --</option>';
  hours.forEach(hour => {
    const opt1 = document.createElement('option');
    opt1.value = hour;
    opt1.textContent = `${hour}:00`;
    startHourSelect.appendChild(opt1);

    const opt2 = opt1.cloneNode(true);
    endHourSelect.appendChild(opt2);
  });

  startHourSelect.disabled = false;
  endHourSelect.disabled = false;

  showTable();  // Initial display
});

startHourSelect.addEventListener('change', showTable);
endHourSelect.addEventListener('change', showTable);


    function groupHourlyAverages() {
  const startHour = startHourSelect.value;
  const endHour = endHourSelect.value;

  const relevantData = allData.filter(entry => {
    if (!entry.timestamp.startsWith(selectedDate)) return false;
    const hour = entry.timestamp.split(' ')[1].split(':')[0];

    if (startHour && hour < startHour) return false;
    if (endHour && hour > endHour) return false;

    return true;
  });

  const hourlyGrouped = {};

  relevantData.forEach(entry => {
    const hour = entry.timestamp.split(' ')[1].split(':')[0];
    const pollutantKey = selectedPollutant.toLowerCase();
    const value = parseFloat(entry[pollutantKey]);

    let aqiKey = '';
    if (pollutantKey === 'pm25') aqiKey = 'aqi_pm25';
    else if (pollutantKey === 'pm10') aqiKey = 'aqi_pm10';
    else if (pollutantKey === 'co') aqiKey = 'aqi_co';
    else if (pollutantKey === 'so2' || pollutantKey === 'h2') aqiKey = 'aqi_so2';
    else if (pollutantKey === 'o3') aqiKey = 'aqi_o3';
    else if (pollutantKey === 'aqi_total') aqiKey = 'aqi_total';

    const aqiVal = parseFloat(entry[aqiKey]);

    if (!isNaN(value)) {
      if (!hourlyGrouped[hour]) hourlyGrouped[hour] = { values: [], aqiValues: [] };
      hourlyGrouped[hour].values.push(value);
      if (!isNaN(aqiVal)) hourlyGrouped[hour].aqiValues.push(aqiVal);
    }
  });

  return Object.entries(hourlyGrouped).map(([hour, data]) => {
    const avg = (data.values.reduce((a, b) => a + b, 0) / data.values.length).toFixed(2);
    const aqiAvg = data.aqiValues.length > 0 ? 
      (data.aqiValues.reduce((a, b) => a + b, 0) / data.aqiValues.length).toFixed(2) : "N/A";
    return { hour, avg, aqiAvg };
  }).sort((a, b) => a.hour - b.hour);
}


function getAQILevel(aqi) {
    if (aqi <= 50) return { level: 'Good', color: '#388e3c' };
    if (aqi <= 100) return { level: 'Satisfactory', color: '#ff9800' };
    if (aqi <= 150) return { level: 'Moderate', color: '#ff5722' };
    if (aqi <= 200) return { level: 'Poor', color: '#d32f2f' };
    if (aqi <= 300) return { level: 'Very Poor', color: '#7b1fa2' };
    return { level: 'Severe', color: '#9e1e32' };
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



    function showTable() {
  const rows = groupHourlyAverages().map(entry => {
  const hour = formatHour(entry.hour, true);
  const avg = parseFloat(entry.avg);
  let aqi = 'N/A';
  let levelData = { level: 'N/A', color: '#ccc' };

  const pollutantKey = selectedPollutant.toLowerCase();

  if (pollutantKey === 'pm25') {
    aqi = avg; // use avg if you're treating avg as AQI for now
    levelData = getPM25Level(avg);
  } else if (pollutantKey === 'pm10') {
    aqi = avg;
    levelData = getPM10Level(avg);
  } else if (pollutantKey === 'co') {
    aqi = avg;
    levelData = getCOLevel(avg);
  } else if (pollutantKey === 'o3') {
    aqi = avg;
    levelData = getO3Level(avg);
  } else if (pollutantKey === 'so2' || pollutantKey === 'h2') {
    aqi = avg;
    levelData = getSO2Level(avg);
  } else if (pollutantKey === 'ch4') {
    levelData = getCH4Level(avg); // You can define this
  } else if (pollutantKey === 'temp') {
    levelData = getTempLevel(avg); // You can define this
  } else if (pollutantKey === 'hum') {
    levelData = getHumLevel(avg); // You can define this
  }

  return `<tr>
            <td>${hour}</td>
            <td>${avg}</td>
            <td>${aqi}</td>
            <td style="color: ${levelData.color}; font-weight: bold;">${levelData.level}</td>
          </tr>`;
});


  dataDisplay.innerHTML = `
    <table>
      <thead>
        <tr>
          <th>Hour</th>
          <th>Average</th>
          <th>AQI</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
        ${rows.join('')}
      </tbody>
    </table>
  `;

  toggleBtn.textContent = 'View Chart';
  toggleBtn.style.display = 'inline-block';
  currentView = 'table';
}



    function showChart() {
      const data = groupHourlyAverages();
      const labels = data.map(entry => formatHour(entry.hour));

      const values = data.map(entry => entry.avg);

      dataDisplay.innerHTML = `<canvas id="chartCanvas"></canvas>`;
      const ctx = document.getElementById('chartCanvas').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: `Average`,
            data: values,
            borderColor: '#ffcc00',
            backgroundColor: 'rgba(255,204,0,0.2)',
            fill: true,
            tension: 0.3
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                color: '#fff'
              }
            },
            x: {
              ticks: {
                color: '#fff'
              }
            }
          },
          plugins: {
            legend: {
              labels: {
                color: '#fff'
              }
            }
          }
        }
      });

      toggleBtn.textContent = 'View Table';
      currentView = 'chart';
    }

    function formatHour(hour, fullRange = false) {
  const intHour = parseInt(hour);
  const startHour = intHour % 12 === 0 ? 12 : intHour % 12;
  const endHour = startHour;
  const period = intHour >= 12 ? 'PM' : 'AM';

  return fullRange
    ? `${startHour}:00 - ${startHour}:59 ${period}`
    : `${startHour}:00 ${period}`;
}



  </script>
</body>
</html>