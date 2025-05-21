<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Set timezone
date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $raw_data = $_POST['data'];
    parse_str($raw_data, $parsed_data);

    // PostgreSQL database config
    $host = "dpg-d0mr2al6ubrc73em1abg-a.oregon-postgres.render.com"; // external host
    $port = "5432";
    $dbname = "sensor_db_8z7o";
    $user = "shinrence";
    $password = "7FUE2kw8lqc0uExXXGeCcm0ABkFG6cGN";

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("
            INSERT INTO sensor_data 
            (temp, hum, ch4, co, h2, o3, pm1, pm25, pm10, timestamp) 
            VALUES (:temp, :hum, :ch4, :co, :h2, :o3, :pm1, :pm25, :pm10, NOW())
        ");

        $stmt->execute([
            ':temp' => $parsed_data['TEMP'],
            ':hum' => $parsed_data['HUM'],
            ':ch4' => $parsed_data['CH4'],
            ':co'  => $parsed_data['CO'],
            ':h2'  => $parsed_data['H2'],
            ':o3'  => $parsed_data['O3'],
            ':pm1' => $parsed_data['PM1'],
            ':pm25'=> $parsed_data['PM25'],
            ':pm10'=> $parsed_data['PM10']
        ]);

        echo json_encode(["success" => true, "message" => "✅ Data saved to database."]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "❌ DB Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "🌐 Awaiting data from ESP8266 via POST..."]);
}
?>
