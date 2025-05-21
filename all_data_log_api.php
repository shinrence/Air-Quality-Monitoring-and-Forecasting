<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// PostgreSQL database credentials (same as your other API)
$host = "dpg-d0mr2al6ubrc73em1abg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "sensor_db_8z7o";
$user = "shinrence";
$password = "7FUE2kw8lqc0uExXXGeCcm0ABkFG6cGN";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select all data ordered by timestamp descending (latest first),
    // and add 8 hours to timestamp as adjusted_timestamp
    $stmt = $pdo->query("SELECT sensor_data.*, (timestamp + INTERVAL '8 hours') AS adjusted_timestamp FROM sensor_data ORDER BY timestamp DESC");
    $allData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($allData) {
        foreach ($allData as &$row) {
            if (isset($row['adjusted_timestamp'])) {
                $row['timestamp'] = $row['adjusted_timestamp'];
                unset($row['adjusted_timestamp']);
            }
        }
        echo json_encode($allData);
    } else {
        echo json_encode(["error" => "No data found"]);
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "DB Error: " . $e->getMessage()]);
}
?>

