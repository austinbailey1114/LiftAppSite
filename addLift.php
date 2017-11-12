<?php

require './core/init.php';

session_start();

if (isset($_POST['type'])) {
    $typeinput = $_POST['type'];
} else {
    $typeinput = $_POST['lifttypes'];
}

$ch = curl_init();

$liftData = array(
    'weight' => $_POST['weight'],
    'reps' => $_POST['reps'],
    'type' => $typeinput,
    'date' => $_POST['date'],
    'id' => $_SESSION['id']
);

curl_setopt($ch, CURLOPT_URL, $url . "/api/insertLift.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($liftData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
echo $result;

$_SESSION['message'] = 'success';

header("Location: ./index.php?lift=".$typeinput);

?>




