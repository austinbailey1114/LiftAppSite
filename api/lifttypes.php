<?php

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

//use prepared statements to prevent injection
if ($sql = mysqli_prepare($conn, "SELECT * FROM lifttypes WHERE user = ?")) {
	mysqli_stmt_bind_param($sql, 'i', $id);
	mysqli_stmt_execute($sql);
	$result = mysqli_stmt_get_result($sql);

	$lifttypes = array();
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$lifttypes[] = $row;        
    }
    echo json_encode($lifttypes);
}

mysqli_close($conn);
?>