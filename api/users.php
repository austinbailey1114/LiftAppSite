<?php

session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = $_GET['user'];

//user=1 filters out only your lifts
if ($sql = mysqli_prepare($conn, "SELECT username FROM users WHERE username = ?")) {
	mysqli_stmt_bind_param($sql, 's', $user);
	mysqli_stmt_execute($sql);
	$result = mysqli_stmt_store_result($sql);
	
	if (mysqli_stmt_num_rows($sql) > 0) {
		$result = array(
			'success' => true
		);
	} else {
		$result = array(
			'success' => false
		);
	}

	echo json_encode($result);
}

mysqli_close($conn);




