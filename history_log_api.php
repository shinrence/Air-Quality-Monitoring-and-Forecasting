<?php
$api_url = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php';

// Fetch data from the API
$response = file_get_contents($api_url);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch data from API.']);
    exit;
}

$entries = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Invalid JSON format from API.',
        'json_error' => json_last_error_msg(),
        'raw_response' => $response
    ]);
    exit;
}

// Filter valid entries with required fields
$required_keys = ['timestamp', 'temp', 'hum', 'ch4', 'co', 'h2', 'o3', 'pm25', 'pm10',
                  'aqi_pm25', 'aqi_pm10', 'aqi_co', 'aqi_so2', 'aqi_o3', 'aqi_total'];

$filtered_entries = [];

foreach ($entries as $entry) {
    $missing = false;
    foreach ($required_keys as $key) {
        if (!isset($entry[$key])) {
            $missing = true;
            break;
        }
    }
    if ($missing) continue;

    // Optional: rename 'h2' to 'so2' for consistency
    $entry['so2'] = $entry['h2'];
    unset($entry['h2']);

    $filtered_entries[] = $entry;
}

// Sort by timestamp ascending
usort($filtered_entries, function($a, $b) {
    return strtotime($a['timestamp']) <=> strtotime($b['timestamp']);
});

// Return as JSON
header('Content-Type: application/json');
echo json_encode($filtered_entries);
