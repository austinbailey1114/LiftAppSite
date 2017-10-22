<?

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/addFoodStyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
</head>
<body>
	<div>
		<form action="./createFood.php" method="post">
			<div id="nameDiv">
				<p id="nameP">Name</p>
				<input type="text" name="nameInput" id="nameInput">
			</div>
			<div id="servingDiv">
				<p id="servingP">Serving</p>
				<input type="text" name="servingInput" id="servingInput">
			</div>
			<div id="calsDiv">
				<p id="calsP">Calories</p>
				<input type="text" name="caloriesInput" id="caloriesInput">
			</div>
			<div id="fatDiv">
				<p id="fatP">Fat</p>
				<input type="text" name="fatInput" id="fatInput">
			</div>
			<div id="carbsDiv">
				<p id="carbsP">Carbs</p>
				<input type="text" name="carbsInput" id="carbsInput">
			</div>
			<div id="proteinDiv">
				<p id="proteinP">Protein</p>
				<input type="text" name="proteinInput" id="proteinInput">
			</div>
			<button>Add</button>
		</form>
	</div>
</body>
</html>