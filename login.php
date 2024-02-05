<?php

session_start();

require "db.php";

$sql = "SELECT user_group FROM `users`";

if (isset($_SESSION['logged']) && ($_SESSION['logged'] == TRUE)) {
    if ($user_group == "p") {
        header('Location: seller/SELLINTERFACE.php');
        exit();
    } 
	elseif ($user_group == "a") {
        header('Location: admin/ADMININTERFACE.php');
        exit();
    }
}

$error = '';

if(!empty($_POST)) {
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = validate_input($_POST['username']);
		$password = validate_input($_POST['password']);

	$sql = "SELECT user_id, user_fullname, user_group FROM `users` WHERE `user_name` = '$username' AND `user_password` = '$password'";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			$records = mysqli_fetch_assoc($result);

			$_SESSION['logged'] = TRUE;
			$_SESSION['user_fullname'] = $records['user_fullname'];
			$_SESSION['user_id'] = $records['user_id'];
			$_SESSION['user_group'] = $records['user_group'];

			if ($_SESSION['user_group'] == "p") {
				header('Location: seller/SELLINTERFACE.php');
				exit();
			} 
			elseif ($_SESSION['user_group'] == "a") {
				header('Location: admin/ADMININTERFACE.php');
				exit();
			}
		}
		else{
			$error = 'Bad login name or password';
		}
	}
	else{
		$error = 'Login name or password not entered';
	}

}

$_SESSION['error'] = $error;

function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

header('Location: main.php');
exit();

?>