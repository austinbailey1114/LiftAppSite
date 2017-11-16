<?php 
session_start();

$bodyweights = $_SESSION['userBodyweights'];
echo $_SESSION['message'];

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/liftTableStyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>		
	<h2 align="center">Bodyweight History</h2>
	<?php
		if (count($bodyweights) > 0) {
			echo "<table id='table'>";
			echo "<tr>";
			echo "<th>Weight</th>";
			echo "<th>Date</th>";
			echo "<th>Delete</th>";
			echo "</tr>";
			foreach ($bodyweights as $bodyweight) {
				echo "<tr>";
				echo "<td>".$bodyweight['weight']."</td>";
				echo "<td>".$bodyweight['date']."</td>";
				echo "<td><a href=api/deleteBodyweight.php?id=".$bodyweight['id']."><button>Delete</button></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	?>
</body>
<script type="text/javascript">
	$('table').hide().fadeIn(1000);
</script>
</html>


