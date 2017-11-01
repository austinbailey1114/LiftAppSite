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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="topContainer">
		<h2 align="center">Lift History</h2>
	</div>
	<table id="table">
		<tr>
			<th>Type</th>
			<th>Weight</th>
			<th>Reps</th>
			<th>Date</th>
			<th></th>
		</tr>
		<?php
		foreach ($lifts as $lift) {
			# code...
			echo "<tr>";
			echo "<td>".str_replace("_", " ", $lift['type'])."</td>";
			echo "<td>".$lift['weight']."</td>";
			echo "<td>".$lift['reps']."</td>";
			echo "<td>".$lift['date']."</td>";
			echo "<td><a href=deleteLift.php?id=".$lift['id']."><button>Delete</button></a></td>";
			echo "</tr>";
		}
		?>
	</table>
</body>
<script type="text/javascript">

	$('table').hide().fadeIn(1000);	

</script>
</html>