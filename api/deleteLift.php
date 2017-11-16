<?php

require '../core/credentials.php';
require 'Statement.php';

$id = $_GET['id'];



$statement = new Statement();
$result = $statement->deleteData($mysqli, "DELETE FROM lifts WHERE id = $id", $id);
echo $result;
if ($result) {
	$_SESSION['message'] = 'deleteSuccess';
} else {
	$_SESSION['message'] = 'deleteFailure';
}
header("Location: ../index.php");





