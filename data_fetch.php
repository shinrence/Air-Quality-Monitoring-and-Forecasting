<?php
header('Content-Type: application/json');

$host = "dpg-d0mr2al6ubrc73em1abg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "sensor_db_8z7o";
$user = "shinrence";
$password = "7FUE2kw8lqc0uExXXGeCcm0ABkFG6cGN";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 5");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $rows
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
