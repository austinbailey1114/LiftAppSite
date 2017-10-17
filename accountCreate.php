<?

//write code to grab lift of usernames and check if taken 
//add js to check if input is taken/valid with input event listener

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
			<p>Username</p>
			<input type="text" name="username">
			<p>Password</p>
			<input type="text" name="password">
			<button>Create</button>
		</form>
	</div>
</body>
</html>