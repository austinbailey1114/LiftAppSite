<?php

require './core/init.php';

$serving = $_POST['servingInput'];
$serving_info = explode(" ", $serving);
$serving_unit = $serving_info[0];
$serving_value = $serving_info[1];

$foodData = array(
	'name' => $_POST['nameInput'],
	'serving_unit' => $serving_unit,
	'serving_value' => $serving_value,
	'calories' => $_POST['caloriesInput'],
	'fat' => $_POST['fatInput'],
	'carbohydrate' => $_POST['carbsInput'],
	'protein' => $_POST['proteinInput']
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . "/NutritionAPI/api/createFood.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($foodData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

echo $result;

header('Location: ./index.php');