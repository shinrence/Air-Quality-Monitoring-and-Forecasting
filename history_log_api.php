<?php
$filename = 'all_data_log.txt';

// Check if the file exists
if (!file_exists($filename)) {
    http_response_code(500);
    echo json_encode(['error' => 'Data file not found.']);
    exit;
}

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$all_entries = [];

foreach ($lines as $line) {
    $entry = json_decode($line, true);
    if ($entry && isset($entry['timestamp'])) {
        $all_entries[] = $entry;
    }
}

// Sort by timestamp ascending (optional)
usort($all_entries, function($a, $b) {
    return strtotime($a['timestamp']) <=> strtotime($b['timestamp']);
});

header('Content-Type: application/json');
echo json_encode($all_entries);
