<?
require './core/init.php';
$name = "Austin Bailey";

$ch = curl_init();

$url1 = "https://api.nutritionix.com/v1_1/search/";
$url2 =  "?results=0%3A20&cal_min=0&cal_max=50000&fields=item_name%2Cbrand_name%2Citem_id%2Cbrand_id&appId=592ced70&appKey=4dcb7f7bd109b3975dd3bad0020b6f2a";

$searchInput = str_replace(" ", "_", $_POST['searchField']);

$searchURL = $url1 . $searchInput . $url2;

curl_setopt($ch, CURLOPT_URL, $searchURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$foods = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$foods = json_decode(trim($foods), true);

$foods = $foods['hits'];

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
		<h2>Search Results</h2>
	</div>
	<div id='results'>
		<table>
			<tr>
				<th>Brand</th>
				<th>Description</th>
				<th>Serving</th>
			</tr>
			<?php
				foreach ($foods as $food) {
					# code...
					echo '<tr>';
					echo '<td>'.$food['fields']['brand_name'].'</td>';
					echo '<td>'.$food['fields']['item_name'].'</td>';
					echo '<td>'.$food['fields']['nf_serving_size_qty']. " " . $food['fields']['nf_serving_size_unit'].'</td>';					
					echo '</tr>';
				}
			?>
		</table>
	</div>
</body>
</html>


















