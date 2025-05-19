<?php
$filename = 'prediction_8h.txt';

if (file_exists($filename)) {
    $json = file_get_contents($filename);
    header('Content-Type: application/json');
    echo $json;
} else {
    echo json_encode(["error" => "File not found"]);
}
?>