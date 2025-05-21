<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// PostgreSQL database credentials
$host = "dpg-d0mr2al6ubrc73em1abg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "sensor_db_8z7o";
$user = "shinrence";
$password = "7FUE2kw8lqc0uExXXGeCcm0ABkFG6cGN";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT sensor_data.*, (timestamp + INTERVAL '8 hours') AS timestamp FROM sensor_data ORDER BY timestamp DESC LIMIT 1");

    $latest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($latest) {
        echo json_encode($latest);
    } else {
        echo json_encode(["error" => "No data found"]);
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "DB Error: " . $e->getMessage()]);
}
?>
