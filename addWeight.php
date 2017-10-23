<?php

$url = 'localhost';

session_start();

if (!is_numeric($_POST['updateWeight'])) {
	$_SESSION['message'] = 'failed';
}

$data = array(
	'weight' => $_POST['updateWeight'],
	'id' => $_SESSION['id']
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/insertBodyweight.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
echo $result;

header("Location: ./index.php");
?>