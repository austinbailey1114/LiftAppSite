<?php

require '../core/credentials.php';
require 'Statement.php';

//$id variable for this user
$id = $_GET['id'];

//build new statement to fetch users bodyweight data
$statement = new Statement();
$bodyweights = $statement->getData($mysqli, "SELECT * FROM bodyweights WHERE user = ?", $id);
echo json_encode($bodyweights);


?>