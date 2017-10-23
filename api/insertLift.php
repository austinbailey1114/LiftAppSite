<?php

session_start();

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

$typeInput = str_replace(" ", "_", $_POST['type']);

//check if the user input type of lift is already saved
$sql = "SELECT * FROM lifttypes WHERE user = {$_POST['id']} AND name = '$typeInput'";
$result = mysqli_query($conn, $sql);

$check_array = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"] . " - weight: " . $row["weight"] . " - reps: " . $row["reps"] . "<br>";
        $check_array[] = $row["name"];

    }
} else {
    echo "0 results";
}

//if this is a new type for the user, add this to their lift types
if (!in_array($typeInput, $check_array)) {
	$sql = "INSERT INTO lifttypes (name, user)
	VALUES ('$typeInput', {$_POST['id']})";
	if (mysqli_query($conn, $sql)) {
    	echo "New record created successfully";
	} 
	else {
	    $message = 'failed';
	}
}

//insert the lift into lift history

if ($_POST['date'] != '') {
    $date = $_POST['date'];
    $date = date('Y-m-d', strtotime($date));
} else {
    $date = date("Y-m-d H:i:s");

}

if (!is_numeric($_POST['weight']) || !is_numeric($_POST['reps'])) {
    $message = 'failed';
}

$sql = "INSERT INTO lifts (weight, reps, type, user, date)
VALUES ({$_POST["weight"]}, {$_POST["reps"]}, '$typeInput', {$_POST['id']}, '$date')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    $_SESSION['message'] = 'success';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>