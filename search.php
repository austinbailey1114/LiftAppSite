<?php
require './core/init.php';
$name = "Austin Bailey";

$ch = curl_init();

$url1 = $url . "/api/searchFood.php?search=";
$url2 =  "&api_key=1";

$searchInput = str_replace(" ", "_", $_POST['searchField']);

$searchURL = $url1 . $searchInput . $url2;

curl_setopt($ch, CURLOPT_URL, $searchURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$foods = curl_exec($ch);
curl_close ($ch);

$foods = json_decode(trim($foods), true);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/searchpagestyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
	<div id="topContainer">
		<h2>Search Results for '<?php echo htmlspecialchars($_POST['searchField']); ?>'</h2>
	</div>
	<p id="newFoodLink"><a href="./addNewFood.php">Not seeing your food? Add one here</a></p>
	<div id='results'>
			<?php
			if (count($foods) > 0) {
				echo "<table id='resultsTable'>
					<tr>
						<th>Name</th>
						<th>Calories</th>
						<th>Fat</th>
						<th>Carbs</th>
						<th>Protein</th>
						<th>Serving</th>
						<th>Add</th>
					</tr>";
				foreach ($foods as $food) {
					# code...
					echo '<tr>';
					echo '<td>'.$food['name'].'</td>';
					echo '<td>'.$food['calories'].'</td>';
					echo '<td>'.$food['fat'].'</td>';
					echo '<td>'.$food['carbohydrate'].'</td>';
					echo '<td>'.$food['protein'].'</td>';
					echo '<td>'.$food['serving_unit']. " " . $food['serving_value'].'</td>';
					echo '<td><a href=./api/addFoodToHistory.php?id='.$food['id'].'><button>Add</button></a></td>';					
					echo '</tr>';
				}
				echo "</table>";
			} else {
				echo "<h2>No results</h2>";
			}
				
			?>
	</div>
</body>
</html>


















