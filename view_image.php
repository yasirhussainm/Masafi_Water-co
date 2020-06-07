<!-- This file is intented to view the profile of individual users
by parsing information in GET parametre -->
<?php
session_start();
require_once "pdo.php";

if ( !isset($_GET['customer_id']))  {
  $_SESSION['error'] = "Missing Parametres";
  header('Location: index.php');
  return;
}
if ((!isset($_SESSION['driver'])) && (!isset($_SESSION['admin']))) {
    die('NO ACCESS');
    return;
}

if (isset($_GET['customer_id'])){
  $stmt = $pdo->prepare("SELECT image_iqama,image_agreement FROM customer where customer_id = :customer_id");
  $stmt->execute(array(":customer_id" => $_GET['customer_id']));
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
<h1>Documents</h1>
<?php


  if ( isset($_SESSION['success']) ) {
      echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
      unset($_SESSION['success']);
  }
  if ( isset($_SESSION['error']) ) {
      echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
      unset($_SESSION['error']);
  }
  if ($row!== false) {

          $url_image_iqama = 'uploads/'.$row["image_iqama"];
          $url_image_agreement = 'uploads/'.$row["image_agreement"];
    ?>
      <img src="<?= $url_image_iqama; ?>" />
      <img src="<?= $url_image_agreement; ?>" />
    <?php } ?>

<p><a href="view_customer.php">Go Back</a></p>
</body>
