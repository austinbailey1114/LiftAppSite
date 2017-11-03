<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

$sql = "DELETE FROM lifts WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
$_SESSION['message'] = 'deleteSuccess';

header("Location: ../index.php");

?>