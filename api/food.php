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

$sql = "SELECT * FROM foods WHERE user = 1";
$result = mysqli_query($conn, $sql);

$foodhistory = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $foodhistory[] = $row;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
/*$conn = mysqli_connect($servername, $username, $password, $dbname);


$sql = "SELECT * FROM foods WHERE user = 1 AND date > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY score DESC";
$result = mysqli_query($conn, $sql);

$todaysfoods = array();

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$todaysfoods[] = $row;
	}
} else {
	echo "0 results";
}

mysqli_close($conn);*/
echo json_encode($foodhistory);
//echo json_encode($todaysfoods);
?>