<?php

require '../core/init.php';

require '../Query/Query.php';

$foodId = $_GET['id'];

if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
} else {
	$user_id = $_GET['user_id'];
}

$query = new Query($mysqli);
$result = $query->table('foodData')->where('id', '=', $foodId)->execute();

$result = $result[0];

$success = $query->table('foods')->insert(array('user', 'name', 'calories', 'fat', 'carbs', 'protein'),
										  array($user_id, $result['name'], $result['calories'], $result['fat'], $result['carbohydrate'], $result['protein']))
								 ->execute();

if ($success) {
	$_SESSION['message'] = 'success';
	echo "Success";
} else {
	$_SESSION['message'] = 'failed';
	echo "Failure";
}

header("Location: ../index.php");


?>