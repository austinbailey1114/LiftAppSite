<?php

session_start();

$lifts = $_SESSION['userLifts'];

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/liftTableStyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
	<div id="topContainer">
		<h2 align="center">Lift History</h2>
	</div>
	<div id="table">
		<table id="liftTable">
			<tr>
				<th>Type</th>
				<th>Weight</th>
				<th>Reps</th>
				<th>Date</th>
			</tr>
			<?php
			foreach ($lifts as $lift) {
				# code...
				echo "<tr>";
				echo "<th>".$lift['type']."</th>";
				echo "<th>".$lift['weight']."</th>";
				echo "<th>".$lift['reps']."</th>";
				echo "<th>".$lift['date']."</th>";
				echo "</tr>";
			}
			?>
		</table>
	</div>


</body>
</html>