<?php

require '../core/credentials.php';
require 'Statement.php';

//$id variable for this user
$id = $_GET['id'];

//build new statement to fetch users food data
$statement = new Statement();
$foods = $statement->getData($mysqli, "SELECT * FROM foods WHERE user = ? AND date > CURDATE()", $id);
echo json_encode($foods);

