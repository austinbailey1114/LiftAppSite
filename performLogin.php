<?

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$name = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";

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
} else {
	mysqli_close($conn);
	session_unset();
	session_destroy();
	header("Location: ./login.php?message=failed");
	exit();
}

?>



