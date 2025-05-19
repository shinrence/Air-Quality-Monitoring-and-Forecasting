<?php
// history.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pollutant History</title>
  <link rel="stylesheet" href="dashboard.css">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 1000px;
      margin: auto;
      padding: 20px;
    }
    select, table {
      margin: 10px 0;
      padding: 8px;
      background-color: #1e1e1e;
      border: 1px solid #333;
      color: #fff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #444;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Pollutant Data History</h2>
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

    <div id="data-table"></div>
  </div>

  <script>
    let allData = [];
    let selectedPollutant = '';
    const pollutantSelect = document.getElementById('pollutant');
    const dateSelect = document.getElementById('date');
    const dataTableDiv = document.getElementById('data-table');

    // Fetch all data
    fetch('history_log_api.php')
      .then(response => response.json())
      .then(data => {
        allData = data;
      });

    // Handle pollutant selection
    pollutantSelect.addEventListener('change', () => {
      selectedPollutant = pollutantSelect.value;
      dateSelect.innerHTML = '';
      dataTableDiv.innerHTML = '';

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

    // Handle date selection – show hourly averages
    dateSelect.addEventListener('change', () => {
      dataTableDiv.innerHTML = '';
      const selectedDate = dateSelect.value;

      if (!selectedDate || !selectedPollutant) return;

      const relevantData = allData.filter(entry =>
        entry.timestamp.startsWith(selectedDate)
      );

      const hourlyGrouped = {};

      relevantData.forEach(entry => {
        const hour = entry.timestamp.split(' ')[1].split(':')[0];
        const value = parseFloat(entry[selectedPollutant]);
        if (!isNaN(value)) {
          if (!hourlyGrouped[hour]) hourlyGrouped[hour] = [];
          hourlyGrouped[hour].push(value);
        }
      });

      const rows = Object.entries(hourlyGrouped).map(([hour, values]) => {
        const avg = (values.reduce((a, b) => a + b, 0) / values.length).toFixed(2);
        return `<tr><td>${hour}:00 - ${hour}:59</td><td>${avg}</td></tr>`;
      });

      dataTableDiv.innerHTML = `
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
    });
  </script>
</body>
</html>
