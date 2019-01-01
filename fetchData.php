<?php

header('Content-type: application/json');

require_once "./conf.php";
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

$nowDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$nextDate = date('Y-m-d', strtotime($nowDate.'+1 day'));

$stmt = $conn->prepare("SELECT * FROM data WHERE time >= ? AND time < ?;");
$stmt->execute([
	$nowDate,
	$nextDate
]);

$data = [];
while ($row = $stmt->fetch()) {
	$data[] = [
		"temperature" => (double) $row['temperature'],
		"humidity" => (double) $row['humidity'],
		"time" => $row['time']
	];
}

$conn = null;
$json = json_encode($data);
echo $json;

?>
