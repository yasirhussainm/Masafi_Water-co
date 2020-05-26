<!-- This file is intented to view all the details of drivers and Admins
with hyperlink to each of their profile(view_profile.php) and EDIT/DELETE buttons -->

<?php
session_start();
require_once "pdo.php";

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}
if ( !isset($_SESSION['admin'])){
  die('NOT LOGGED IN');
}

$stmt = $pdo->query("SELECT name, username, driver_id FROM pass_driver");
$rows_driver = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->query("SELECT name, username, admin_id FROM pass_admin");
$rows_admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<h1>Driver Details</h1>
<?php


  if ( isset($_SESSION['success']) ) {
      echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
      unset($_SESSION['success']);
  }
  if ( isset($_SESSION['error']) ) {
      echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
      unset($_SESSION['error']);
  }
  if(!empty($rows_driver)){
    echo('<table border="1">'."\n");
    echo('<thead><tr>
    <th>Name</th>
    <th>username</th>
    <th>Action</th>
    </tr></thead>');
    foreach ($rows_driver as $row){
      echo "<tr><td>";
      echo('<a href="view_profile.php?driver_id='.$row['driver_id'].'">'.htmlentities($row['name']).'<a/>');
      echo("</td><td>");
      echo(htmlentities($row['username']));
      echo("</td><td>");
      echo('<a href="edit_user.php?driver_id='.$row['driver_id'].'">Edit</a> / ');
      echo('<a href="delete_user.php?driver_id='.$row['driver_id'].'">Delete</a>');
      echo("</td></tr>\n");
    }
  } else echo('<p>No Records found for Drivers');

  if(!empty($rows_admin)){
    echo('<table border="1">'."\n");
    echo('<thead><tr>
    <th>Name</th>
    <th>username</th>
    <th>Action</th>
    </tr></thead>');
    foreach ($rows_admin as $row){
      echo "<tr><td>";
      echo('<a href="view_profile.php?admin_id='.$row['admin_id'].'">'.htmlentities($row['name']).'<a/>');
      echo("</td><td>");
      echo(htmlentities($row['username']));
      echo("</td><td>");
      echo('<a href="edit_user.php?driver_id='.$row['admin_id'].'">Edit</a> / ');
      echo('<a href="delete_user.php?driver_id='.$row['admin_id'].'">Delete</a>');
      echo("</td></tr>\n");
    }
  } else echo('<p>No Records found for Admins');



?>
<p><a href="add_user.php">Add New User</a></p>
<p><a href="index.php">Cancel</a></p>
<h1>Admin Details</h1>
</body>
