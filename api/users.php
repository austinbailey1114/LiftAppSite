<?

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

//user=1 filters out only your lifts
$sql = "SELECT username FROM users WHERE username = '".$_GET['user']. "'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  	$result = array(
  		'success' => true
  	);
} else {
    $result = array(
  		'success' => false
  	);
}

mysqli_close($conn);
echo json_encode($result);




