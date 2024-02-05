<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header('Location: ../main.php');
    exit();
}

require "../db.php";

$user_id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];

    $usernameChanged = ($username != $user['user_name']);
    $fullnameChanged = ($fullname != $user['user_fullname']);

    if ($usernameChanged || $fullnameChanged) {
        $sql = "SELECT * FROM users WHERE (user_name = '$username' OR user_fullname = '$fullname') AND user_id <> $user_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "User with this username or full name already exists!";
        } 
        else 
        {
            $sql = "UPDATE users SET user_name = '$username', user_fullname = '$fullname' WHERE user_id = $user_id";
            mysqli_query($conn, $sql);
    
            header('Location: ADMININTERFACE.php');
        }
    } 
    else 
    {
        header('Location: ADMININTERFACE.php');
    }
}


$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2>Edit User</h2>
  <form method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['user_name']; ?>" required>
    </div>
    <div class="form-group">
      <label for="fullname">Full Name:</label>
      <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['user_fullname']; ?>" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="ADMININTERFACE.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

</body>
</html>

