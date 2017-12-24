<?php

require '../core/init.php';
require '../Query/Query.php';
//$id variable for this user
$id = $_GET['id'];

//build new statement to fetch users bodyweight data
$query = new Query($mysqli);
$bodyweights = $query->table('bodyweights')->where('user', '=', $id)->execute();
echo json_encode($bodyweights);

?>