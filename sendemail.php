<?php

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$newPass = '';
for ($i=0; $i < 8; $i++) { 
	$newPass = $newPass . $chars[random_int(0, strlen($chars))];
}

echo $newPass;

session_start();

$to      = $_SESSION['email'];
$subject = 'Password Reset';
$message = 'Your new password is: ' . $newPass;
$headers = 'From: liftappsite@austinmbailey.com';

mail($to, $subject, $message, $headers);

header('Location: ./settings.php');





