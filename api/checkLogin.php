<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);

$name = $_POST['username'];
$pass = md5($_POST['password']);

//prepare sql statement with parameterized query
if ($sql = mysqli_prepare($conn, "SELECT id, name FROM users WHERE username = ? AND password = ?")) {
	mysqli_stmt_bind_param($sql, 'ss', $name, $pass);
	mysqli_stmt_execute($sql);
	mysqli_stmt_bind_result($sql, $id, $name);

	$returnData = array();
	while (mysqli_stmt_fetch($sql)) {
		$returnData['id'] = (int) $id;
		$returnData['name'] = $name;
		$returnData['created'] = time();
	}
	echo json_encode($returnData);
	mysqli_stmt_close($sql);
}

mysqli_close($conn);











