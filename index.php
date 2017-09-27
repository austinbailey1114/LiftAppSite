<?
require './core/init.php';
$name = "Austin Bailey";


/* use cURL to grab lifts */
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/lift.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$lifts = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$lifts = json_decode(trim($lifts), true);

/*use cURL to grab bodyweights*/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/bodyweight.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$bodyweights = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$bodyweights = json_decode(trim($bodyweights), true);

/*get lifttypes for user*/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/lifttypes.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$lifttypes = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$lifttypes = json_decode(trim($lifttypes), true);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	</head>
	<body>
		<div id="topContainer">
			<div id="headerContainer">
				<h1 align="center" id = "mainTitle">Dashboard</h1>
				<img src="./images/hugeIcon.png" height="62" width="62" id="icon">

			</div>	
			<div id="linksContainer">
				<a href="https://www.google.com/" id="accountLink"><? echo $name; ?></a>
				<img src="./images/userIcon.png" height="52" width="52" id="userIcon">
			</div>
		</div>
		<div id="dashboardDiv">
			<div id="container">
				<div class="lift">
					<h2 align="center">Lift Progress</h2>
						<select name="chooseLift" id="chooseLiftToDisplay" onchange="rebuildGraph()">
							<option selected="selected">Test</option>
						<?php
							
							foreach ($lifttypes as $lifttype) {
								$typestring = str_replace('_', ' ', $lifttype['name']);
								echo '<option   value="'.$typestring.'">'.$typestring.'</option>';
							}
						?>
						</select>
					<div id ="graphDiv">
						<canvas id="myChart"></canvas>
					</div>
				</div>
				<div id="newLiftContainer">
					<form action="./addLift.php" method="post">
						<div id="addNewWeight">
							<p id="promptWeight">Weight: </p>
							<input type="text" name="weight" id="weightInput" placeholder="pounds">
						</div>
						<div id="addNewReps">
							<p id="promptReps">Reps:</p>
							<input type="text" name="reps" id="repsInput" placeholder="repetitions">
						</div>
						<div id="addNewType">
							<p id="promptType">Type:</p>
							<input type="text" name="type" id="typeInput" placeholder="type">
						</div>
						<div id="addNewDate">
							<p id="promptDate">Date:</p>
							<input type="test" name="date" id="dateInput" placeholder="date">
						</div>
						<button id="saveLift">Save</button>
					</form>
				</div>
			</div>
			<div class="nutrition">
				<div id="showData">
					<h2>Your food intake today</h2>
					<p>Today's calories: 2341</p>
					<p>Today's fat: 41g</p>
					<p>Today's carbs: 123g</p>
					<p>Today's protein: 111g</p>
				</div>
				<div id="newFood">
					<h2>Search Nutritionix API</h2>
					<input type="text" name="searchField" id="searchInput" placeholder="Food, brand, etc.">
					<button id="search">Search</button>
				</div>
			</div>
			<div id="weightDiv">
				<div class="bodyweightGraph">
					<h2>Bodyweight Graph</h2>
					<div id ="bodyweightGraphDiv">
						<canvas id="bodyweightChart"></canvas>
					</div>
				</div>
				<div id="newWeight">
					<form action="./addWeight.php" method="post">
						<h2>Update bodyweight</h2>
						<input type="text" name="updateWeight" id="newBodyWeight" placeholder="pounds">
						<button id="add">Update</button>
					</form>
				</div>
				
			</div>
		</div>
		<div id="menuDiv">
			<a href="https://www.google.com/">The App</a>
			<a href="https://www.google.com/">About</a>
			<a href="https://www.google.com/">Options</a>
		</div>
	</body>
	<script type="text/javascript">
		<?
			$liftxaxis = array();
			$liftyaxis = array();
			$types = array();

			if (isset($_POST['chooseLift'])) {
				$value = $_POST['chooseLift'];
			}
			else {
				$value = 1;
			}

			foreach ($lifts as $lift) {
				$date = strtotime($lift["date"]);
				$liftxaxis[] = date("m-d", $date);

				$weight = $lift["weight"];
				$reps = $lift["reps"];
				$onerepmax = $weight * (1 + ($reps/30));
				$liftyaxis[] = $onerepmax;

				$types[] = $lift["type"];
			}

			$weightxaxis = array();
			$weightyaxis = array();

			foreach ($bodyweights as $bodyweight) {
				$date = strtotime($bodyweight["date"]);
				$weightxaxis[] = date("m-d", $date);
				$weightyaxis[] = $bodyweight["weight"];
			}
		
		?>

		function rebuildGraph() {
			//need to figure this out
			buildliftChart();
		}

		var liftxaxis= <?php echo json_encode($liftxaxis); ?>;
		var liftyaxis= <?php echo json_encode($liftyaxis); ?>;
		var types = <?php echo json_encode($types); ?>;
		var weightxaxis = <?php echo json_encode($weightxaxis); ?>;
		var weightyaxis = <?php echo json_encode($weightyaxis); ?>;
	</script>
	<script type="text/javascript" src = "./js/buildgraph.js"></script>
</html>








