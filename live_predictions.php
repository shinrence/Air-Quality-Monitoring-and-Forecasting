<?php
$filename = 'prediction_8h.txt';

if (!file_exists($filename)) {
    echo json_encode(['error' => 'File not found']);
    exit;
}

$data = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$predictions = [];
$entry = [];

foreach ($data as $line) {
    $line = trim($line);
    
    if (strpos($line, 'Timestamp:') === 0) {
        $entry = ['timestamp' => trim(substr($line, 10))];
    } elseif (strpos($line, 'Hour:') === 0) {
        $entry['hour'] = trim(substr($line, 5));
    } elseif (strpos($line, '----') === 0) {
        $predictions[] = $entry;
    } else {
        // Parse pollutant line
        [$key, $value] = explode(':', $line);
        $entry[trim($key)] = floatval(trim($value));
    }
}

header('Content-Type: application/json');
echo json_encode($predictions);
?>



