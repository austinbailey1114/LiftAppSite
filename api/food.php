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

//$sql = "SELECT * FROM foods WHERE user = 1";
$sql = "SELECT * FROM foods WHERE user = 1 AND date > CURDATE()";
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
echo json_encode($foodhistory);
?>