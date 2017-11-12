<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

if ($sql = mysqli_prepare($conn, "DELETE FROM lifts WHERE id = $id")) {
	mysqli_stmt_bind_param($sql, 'i', $id);
	mysqli_stmt_execute($sql);
	$result = mysqli_stmt_store_result($sql);
	if ($result) {
		$_SESSION['message'] = 'deleteSuccess';
		echo "Record deleted successfully";
	} else {
		//delete failed
		echo "Error deleting record: " . mysqli_stmt_error($sql);
	}
}
mysqli_close($conn);
header("Location: ../index.php");

?>




