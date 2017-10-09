<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$header = "Location: ./index.php?message=success";

if (!is_numeric($_POST['updateWeight'])) {
	$header = "Location: ./index.php?message=weightFailed";
}

$sql = "INSERT INTO bodyweights (weight, user)
VALUES ({$_POST["updateWeight"]}, 1)";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header($header);
?>