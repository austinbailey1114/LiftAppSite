<?php

require '../core/credentials.php';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$weight = $_POST['weight'];
$id = $_POST['id'];

if ($sql = mysqli_prepare($conn, "INSERT INTO bodyweights (weight, user)
VALUES (?, ?)")) {
	mysqli_stmt_bind_param($sql, 'di', $weight, $id);
	mysqli_stmt_execute($sql);
	$result = mysqli_stmt_store_result($sql);
	var_dump($result);
	if ($result) {
		echo "New record created successfully";
	} else {
		echo "Error" . mysqli_stmt_error($sql);
	}
}

mysqli_close($conn);




