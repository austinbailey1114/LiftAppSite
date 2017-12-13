<?php


require '../core/credentials.php';
require 'Statement.php';

$search = $_GET['search'];
$search = str_replace("_", " ", $search);

$sql = "SELECT * FROM foodData WHERE MATCH(name) AGAINST(?) ORDER BY MATCH(name) AGAINST(?) DESC";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $search, $search);
$stmt->execute();

$result = $stmt->get_result();
$data = array();
while($row = $result->fetch_assoc()) {
	$data[] = $row;
}

echo json_encode($data);

?>
