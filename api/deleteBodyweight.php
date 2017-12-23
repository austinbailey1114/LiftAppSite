<?php

require '../core/credentials.php';
require 'Statement.php';

//get user id
$id = $_GET['id'];

//delete data using statement class
$statement = new Statement();
$result = $statement->deleteData($mysqli, "DELETE FROM bodyweights WHERE id = ?", $id);
echo $result;
if ($result) {
	$_SESSION['message'] = 'deleteSuccess';
} else {
	$_SESSION['message'] = 'deleteFailure';
}
header("Location: ../index.php");


