
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

  <div class="container">
    <h2>Pollutant Data History</h2>
    <button id="toggleView" class="toggle-button" style="display: none;">View Chart</button>
    <label for="pollutant">Select Pollutant:</label>
    <select id="pollutant">
      <option value="">-- Select Pollutant --</option>
      <option value="PM25">PM2.5</option>
      <option value="PM10">PM10</option>
      <option value="CO">CO</option>
      <option value="O3">O3</option>
      <option value="SO2">SO2</option>
      <option value="CH4">CH4</option>
      <option value="TEMP">Temperature</option>
      <option value="HUM">Humidity</option>
      <option value="AQI">AQI</option>
    </select>

    <label for="date">Select Date:</label>
    <select id="date" disabled></select>

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
      showTable();
    });

    toggleBtn.addEventListener('click', () => {
      if (currentView === 'table') {
        showChart();
      } else {
        showTable();
      }
    });

    function groupHourlyAverages() {
      const relevantData = allData.filter(entry => entry.timestamp.startsWith(selectedDate));
      const hourlyGrouped = {};

      relevantData.forEach(entry => {
        const hour = entry.timestamp.split(' ')[1].split(':')[0];
        const value = parseFloat(
            selectedPollutant === 'SO2' ? entry['H2'] : entry[selectedPollutant]
        );

        if (!isNaN(value)) {
          if (!hourlyGrouped[hour]) hourlyGrouped[hour] = [];
          hourlyGrouped[hour].push(value);
        }
      });

      return Object.entries(hourlyGrouped).map(([hour, values]) => {
        const avg = (values.reduce((a, b) => a + b, 0) / values.length).toFixed(2);
        return { hour: hour, avg: avg };
        
      }).sort((a, b) => a.hour - b.hour);
    }

    function showTable() {
      const rows = groupHourlyAverages().map(entry => {
        return `<tr><td>${formatHour(entry.hour, true)}</td><td>${entry.avg}</td></tr>`;


      });

      dataDisplay.innerHTML = `
        <table>
          <thead>
            <tr>
              <th>Hour</th>
              <th>Average ${selectedPollutant}</th>
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
            label: `Average ${selectedPollutant}`,
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

  if (fullRange) {
    return `${startHour}:00 - ${endHour}:59 ${period}`;
  } else {
    return `${startHour}:00 ${period}`;
  }
}


  </script>
</body>
</html>