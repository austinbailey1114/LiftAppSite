<?php

require "../core/credentials.php";
require "../core/init.php";

$sql = "INSERT INTO foodData (name, serving_unit, serving_value, calories, fat, carbohydrate, protein) VALUES
(?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sdsdddd', $_POST['name'], $_POST['serving_unit'], $_POST['serving_value'], $_POST['calories'], $_POST['fat'], $_POST['carbohydrate'], $_POST['protein']);
$result = $stmt->execute();

echo json_encode($result);

