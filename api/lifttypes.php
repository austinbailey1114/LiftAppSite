<?php

require '../core/credentials.php';
require 'Statement.php';

//get id of user
$id = $_GET['id'];

//use Statement class to grab data
$statement = new Statement();
$lifttypes = $statement->getData($mysqli, "SELECT * FROM lifttypes WHERE user = ?", $id);
echo json_encode($lifttypes);
