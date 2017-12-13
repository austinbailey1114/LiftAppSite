<?php

require "../core/credentials.php";
require '../core/init.php';
require "Statement.php";

$foodId = $_GET['id'];

$stmt = new Statement();
$result = $stmt->getData($mysqli, "SELECT * FROM foodData WHERE id = ?", $foodId);

$sql = "INSERT INTO foods (user, name, calories, fat, carbs, protein) VALUES
(?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

$result = $result[0];

$stmt->bind_param('isdddd', $_SESSION['id'], $result['name'], $result['calories'], $result['fat'], $result['carbohydrate'], $result['protein']);
$result = $stmt->execute();

header("Location: ../search.php");


?>