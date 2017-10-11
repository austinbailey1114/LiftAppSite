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
		$_SESSION['id'] = (int) $row['id'];
		var_dump("SELECT * FROM bodyweights WHERE user = {$_SESSION['id']}");
		var_dump("SELECT * FROM bodyweights WHERE user = 1");
		var_dump("SELECT * FROM bodyweights WHERE user = " . $_SESSION['id']);
		$id = $_SESSION['id'];
		var_dump("SELECT * FROM bodyweights WHERE user = $id");
		//exit();
		$_SESSION['name'] = $row['name'];
		$_SESSION['created'] = time();
		header("Location: ./index.php");
	}
} else {
	header("Location: ./login.php");
}


