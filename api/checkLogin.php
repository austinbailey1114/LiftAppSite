<?php

require '../core/credentials.php';
require '../Query/Query.php';

$name = $_POST['username'];
$pass = md5($_POST['password']);

$query = new Query($mysqli);
//prepare sql statement with parameterized query
$result = $query->table('users')->select(array('id', 'name', 'email'))->where('username', '=', $name)->and_where('password', '=', $pass)->execute();

echo json_encode($result);














