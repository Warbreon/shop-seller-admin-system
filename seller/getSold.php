<?php
session_start();
require "../db.php";

//AR PARDAVE AR NE
if (isset($_GET['sold'])) {
    $sold = $_GET['sold'];

    $submit_time = $_SESSION['submit_time'];
    $submit_data = $_SESSION['submit_data'];
    $age = $_SESSION['age'];
    $decision = $_SESSION['decision'];
    $pardavejas = $_SESSION['pardavejas'];

    // INSERT INTO DB
    $sql = "INSERT INTO clients (client_time, client_dateofbirth, client_age, client_decision, client_sold, user_id) 
        VALUES ('$submit_time', '$submit_data', $age, '$decision', '$sold', '$pardavejas')";
    $conn->query($sql);
}

header('Location: SELLINTERFACE.php');
exit();

?>