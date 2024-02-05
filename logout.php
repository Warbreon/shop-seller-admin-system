<?php

session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['success'] = 'You have logged out.';

header('Location: main.php');
exit();

?>