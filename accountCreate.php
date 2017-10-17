<?

//write code to grab lift of usernames and check if taken 
//add js to check if input is taken/valid with input event listener

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

$sql = "SELECT username FROM users";

$result = mysqli_query($conn, $sql);

$usernames = array();

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$usernames[] = $row['username'];
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/accountcreatestyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div>
		<form action="addAccount.php" method="post">
			<p>Name</p>
			<input type="text" name="name">
			<p id='promptUsername'>Username</p>
			<input type="text" name="username" id='usernameInput'>
			<p>Password</p>
			<input type="text" name="password">
			<button>Create</button>
		</form>
	</div>
</body>
<script type="text/javascript">

	var usernames = <?php echo json_encode($usernames, true); ?>;
	
	function checkInput(value, id, reset) {
		if (usernameContains(value)) {
			var prompt = document.getElementById(id);
			prompt.innerHTML = "<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Username Taken"
		} else {
			var prompt = document.getElementById(id);
			prompt.textContent = reset;
		}
	}

	function usernameContains(value) {
		return usernames.indexOf(value) > -1;
	}

	var usernameInput = document.getElementById('usernameInput');
	usernameInput.addEventListener('input', function() { checkInput(usernameInput.value, 'promptUsername', 'Username: ')});





</script>
</html>