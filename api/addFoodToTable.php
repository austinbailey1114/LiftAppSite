<?php

require '../core/init.php';
require '../Query/Query.php';

$query = new Query($mysqli);

$success = $query->table('foodData')->insert(array('name', 'serving_unit', 'serving_value', 'calories', 'fat', 'carbohydrate', 'protein'),
								  array($_POST['name'], $_POST['serving_unit'], $_POST['serving_value'], $_POST['calories'], $_POST['fat'], $_POST['carbohydrate'], $_POST['protein']))
						->execute();

echo json_encode($success);

