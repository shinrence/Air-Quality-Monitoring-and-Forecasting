<?php
// Enable output buffering to prevent header issues
ob_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Set timezone
date_default_timezone_set('Asia/Manila');

// Debug: log raw POST data for testing
$debug_log = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'post_data' => $_POST,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $raw_data = $_POST['data'];
    parse_str($raw_data, $parsed_data);

    // Append parsed data to debug log
    $debug_log['parsed_data'] = $parsed_data;

    // PostgreSQL config
    $host = "dpg-d0mr2al6ubrc73em1abg-a.oregon-postgres.render.com";
    $port = "5432";
    $dbname = "sensor_db_8z7o";
    $user = "shinrence";
    $password = "7FUE2kw8lqc0uExXXGeCcm0ABkFG6cGN";

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("
INSERT INTO sensor_data
(temp, hum, ch4, co, h2, o3, pm1, pm25, pm10, aqi_pm25, aqi_pm10, aqi_co, aqi_so2, aqi_o3, aqi_total, timestamp)
VALUES (:temp, :hum, :ch4, :co, :h2, :o3, :pm1, :pm25, :pm10, :aqi_pm25, :aqi_pm10, :aqi_co, :aqi_so2, :aqi_o3, :aqi_total, NOW())
");

$stmt->execute([
':temp' => $parsed_data['TEMP'],
':hum' => $parsed_data['HUM'],
':ch4' => $parsed_data['CH4'],
':co' => $parsed_data['CO'],
':h2' => $parsed_data['H2'],
':o3' => $parsed_data['O3'],
':pm1' => $parsed_data['PM1'],
':pm25' => $parsed_data['PM25'],
':pm10' => $parsed_data['PM10'],
':aqi_pm25' => $parsed_data['AQI_PM25'],
':aqi_pm10' => $parsed_data['AQI_PM10'],
':aqi_co' => $parsed_data['AQI_CO'],
':aqi_so2' => $parsed_data['AQI_SO2'],
':aqi_o3' => $parsed_data['AQI_O3'],
':aqi_total' => $parsed_data['AQI']
]);

        $debug_log['success'] = true;
        $debug_log['message'] = "✅ Data saved to database.";
    } catch (PDOException $e) {
        $debug_log['success'] = false;
        $debug_log['message'] = "❌ DB Error: " . $e->getMessage();
    }
} else {
    $debug_log['success'] = false;
    $debug_log['message'] = "🌐 Awaiting data from ESP8266 via POST...";
}

// Output debug log as JSON
echo json_encode($debug_log);
