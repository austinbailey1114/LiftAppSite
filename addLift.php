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

$typeinput = str_replace(' ', '_', $_POST['type']);

//check if the user input type of lift is already saved
$sql = "SELECT * FROM lifttypes WHERE user = 1 AND name = '$typeinput'";
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
if (!in_array($typeinput, $check_array)) {
	$sql = "INSERT INTO lifttypes (name, user)
	VALUES ('$typeinput', 1)";
	if (mysqli_query($conn, $sql)) {
    	echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

//insert the lift into lift history
$sql = "INSERT INTO lifts (weight, reps, type, user)
VALUES ({$_POST["weight"]}, {$_POST["reps"]}, '$typeinput', 1)";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
header("Location: ./index.php?lift=".$typeinput);
?>