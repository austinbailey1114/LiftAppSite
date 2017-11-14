<?php
	session_start();
	echo $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="sendemail.php">
		<button>Reset password</button>
	</form>
	
</body>
</html>

