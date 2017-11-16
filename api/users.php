<?php

require '../core/credentials.php';
$user = $_GET['user'];

//user=1 filters out only your lifts

$stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
$stmt->bind_param('s', $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
	$result = array(
		'success' => true
	);
} else {
	$result = array(
		'success' => false
	);
}

echo json_encode($result);



