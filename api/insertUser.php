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

if ($sql = mysqli_prepare($conn, "INSERT INTO users (name, username, password) 
	VALUES (?, ?, ?)")) {

	mysqli_stmt_bind_param($sql, 'sss', $name, $newUsername, $newPassword);
	mysqli_stmt_execute($sql);
	$result = mysqli_stmt_store_result($sql);
	if ($result) {
		if ($sql = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND password = ?")) {
			mysqli_stmt_bind_param($sql, 'ss', $newUsername, $newPassword);
			mysqli_stmt_execute($sql);
			$result = mysqli_stmt_get_result($sql);

			$returnData = array();
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$returnData['id'] = (int) $row['id'];
				$returnData['name'] = $row['name'];
				$returnData['created'] = time();
			}
			echo json_encode($returnData);
		}
	}
}

mysqli_close($conn);











