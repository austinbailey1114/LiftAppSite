<?

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
	
	function checkInput(value, id, reset) {
		var xhttp = new XMLHttpRequest();
		xhttp.open('POST', './api/users.php', false);
		xhttp.send();
		var users = JSON.parse(xhttp.responseText);
		if (arrayContains(value, users)) {
			var prompt = document.getElementById(id);
			prompt.innerHTML = "<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Username Taken"
		} else {
			var prompt = document.getElementById(id);
			prompt.textContent = reset;
		}
	}

	function arrayContains(username, takenUsernames) {
    	return (takenUsernames.indexOf(username) > -1);
	}

	var usernameInput = document.getElementById('usernameInput');
	usernameInput.addEventListener('input', function() { checkInput(usernameInput.value, 'promptUsername', 'Username: ')});
	
	





</script>
</html>