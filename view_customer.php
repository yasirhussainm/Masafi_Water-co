<?php
session_start();
require_once "pdo.php";

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}

$stmt = $pdo->query("SELECT name, email, mobile, iqama, customer_id FROM customer");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    Customer Details
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
  if(!empty($rows)){
    echo('<table border="1">'."\n");
    echo('<thead><tr>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile No</th>
    <th>Iqama</th>
    <th>Documents</th>
    <th>Action</th>
    </tr></thead>');
    foreach ($rows as $row){
      echo "<tr><td>";
      echo(htmlentities($row['name']));
      echo("</td><td>");
      echo(htmlentities($row['email']));
      echo("</td><td>");
      echo(htmlentities($row['mobile']));
      echo("</td><td>");
      echo(htmlentities($row['iqama']));
      echo("</td><td>");
      echo('<a href="view_image.php?customer_id='.$row['customer_id'].'">View</a> ');
      echo("</td><td>");
      echo('<a href="edit_customer.php?customer_id='.$row['customer_id'].'">Edit</a> / ');
      echo('<a href="delete_customer.php?customer_id='.$row['customer_id'].'">Delete</a>');
      echo("</td></tr>\n");
    }
  }
  else echo('<p>No Rows found');


?>
<div class="row">
        <button class="btn onebytwo left-btn" onclick="window.location.href='./add_customer.php';">
            <i class="fas fa-user-tie"></i> Add New Entry
        </button>
        <button class="btn onebytwo" onclick="window.location.href='./index.php';">
            <i class="fas fa-user-friends"></i> Cancel
        </button>
</div>
<!-- <p><a href="add_customer.php">Add New Entry</a></p>
<p><a href="index.php">Cancel</a></p> -->
</div>
</div>
</body>
