<?php

require '../core/credentials.php';
require 'Statement.php';

//get id of user
$id = $_GET['id'];

//use Statement class to get data
$statement = new Statement();
$lifts = $statement->getData($mysqli, "SELECT * FROM lifts WHERE user = ? ORDER BY date ASC", $id);
echo json_encode($lifts);

