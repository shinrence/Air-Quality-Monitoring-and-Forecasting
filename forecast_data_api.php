<?php
$filename = 'prediction_8h.json';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    
    if ($inputJSON) {
        $data = json_decode($inputJSON, true);
        if ($data !== null) {
            $result = file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
            if ($result !== false) {
                echo json_encode(["status" => "success", "message" => "Prediction saved"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to write file"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Invalid JSON"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "No input received"]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "No prediction data found"]);
    }
    exit;
}

// Unsupported HTTP method
http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
?>

