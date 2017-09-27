<?
require './core/init.php';
$name = "Austin Bailey";

$ch = curl_init();

$url1 = "https://api.nutritionix.com/v1_1/search/";
$url2 =  "?results=0%3A20&cal_min=0&cal_max=50000&fields=item_name%2Cbrand_name%2Citem_id%2Cbrand_id&appId=592ced70&appKey=4dcb7f7bd109b3975dd3bad0020b6f2a";

$searchInput = $_POST['searchField'];

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

if (count($foods) > 0) {
	foreach ($foods as $food) {
		# code...
		echo $food[0]['item_id'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/searchpagestyle.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
	<h2>Test</h2>
	<div id="topContainer">
		<h2>Search Results</h2>
	</div>
</body>
</html>