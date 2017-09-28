<?
require './core/init.php';
$name = "Austin Bailey";


/* use cURL to grab lifts */
$ch = curl_init();

//set options to lift.php, string, GET
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

$lifts = json_decode(trim($lifts), true);

//update url to bodyweight.php
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/bodyweight.php");

$bodyweights = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$bodyweights = json_decode(trim($bodyweights), true);

//update url to lifttypes.php
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/lifttypes.php");

$lifttypes = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$lifttypes = json_decode(trim($lifttypes), true);

//build arrays with the GET data to make graphs
$liftxaxis = array();
$liftyaxis = array();
$types = array();

if (count($lifts) > 0) {
	foreach ($lifts as $lift) {
		$date = strtotime($lift["date"]);
		$liftxaxis[] = date("n/j", $date);

		$weight = $lift["weight"];
		$reps = $lift["reps"];
		$onerepmax = $weight * (1 + ($reps/30));
		$liftyaxis[] = $onerepmax;

		$types[] = $lift["type"];
	}
}

$weightxaxis = array();
$weightyaxis = array();

if (count($bodyweights) > 0) {
	foreach ($bodyweights as $bodyweight) {
		$date = strtotime($bodyweight["date"]);
		$weightxaxis[] = date("m-d", $date);
		$weightyaxis[] = $bodyweight["weight"];
	}
}

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
					<h2 align="center">Your Lift Progress</h2>
						<select name="chooseLift" id="chooseLiftToDisplay" onchange="buildliftChart()">
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
							<input type="text" name="weight" id="weightInput" placeholder="pounds" autocomplete="off">
						</div>
						<div id="addNewReps">
							<p id="promptReps">Reps:</p>
							<input type="text" name="reps" id="repsInput" placeholder="repetitions" autocomplete="off">
						</div>
						<div id="addNewType">
							<p id="promptType">Type:</p>
							<input type="text" name="type" id="typeInput" placeholder="type" list = "lifttypes" autocomplete="off">
							<datalist id="lifttypes">
								<?php
								foreach ($lifttypes as $lifttype) {
									$typestring = str_replace('_', ' ', $lifttype['name']);
									echo '<option   value="'.$typestring.'">';
								}
								?>
							</datalist>
						</div>
						<div id="addNewDate">
							<p id="promptDate">Date:</p>
							<input type="test" name="date" id="dateInput" placeholder="date" autocomplete="off">
						</div>
						<button id="saveLift">Save</button>
					</form>
				</div>
			</div>
			<div class="nutrition">
				<div id="showData">
					<p id="displayCals">Today's calories: 2341</p>
					<p id="displayFat">Today's fat: 41g</p>
					<p id="displayCarbs">Today's carbs: 123g</p>
					<p id="displayProtein">Today's protein: 111g</p>
				</div>
				<div id="newFood">
					<h2>Search Nutritionix API</h2>
					<form action="./search.php" method="post">
						<input type="text" name="searchField" id="searchInput" placeholder="Food, brand, etc.">
						<button id="search">Search</button>
					</form>
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
		//convert php arrays to javascript arrays
		var liftxaxis= <?php echo json_encode($liftxaxis); ?>;
		var liftyaxis= <?php echo json_encode($liftyaxis); ?>;
		var types = <?php echo json_encode($types); ?>;
		var weightxaxis = <?php echo json_encode($weightxaxis); ?>;
		var weightyaxis = <?php echo json_encode($weightyaxis); ?>;

		<?
			$isMessage = isset($_GET['message']);
		?>

		var message = <?php echo $isMessage; ?>;

		if (message) {
			alert('Item saved successfully');
		}




	</script>
	<script type="text/javascript" src = "./js/buildgraph.js"></script>
</html>








