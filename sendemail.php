<?php

require './core/init.php';
require './Query/Query.php';

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$newPass = '';
for ($i=0; $i < 8; $i++) { 
	$newPass = $newPass . $chars[random_int(0, strlen($chars))];
}

var_dump($mysqli);

$query = new Query($mysqli);

var_dump($query);

$result = $query->table('users')->update(array('password'), array(md5($newPass)))->where('id', '=', $_SESSION['id'])->execute();

session_start();

$to      = $_SESSION['email'];
$subject = 'Password Reset';
$message = 'Your new password is: ' . $newPass;
$headers = 'From: liftappsite@austinmbailey.com';

mail($to, $subject, $message, $headers);

header('Location: ./settings.php');





