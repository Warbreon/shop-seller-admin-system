<?php

session_start();
require "../db.php";

$pardavejas = $_SESSION['user_id'];

date_default_timezone_set('Europe/Vilnius');
$currentDateTime = date('Y-m-d H:i:s');
  // IF SUBMIT action.php
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $submit_data = $_POST['inputDate'];
    $submit_time = date('Y-m-d H:i:s');

    // Sprendimas
    $age = date_diff(date_create($submit_data), date_create($currentDateTime))->y;
    if ($age >= 20) {
      $decision = 'GALIMA PARDUOTI';
    } else {
      $decision = 'NEGALIMA PARDUOTI';
    }

    $pardavejas = isset($pardavejas) ? $pardavejas : '';

    // RESULT TABLE
    ob_start();
    echo "<table class='table'>
      <thead class='thead-light'>
        <tr>
          <th scope='col'>#</th>
          <th scope='col'>INFO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope='row'>Kada atejo klientas:</th>
          <td>$submit_time</td>
        </tr>
        <tr>
          <th scope='row'>Kada jis gime:</th>
          <td>$submit_data</td>
        </tr>
        <tr>
          <th scope='row'>Kiek jam metu:</th>
          <td>$age</td>
        </tr>
        <tr>
          <th scope='row'>SPRENDIMAS:</th>
          <td>";
    if (isset($decision)) {
        if ($decision == 'GALIMA PARDUOTI') {
            echo "<span class='text-success'>$decision</span>";
          } else {
            echo "<span class='text-danger'>$decision</span>";
          }
    } 
    echo "</td>
        </tr>
      </tbody>
    </table><br>";

    $_SESSION['submit_time'] = $submit_time;
    $_SESSION['submit_data'] = $submit_data;
    $_SESSION['age'] = $age;
    $_SESSION['decision'] = $decision;
    $_SESSION['pardavejas'] = $pardavejas;

    echo "<a href='getSold.php?sold=TAIP' class='btn btn-success' value='TAIP'>PARDUOTI</a>
            <a href='getSold.php?sold=NE' class='btn btn-danger' value='NE'>NEPARDUOTI</a>";

    
  }
    
     
    $_SESSION['result_table'] = ob_get_clean();
    header('Location: SELLINTERFACE.php');
  
  ?>