<?

$name = $_POST['name'];
$newUsername = $_POST['username'];
$newPassword = md5($_POST['password']);

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

$sql = "INSERT INTO users (name, username, password)
VALUES ('$name', '$newUsername', '$newPassword')";

if (mysqli_query($conn, $sql)) {
	$sql = "SELECT * FROM users WHERE username = '$newUsername' AND password = '$newPassword'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$_SESSION['id'] = (int) $row['id'];
			$id = $_SESSION['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['created'] = time();
			mysqli_close($conn);
			header("Location: ./index.php");
			exit();
		}
	}
	header("Location: ./index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



