<?php

session_start();

$to      = $_SESSION['email'];
$subject = 'Password Reset';
$message = 'garbledegook';
$headers = 'From: liftappsite' . "\r\n" . phpversion();

mail($to, $subject, $message, $headers);

header('Location: ./settings.php');