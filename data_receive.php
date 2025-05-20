<?php
// Set timezone to Philippines
date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $raw_data = $_POST['data'];
    parse_str($raw_data, $parsed_data);

    // Add timestamp to data
    $parsed_data['timestamp'] = date("Y-m-d H:i:s");

    // Convert to JSON and append to file with newline
    file_put_contents('https://air-quality-php-backend.onrender.com/all_data_log.txt', json_encode($parsed_data) . PHP_EOL, FILE_APPEND);

    // Optional: update the latest data file too
    file_put_contents('https://air-quality-php-backend.onrender.com/latest_data.txt', json_encode($parsed_data));

    echo "✅ Data saved successfully!";
} else {
    echo "🌐 Awaiting data from ESP8266 via POST...";
}















