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

//$user = array();

if (count($result) == 1) {
	while ($row = mysqli_fetch_assoc($result)) {
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['created'] = time();
		header("Location: ./index.php");
	}
} else {
	//header("Location: ./login.php");
	var_dump("test");
}

//header("Location: ./index.php");

