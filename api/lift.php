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

//user=1 filters out only your lifts
if(isset($_POST['chooseLiftToDisplay'])) {
    $values = $_POST['chooseLiftToDisplay'];
     // or $_GET['category'] if your form method was GET
}
else {
	$values = "pull ups";
}
$sql = "SELECT * FROM lifts WHERE user = 1 AND type= 2";
$result = mysqli_query($conn, $sql);

$lifts = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"] . " - weight: " . $row["weight"] . " - reps: " . $row["reps"] . "<br>";
        $lifts[] = $row;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
echo json_encode($lifts);
//test comment to see if this stays
?>

