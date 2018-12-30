<?php

require_once "./conf.php";
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

$stmt = $conn->prepare("SELECT * FROM data;");
$stmt->execute();

$data = [];
while ($row = $stmt->fetch()) {
	$obj = null;
	$obj->temperature = (double) $row['temperature'];
	$obj->humidity = (double) $row['humidity'];
	$obj->time = $row['time'];
	
	$data[] = $obj;
}

$conn = null;
$json = json_encode($data);
echo $json;

?>
