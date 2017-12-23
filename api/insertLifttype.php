<?php

require "../core/credentials.php";
require '../core/init.php';

$user_id = $_POST['id'];
$name = $_POST['name']

$sql = "INSERT INTO lifttypes (user, name) VALUES (?, ?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('is', $user_id, $name);

if ($stmt->execute()) {
	echo "New liftype created successfully";
} else {
	echo "Could not save lift type";
}

?>
