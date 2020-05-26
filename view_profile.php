<!-- This file is intented to view the profile of individual users
by parsing information in GET parametre -->
<?php
session_start();
require_once "pdo.php";

if (( !isset($_GET['driver_id'])) && (!isset($_GET['admin_id']))) {
  $_SESSION['error'] = "Missing Parametres";
  header('Location: index.php');
  return;
}
if ( !isset($_SESSION['admin']) && (($_GET['driver_id'])!=($_SESSION['driver_id']))) {
    die('NO ACCESS');
    return;
}

if (isset($_GET['driver_id'])){
  $stmt = $pdo->prepare("SELECT * FROM pass_driver where driver_id = :driver_id");
  $stmt->execute(array(":driver_id" => $_GET['driver_id']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_GET['admin_id'])){
  $stmt = $pdo->prepare("SELECT * FROM pass_admin where admin_id = :admin_id");
  $stmt->execute(array(":admin_id" => $_GET['admin_id']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Masafi</title>

<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">

<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
    crossorigin="anonymous">

<link rel="stylesheet"
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

</head>
<body>

<div class="container">
<h1>User Profile</h1>
<?php


  if ( isset($_SESSION['success']) ) {
      echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
      unset($_SESSION['success']);
  }
  if ( isset($_SESSION['error']) ) {
      echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
      unset($_SESSION['error']);
  }

  if(!empty($row)){
    echo('<table border="1">'."\n");
    echo('<thead><tr>
    <th>Name</th>
    <th>Username</th>
    <th>Account Type</h1>
    </tr></thead>');
      echo "<tr><td>";
      echo(htmlentities($row['name']));
      echo("</td><td>");
      echo(htmlentities($row['username']));
      echo("</td><td>");
      echo(isset($_GET['driver_id']) ? 'Driver' : 'Admin');
      echo("</td></tr>\n");
}

?>
<p><a href="view_user.php">Go Back</a></p>
</body>
