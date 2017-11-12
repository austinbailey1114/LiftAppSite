<?php

session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$typeInput = str_replace(" ", "_", $_POST['type']);

//check if the user input type of lift is already saved

$id = $_POST['id'];
//check if this lift exists for this user already
if ($sql = mysqli_prepare($conn, "SELECT * FROM lifttypes WHERE user = ? AND name = ?")) {
    mysqli_stmt_bind_param($sql, 'is', $id, $typeInput);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_store_result($sql);

    //if this is a new type for the user, add this to their lift types
    if (mysqli_stmt_num_rows($sql) < 1) {
        $sql = mysqli_prepare($conn, "INSERT INTO lifttypes (name, user) VALUES (?, ?)");
        mysqli_stmt_bind_param($sql, 'si', $typeInput, $id);
        mysqli_stmt_execute($sql);
    }
}

if ($_POST['date'] != '') {
    $date = $_POST['date'];
    $date = date('Y-m-d', strtotime($date));
} else {
    $date = date("Y-m-d H:i:s");

}

if (!is_numeric($_POST['weight']) || !is_numeric($_POST['reps'])) {
    $message = 'failed';
}

$weight = $_POST["weight"];
$reps = $_POST["reps"];

if ($sql = mysqli_prepare($conn, "INSERT INTO lifts (weight, reps, type, user, date)
VALUES (?, ?, ?, ?, ?)")) {
    mysqli_stmt_bind_param($sql, 'iisis', $weight, $reps, $typeInput, $id, $date);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_store_result($sql);

    if ($result) {
        echo "New record created successfully";
    $_SESSION['message'] = 'success';
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>