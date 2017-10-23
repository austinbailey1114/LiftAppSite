<?

$name = $_POST['name'];
$newUsername = $_POST['username'];
$newPassword = md5($_POST['password']);

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

$sql = "INSERT INTO users (name, username, password)
VALUES ('$name', '$newUsername', '$newPassword')";

$returnData = array();

if (mysqli_query($conn, $sql)) {
	$sql = "SELECT * FROM users WHERE username = '$newUsername' AND password = '$newPassword'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$returnData['id'] = (int) $row['id'];
			$returnData['name'] = $row['name'];
			$returnData['created'] = time();
		}
	}
} else {
	$returnData['id'] = null;
}

echo json_encode($returnData);











