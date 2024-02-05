<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header('Location: ../main.php');
    exit();
}

require "../db.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $user_group = 'p';

    $sql = "SELECT * FROM users WHERE user_name = '$username' OR user_fullname = '$fullname'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "User with this username or full name already exists!";
    } 
    else {
    $sql = "INSERT INTO users (user_name, user_fullname, user_password, user_group) VALUES ('$username', '$fullname', '$password', '$user_group')";
    mysqli_query($conn, $sql);

    header('Location: ADMININTERFACE.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Create User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
<body>

<div class="container mt-5">
  <h2>Create User</h2>
  <form method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="fullname">Full Name:</label>
      <input type="text" class="form-control" id="fullname" name="fullname" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="ADMININTERFACE.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>
