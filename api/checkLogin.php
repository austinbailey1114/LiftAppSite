<?php

require '../core/credentials.php';

$name = $_POST['username'];
$pass = md5($_POST['password']);

//prepare sql statement with parameterized query
$stmt = $mysqli->prepare("SELECT id, name, email FROM users WHERE username = ? AND password = ?");
$stmt->bind_param('ss', $name, $pass);
$stmt->execute();
//bind id, name, email to corresponding variables
$stmt->bind_result($id, $name, $email);

//build the JSON array
$returnData = array();
while ($stmt->fetch()) {
	$returnData['id'] = (int) $id;
	$returnData['name'] = $name;
	$returnData['created'] = time();
	$returnData['email'] = $email;
}

echo json_encode($returnData);














