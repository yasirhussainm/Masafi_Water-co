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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/style.css" />
    <title>Masafi water ditribution company</title>
</head>
<body>
<div class="wrapper">
<div class="main">
  <header>
    Driver Details
  </header>
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
<h2>Admin Details</h2>
</div>
</div>
</body>
