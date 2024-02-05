<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header('Location: ../main.php');
    exit();
}

require "../db.php";

$user_id = $_GET['id'];

if (isset($_POST['submit'])) {
    $sql = "DELETE FROM users WHERE user_id = $user_id";
    mysqli_query($conn, $sql);

    header('Location: ADMININTERFACE.php');
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2>Delete User</h2>
  <p>Are you sure you want to delete the following user?</p>
  <ul>
    <li>Username: <?php echo $user['user_name']; ?></li>
    <li>Full Name: <?php echo $user['user_fullname']; ?></li>
  </ul>
  <form method="POST">
    <button type="submit" name="submit" class="btn btn-danger">Delete</button>
    <a href="ADMININTERFACE.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>
