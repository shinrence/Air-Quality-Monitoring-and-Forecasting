<?php
$filename = 'all_data_log.txt';

// Check if file exists
if (!file_exists($filename)) {
    http_response_code(500);
    echo json_encode(['error' => 'Data file not found.']);
    exit;
}

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$data_by_hour = [];

foreach ($lines as $line) {
    $entry = json_decode($line, true);
    if (!$entry || !isset($entry['timestamp'])) continue;

    // Check that all required keys exist
    $required_keys = ['TEMP', 'HUM', 'CH4', 'CO', 'H2', 'O3', 'PM25', 'PM10'];
    $missing = false;
    foreach ($required_keys as $key) {
        if (!isset($entry[$key])) {
            $missing = true;
            break;
        }
    }
    if ($missing) continue;

    // Get hour key
    $hour = date('Y-m-d H:00:00', strtotime($entry['timestamp']));

    if (!isset($data_by_hour[$hour])) {
        $data_by_hour[$hour] = [
            'count' => 0,
            'temp' => 0, 'hum' => 0, 'ch4' => 0, 'co' => 0,
            'so2' => 0, 'o3' => 0, 'pm25' => 0, 'pm10' => 0
        ];
    }

    $data_by_hour[$hour]['count']++;
    $data_by_hour[$hour]['temp'] += floatval($entry['TEMP']);
    $data_by_hour[$hour]['hum']  += floatval($entry['HUM']);
    $data_by_hour[$hour]['ch4']  += floatval($entry['CH4']);
    $data_by_hour[$hour]['co']   += floatval($entry['CO']);
    $data_by_hour[$hour]['so2']  += floatval($entry['H2']); // H2 as SO2
    $data_by_hour[$hour]['o3']   += floatval($entry['O3']);
    $data_by_hour[$hour]['pm25'] += floatval($entry['PM25']);
    $data_by_hour[$hour]['pm10'] += floatval($entry['PM10']);
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
        'avg_temp' => round($values['temp'] / $n, 2),
        'avg_hum' => round($values['hum'] / $n, 2),
        'avg_ch4' => round($values['ch4'] / $n, 2),
        'avg_co' => round($values['co'] / $n, 2),
        'avg_so2' => round($values['so2'] / $n, 2),
        'avg_o3' => round($values['o3'] / $n, 2),
        'avg_pm25' => round($values['pm25'] / $n, 2),
        'avg_pm10' => round($values['pm10'] / $n, 2),
    ];
}

// Return oldest to newest
$averaged_data = array_reverse($averaged_data);
header('Content-Type: application/json');
echo json_encode($averaged_data);

