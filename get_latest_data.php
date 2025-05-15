<?php
$filename = 'latest_data.txt';
$data = [];

// Read latest data
if (file_exists($filename)) {
    $json = file_get_contents($filename);
    $data = json_decode($json, true);
}

// Database connection and insert
if (!empty($data)) {
    $host = "localhost";
    $dbname = "sensor_db";
    $username = "root"; // default username
    $password = "";     // no password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Optional: Check for duplicate before inserting (same timestamp/value)
        $stmt = $pdo->prepare("
            INSERT INTO sensor_data 
            (temp, hum, ch4, co, h2, o3, pm1, pm25, pm10, timestamp) 
            VALUES (:temp, :hum, :ch4, :co, :h2, :o3, :pm1, :pm25, :pm10, NOW())
        ");

        $stmt->execute([
            ':temp'   => $data['TEMP'],
            ':hum'    => $data['HUM'],
            ':ch4'    => $data['CH4'],
            ':co'     => $data['CO'],
            ':h2'     => $data['H2'],
            ':o3'     => $data['O3'],
            ':pm1'    => $data['PM1'],
            ':pm25'   => $data['PM25'],
            ':pm10'   => $data['PM10']
        ]);

    } catch (PDOException $e) {
        echo "❌ Database Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="10">
    <title>Latest Sensor Data</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-bottom: 10px; }
        .sensor { margin: 5px 0; }
    </style>
</head>
<body>
    <h2>📊 Latest Sensor Data</h2>

    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $key => $value) : ?>
            <div class="sensor"><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No data available.</p>
    <?php endif; ?>
</body>
</html>

