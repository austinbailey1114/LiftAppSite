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
$sql = "SELECT * FROM lifttypes WHERE user = {$_GET['id']}";
$result = mysqli_query($conn, $sql);

$lifttypes = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $lifttypes[] = $row;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
echo json_encode($lifttypes);
//test comment to see if this stays
?>