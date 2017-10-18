<?
require './core/init.php';

session_start();

if (!isset($_SESSION['id'])) {
	header('Location: ./login.php');
} else if (time() - $_SESSION['created'] > 1800) {
	session_unset();
	session_destroy();
	header("Location: ./login.php");
}

$name = $_SESSION['name'];

/* use cURL to grab lifts */
$ch = curl_init();

//set options to lift.php, string, GET
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/lift.php?id=".$_SESSION['id']);
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

//create SESSION variable for liftTable.php
$_SESSION['userLifts'] = $lifts;


//update url to bodyweight.php
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/bodyweight.php?id=".$_SESSION['id']);

$bodyweights = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$bodyweights = json_decode(trim($bodyweights), true);

$_SESSION['userBodyweights'] = $bodyweights;

//update url to lifttypes.php
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/lifttypes.php?id=".$_SESSION['id']);

$lifttypes = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$lifttypes = json_decode(trim($lifttypes), true);

//update url to food.php
curl_setopt($ch, CURLOPT_URL, $url . "/LiftAppSite/api/food.php?id=".$_SESSION['id']);

$foodhistory = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$foodhistory = json_decode(trim($foodhistory), true);

if(count($foodhistory) > 0) {
	$foodhistory = array_reverse($foodhistory);
}

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
		<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
	</head>
	<body>
		<div id="topContainer">
			<div id="headerContainer">
				<h1 align="center" id = "mainTitle">Dashboard</h1>
				<img src="./images/hugeIcon.png" height="62" width="62" id="icon">

			</div>	
			<div id="abouttheapp">
			<a href="https://github.com/austinbailey1114/LiftAppSite" id="aboutLink"><h3>About</h3></a>
			<a href="https://github.com/austinbailey1114/iOS" id="appLink"><h3>The App</h3></a>
			</div>
			<div id="linksContainer">
				<a href="./logout.php"><h3 id="accountLink"><? echo $name; ?></h3></a>
				<img src="./images/userIcon.png" height="52" width="52" id="userIcon">
			</div>
		</div>
		<div id="dashboardDiv">
			<div id="container">
				<div class="lift">
					<div>
						<h2 align="center" id="liftProgressTitle">Your Lift Progress</h2>
						<form id="lifttableform" action="liftTable.php">
							<button id="lifttable">View as Table</button>
						</form>
					</div>
						<select name="chooseLift" id="chooseLiftToDisplay" onchange="buildliftChart()">
						<?php

							if (count($lifttypes) > 0) {
								foreach ($lifttypes as $lifttype) {
									$typestring = str_replace('_', ' ', $lifttype['name']);
									echo '<option value="'.$typestring.'">'.$typestring.'</option>';
								}
							} else {
								echo "<option value='null'>No Types Yet</option>";
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
							<div id="typeSelectDiv">
								<select id="lifttypes" onchange="fillType()">
								<?php

									if (count($lifttypes) > 0) {
										foreach ($lifttypes as $lifttype) {
										$typestring = str_replace('_', ' ', $lifttype['name']);
										echo '<option value="'.$typestring.'">'.$typestring.'</option>';
										}
									} else {
										echo "<option value='null'>No Types Yet</option>";
									}

									
								?>
							</select>
							</div>
						</div>
						<div id="addNewDate">
							<p id="promptDate">Date:</p>
							<script type="text/javascript">
								jQuery(function($){
								   $("#dateInput").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
								   
								});
							</script>
							<input type="test" name="date" id="dateInput" placeholder="leave blank if today" autocomplete="off">
						</div>
						<button id="saveLift">Save</button>
					</form>
				</div>
			</div>
			<div class="nutrition">
				<div id="showData">
					<?
						$calories = 0;
						$fat = 0;
						$carbs = 0;
						$protein = 0;
						if (count($foodhistory) > 0) {
							foreach ($foodhistory as $food) {
								# code...
								$calories += $food['calories'];
								$fat += $food['fat'];
								$carbs += $food['carbs'];
								$protein += $food['protein'];
							}
						}

						echo "<p id='displayCals'>Today's calories: ".$calories."</p>";
						echo "<p id='displayFat'>Today's fat: ".$fat."g</p>";
						echo "<p id='displayCarbs'>Today's carbs: ".$carbs."g</p>";
						echo "<p id='displayProtein'>Today's protein: ".$protein."g</p>";
					?>
				</div>
				<div id="newFood">
					<form id="searchFood" action="./search.php" method="post">
						<div id="enterfood">
							<h2 id="newFoodTitle">Search Foods: </h2>
							<input type="text" name="searchField" id="searchInput" placeholder="Food, brand, etc.">
						</div>
						<div id="foodbutton">
							<button id="search">Search</button>
						</div>
					</form>
				</div>
				<div id="foodHistoryContainer">
					<h3>Food Today</h3>
					<div id="foodHistory">
						<?php
							if(count($foodhistory) > 0) {
								foreach ($foodhistory as $food) {
									# code...
									echo "<p>" . $food['name'] . "</p>";
								}
							}
							else {
								echo "<p>No foods to display<p>";
							}
						?>
					</div>
				</div>
			</div>
			<div id="weightDiv">
				<div class="bodyweightGraph">
					<h2 id="bodyweighttabletitle">Bodyweight</h2>
						<form id="bodyweighttable" action="bodyweightTable.php">
							<button id="bodyweighttable">View as Table</button>
						</form>
					<div id ="bodyweightGraphDiv">
						<canvas id="bodyweightChart"></canvas>
					</div>
				</div>
				<div id="newWeight">
					<form action="./addWeight.php" method="post">
						<div id="promptBodyweight">
							<h2 id="weightTitle">Update: </h2>
							<input type="text" name="updateWeight" id="newBodyWeight" placeholder="pounds">
						</div>
						<div id="addBodyweightButtonDiv">
							<button id="add">Update</button>
						</div>
					</form>
				</div>
				
			</div>
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
			if(isset($_SESSION['message'])) {
				$message = $_SESSION['message'];
				?> 
					var message = <?php echo json_encode($message); ?>;
					if (message == "success") {
						swal('Item added successfully', '', 'success');
					}
					else if (message == "failed") {
						swal("Unable to add item. Please make sure your inputs are numbers", "", "warning");
					}
					else if(message == "deleteSuccess") {
						swal("Item deleted successfully", " ", "success");
					}

				
				<?
				unset($_SESSION['message']);
			} 

			if(isset($_GET["lift"])) {
				?>
					var liftGraphSelect = document.getElementById('chooseLiftToDisplay');
					liftGraphSelect.value = <?php echo json_encode($_GET['lift']); ?>;
					liftGraphSelect.text = <?php echo json_encode($_GET['lift']); ?>;
				<?
			} else {
				//lift isnt set
			}
		?>

		function fillType() {
			try {
				var type = document.getElementById("lifttypes");
    			var choice = type.options[type.selectedIndex].text;
    			if (choice != "No Types Yet") document.getElementById("typeInput").value = choice;
    			else document.getElementById('typeInput').value = "";
			}
			catch(err) {
				//document.getElementById("typeInput").value = "No Types";
			}
			
		}

		function checkInput(value, pid, reset) {
			if (isNaN(value)) {
				var prompt = document.getElementById(pid);
				prompt.innerHTML = "<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Invalid Input";
			} else {
				var prompt = document.getElementById(pid);
				prompt.textContent = reset;
			}
		}

		var repsInput = document.getElementById('repsInput');
		var weightInput = document.getElementById('weightInput');
		var bodyweightInput = document.getElementById('newBodyWeight');
		repsInput.addEventListener('input', function() { checkInput(repsInput.value, 'promptReps', 'Reps: '); }, false);
		weightInput.addEventListener('input', function() { checkInput(weightInput.value, 'promptWeight', 'Weight: '); }, false);
		bodyweightInput.addEventListener('input', function() { checkInput(bodyweightInput.value, 'weightTitle', 'Update: ')}, false);

		fillType();

	</script>
	<script type="text/javascript" src = "./js/buildgraph.js"></script>
</html>








