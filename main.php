<?php 
session_start();

$error = $success = '';
if(isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
if(isset($_SESSION['success'])) {
	$success = $_SESSION['success'];
	unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
</head>

<body>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-4">
			<h2 class="text-center mb-4">Login to Your Account</h2>

<?php
if(!empty($error)) {
	echo "<div style='margin-top:15px;margin-bottom:15px;color:red;'>$error</div>";
}
if(!empty($success)) {
	echo "<div style='margin-top:15px;margin-bottom:15px;color:green;'>$success</div>";
}
?>

<form action="login.php" method="post">
  <label for="name">Login name:</label><br>
  <input type="text" id="username" name="username" value=""><br>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" value=""><br><br>
  
  <input type="submit" value="Submit">
</form>

</div>
</div>
</div>

</body>
</html>