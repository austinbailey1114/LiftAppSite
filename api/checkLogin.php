<?



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$name = $_POST['username'];
$pass = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";

$result = mysqli_query($conn, $sql);

$returnData = array();

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$returnData['id'] = (int) $row['id'];
		$returnData['name'] = $row['name'];
		$returnData['created'] = time();
		mysqli_close($conn);
	}
} else {
	$returnData['id'] = null;
	mysqli_close($conn);
}

echo json_encode($returnData);
