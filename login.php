<?

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/loginstyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
</head>
<body>
	<div id="mainDiv">
		<h1>Sign in to LiftApp</h1>
		<form action="./performLogin.php" method="post">
			<input type="text" name="username" id="usernameInput" placeholder="Username">
			<input type="text" name="password" id="passwordInput" placeholder="Password">
			<button id="login">Login</button>
		</form>
	</div>

</body>
</html>