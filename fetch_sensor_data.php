<?php
$api_url = 'https://air-quality-php-backend.onrender.com/all_data_log_api.php'; // Or full URL if hosted elsewhere

// Fetch data from API
$response = file_get_contents($api_url);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch data from API.']);
    exit;
}

// DEBUG: See what you got
// echo $response;

$entries = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Invalid data format from API.',
        'json_error' => json_last_error_msg(),
        'raw_response' => $response
    ]);
    exit;
}

$data_by_hour = [];

foreach ($entries as $entry) {
    if (!isset($entry['timestamp'])) continue;

    // Add AQI fields to required keys (updated keys based on API data)
    $required_keys = ['temp', 'hum', 'ch4', 'co', 'h2', 'o3', 'pm25', 'pm10',
                      'aqi_pm25', 'aqi_pm10', 'aqi_co', 'aqi_so2', 'aqi_o3', 'aqi_total'];
    $missing = false;
    foreach ($required_keys as $key) {
        if (!isset($entry[$key])) {
            $missing = true;
            break;
        }
    }
    if ($missing) continue;

    $hour = date('Y-m-d H:00:00', strtotime($entry['timestamp'] . ' +8 hours'));


    if (!isset($data_by_hour[$hour])) {
        $data_by_hour[$hour] = [
            'count' => 0,
            'temp' => 0, 'hum' => 0, 'ch4' => 0, 'co' => 0,
            'so2' => 0, 'o3' => 0, 'pm25' => 0, 'pm10' => 0,
            'aqi_pm25' => 0, 'aqi_pm10' => 0, 'aqi_co' => 0,
            'aqi_so2' => 0, 'aqi_o3' => 0, 'aqi' => 0
        ];
    }

    $data_by_hour[$hour]['count']++;
    $data_by_hour[$hour]['temp']     += floatval($entry['temp']);
    $data_by_hour[$hour]['hum']      += floatval($entry['hum']);
    $data_by_hour[$hour]['ch4']      += floatval($entry['ch4']);
    $data_by_hour[$hour]['co']       += floatval($entry['co']);
    $data_by_hour[$hour]['so2']      += floatval($entry['h2']); // h2 used as so2
    $data_by_hour[$hour]['o3']       += floatval($entry['o3']);
    $data_by_hour[$hour]['pm25']     += floatval($entry['pm25']);
    $data_by_hour[$hour]['pm10']     += floatval($entry['pm10']);
    $data_by_hour[$hour]['aqi_pm25'] += floatval($entry['aqi_pm25']);
    $data_by_hour[$hour]['aqi_pm10'] += floatval($entry['aqi_pm10']);
    $data_by_hour[$hour]['aqi_co']   += floatval($entry['aqi_co']);
    $data_by_hour[$hour]['aqi_so2']  += floatval($entry['aqi_so2']);
    $data_by_hour[$hour]['aqi_o3']   += floatval($entry['aqi_o3']);
    $data_by_hour[$hour]['aqi']      += floatval($entry['aqi_total']);
}

// Sort by hour descending
krsort($data_by_hour);

// Extract latest 7 hours
$averaged_data = [];
$count = 0;
foreach ($data_by_hour as $hour => $values) {
    if ($count++ >= 7) break;
    $n = $values['count'];
    $averaged_data[] = [
        'hour' => $hour,
        'avg_temp'     => round($values['temp'] / $n, 2),
        'avg_hum'      => round($values['hum'] / $n, 2),
        'avg_ch4'      => round($values['ch4'] / $n, 2),
        'avg_co'       => round($values['co'] / $n, 2),
        'avg_so2'      => round($values['so2'] / $n, 2),
        'avg_o3'       => round($values['o3'] / $n, 2),
        'avg_pm25'     => round($values['pm25'] / $n, 2),
        'avg_pm10'     => round($values['pm10'] / $n, 2),
        'avg_aqi_pm25' => round($values['aqi_pm25'] / $n),
        'avg_aqi_pm10' => round($values['aqi_pm10'] / $n),
        'avg_aqi_co'   => round($values['aqi_co'] / $n),
        'avg_aqi_so2'  => round($values['aqi_so2'] / $n),
        'avg_aqi_o3'   => round($values['aqi_o3'] / $n),
        'avg_aqi'      => round($values['aqi'] / $n),
    ];
}

// Return oldest to newest
$averaged_data = array_reverse($averaged_data);
header('Content-Type: application/json');
echo json_encode($averaged_data);



