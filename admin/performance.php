<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
  header('Location: ../main.php');
  exit();
}

require "../db.php";

if (isset($_GET['id'])) {
  $client_user_id = $_GET['id'];

  //SQL REQUEST PREPARATION
  $stmt = $conn->prepare("SELECT * FROM clients_view WHERE user_id = ?");
  $stmt->bind_param("i", $client_user_id);
  //USING REQUEST
  $stmt->execute();

  // GETTING RESULT
  $result = $stmt->get_result();
  $clients = $result->fetch_all(MYSQLI_ASSOC);

  //GETTING user_fullname
  $client_user_fullname = "";
  if(count($clients) > 0) {
    $client_user_fullname = $clients[0]['user_fullname'];
  }
} 
else {
  header('Location: ADMININTERFACE.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Performance</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container mt-5">

  <h2>Performance</h2>

  <p>Pardavejas: <?php echo $client_user_fullname; ?></p>

  <?php if (count($clients) > 0): ?>

    <table class="table">
      <thead>
        <tr>
          <th>Client ID</th>
          <th>Time</th>
          <th>Date of Birth</th>
          <th>Age</th>
          <th>Decision</th>
          <th>Sold</th>
        </tr>

      </thead>
      <tbody>

        <?php foreach ($clients as $client): ?>

          <tr>
            <td><?php echo $client['client_id']; ?></td>
            <td><?php echo $client['client_time']; ?></td>
            <td><?php echo $client['client_dateofbirth']; ?></td>
            <td><?php echo $client['client_age']; ?></td>
            <td><?php echo $client['client_decision']; ?></td>
            <td><?php echo $client['client_sold']; ?></td>
          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>

  <?php else: ?>
    <p>No clients found for this user.</p>
  <?php endif; ?>
  
  <a href="ADMININTERFACE.php" class="btn btn-secondary">Back</a>
  <br><br>
</div>
</body>
</html>

