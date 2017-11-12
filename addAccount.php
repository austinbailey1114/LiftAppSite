<?php
require './core/init.php';

$ch = curl_init();

$data = array(
	'name' => $_POST['name'],
	'username' => $_POST['username'],
	'password' => $_POST['password']
);

curl_setopt($ch, CURLOPT_URL, $url . "/api/insertUser.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

$result = json_decode(trim($result), true);

echo json_encode($result);

if ($result['id'] != null) {
	$_SESSION['id'] = $result['id'];
	$_SESSION['name'] = $result['name'];
	$_SESSION['created'] = $result['created'];
	header("Location: ./index.php");
}
else {
	header("Location: ./login.php?message=failed");
}


