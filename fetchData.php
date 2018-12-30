<?php

require_once "./conf.php";
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

$stmt = $conn->prepare("SELECT * FROM data;");
$stmt->execute();

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
