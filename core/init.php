<?php

//require '../Query/Query.php';

// Report all PHP errors (see changelog)
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

session_start();

if($_SERVER['SERVER_NAME'] == 'localhost') {
	$url = "localhost/liftappsite";
} else {
	$url = "https://" . $_SERVER['SERVER_NAME'] . '/projects/liftappsite';
}

