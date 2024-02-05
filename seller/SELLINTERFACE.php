<?php

session_start();

if(!isset($_SESSION['logged']) || $_SESSION['logged']!=True) {
	header('Location: ../main.php');
	exit();
}

require "../db.php";


$user_id = $_SESSION['user_id'];
$sql = "SELECT user_fullname FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $user_fullname = $row["user_fullname"];
  }
} 
else {
  echo "0 results";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Seller Interface</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <!-- ICONS FOR EVERY NAVBAR ITEM FONT AWESOME -->
</head>
<body>

<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- ADMIN ATVEJU ADMINISTRATION BAR -->
    <h1 class="navbar-brand">KASA</h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </li>
      </ul>

      <span class="navbar-text mx-auto"><?php echo "<div style='padding-bottom:15px;'>PARDAVEJAS: ".$_SESSION['user_fullname'].'</div>'; ?></span>

    </div>
  </nav>

</header>

<div class="container">
  <table class="table">
    <tr>
      <td>Today is:</td>
      <td>
        <?php
          date_default_timezone_set('Europe/Vilnius');
          $currentDateTime = date('Y-m-d H:i:s');
          echo $currentDateTime;
        ?>
      </td>
    </tr>
  </table>

  <form action="action.php" method="post">
    <div class="form-group">
      <label for="inputDate">Iveskite kliento gimimo data:</label>
      <input type="date" class="form-control" id="inputDate" name="inputDate" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
<br>
  <?php
  
  if (isset($_SESSION['result_table'])) {
    echo $_SESSION['result_table'];
    unset($_SESSION['result_table']); 
  }

  

  ?>
  
</div>



    <?php
    // >SUBMIT sitam puslapyje atidarys papildomas langas su duomenim:
    //kada klientas atejo(laikas(datetime))
    //kada jis gime
    //koks sprendimas (parduot(GREEN)/neparduot(RED))

    //admin tures kita interface, bet netures access to SELLINTERFACE
    //kasininkas netures access to ADMININTERFACE

    //gales matyt userius istrinti regaduoti kurti(CRUD10)
    //adminas a pardavejas p

    //localhost/pardavejas/admin/users.php (atskirti puslapiem jeigu daug duomenu pvz 15 irasu)
    //require "../db.php" - KAD I VIRSU EITU ir ieskotu
    //localhost/pardavejas/seller/sellinterface.php

    /*PARDAVEJAS SELLER SELLINTERFACE (per php kintamieji?)
    sell_id
    sell_date
    sell_birthdate
    sell_decision
    sell_user_id
    */
    ?>
  </div>

</body>
</html>

