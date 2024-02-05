<?php

session_start();

if(!isset($_SESSION['logged']) || $_SESSION['logged']!=True) {
	header('Location: ../main.php');
	exit();
}

require "../db.php";

$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users WHERE user_group = 'p' LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

$sql_count = "SELECT COUNT(*) as total FROM users WHERE user_group = 'p'";
$result_count = mysqli_query($conn, $sql_count);
$total = mysqli_fetch_assoc($result_count)['total'];
$pages = ceil($total / $limit);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Interface</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>

<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h1 class="navbar-brand">ADMINISTRATION</h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="create_user.php"><i class="fas fa-plus"></i> Create User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </li>
        <!-- PADARYTI GENERATE AND DOWNLOAD GALIMYBES -->
        <li class="nav-item">
          <a class="nav-link" href="generate_pdf.php"><i class="fas fa-file-pdf"></i> Generate PDF File</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="generate_xlsx.php"><i class="fas fa-file-excel"></i> Generate xlsx File</a>
        </li>
      </ul>

      <span class="navbar-text mx-auto"><?php echo "<div style='padding-bottom:15px;'>ADMINISTRATOR: ".$_SESSION['user_fullname'].'</div>'; ?></span>
        
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

  <a href="create_user.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Create User</a>

<?php

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>User ID</th>';
    echo '<th>User Name</th>';
    echo '<th>User Fullname</th>';
    echo '<th>User Group</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['user_fullname'] . '</td>';
        echo '<td>' . $row['user_group'] . '</td>';
        echo '<td>';
        
        echo '<a href="edit_user.php?id=' . $row['user_id'] . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a> ';
        echo '<a href="delete_user.php?id=' . $row['user_id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>';
        echo '<a href="performance.php?id=' . $row['user_id'] . '" class="btn btn-success btn-sm ml-1"><i class="fas fa-wheelchair"></i> Performance</a> ';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No users found';
}

?>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php if($page == 1) { echo 'disabled'; } ?>">
      <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
    </li>
    <?php for($i = 1; $i <= $pages; $i++): ?>
    <li class="page-item <?php if($page == $i) { echo 'active'; } ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
    <li class="page-item <?php if($page == $pages) { echo 'disabled'; } ?>">
      <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
    </li>
  </ul>
</nav>
 
<br>
  
</div>
  </div>

</body>
</html>

