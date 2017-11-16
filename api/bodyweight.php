<?php

require '../core/credentials.php';
require 'Statement.php';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

//build new statement to fetch users bodyweight data
$statement = new Statement();
$bodyweights = $statement->getData($mysqli, "SELECT * FROM bodyweights WHERE user = ?", $id);
echo json_encode($bodyweights);


?>