<?php
require_once "pdo.php";
session_start();
if ((!isset($_SESSION['driver'])) && (!isset($_SESSION['admin']))){
    die("Not logged in");
}

if ( isset($_POST['name']) && isset($_POST['username'])
     && (isset($_POST['driver_id']) || isset($_POST['admin_id']))) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['username']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?customer_id=".$_POST['customer_id']);
        return;
    }

    if (isset($_POST['driver_id']))
    $sql = "UPDATE pass_driver SET name = :name,
            username = :username
            WHERE driver_id = :driver_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':username' => $_POST['username'],
        ':driver_id' => $_POST['id']));
    $_SESSION['success'] = 'Record edited';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: name sure that customer_id is present
if ( !isset($_GET['driver_id']) && (!isset($_GET['admin_id']))) {
  $_SESSION['error'] = "Missing info";
  header('Location: index.php');
  return;
}
//TAKING PREVIOUS VALUES FROM TABLE TO DISPLAY
if (isset($_GET['driver_id'])) {
  $stmt = $pdo->prepare("SELECT name,username FROM pass_driver where driver_id = :xyz");
  $stmt->execute(array(":xyz" => $_GET['driver_id']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_GET['admin_id'])) {
  $stmt = $pdo->prepare("SELECT name,username FROM pass_admin where admin_id = :xyz");
  $stmt->execute(array(":xyz" => $_GET['driver_id']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for ID';
    header( 'Location: index.php' ) ;
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Masafi Water</title>

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
<h1>Editing Window</h1>
<?php

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$u = htmlentities($row['username']);
$id = isset($_GET['driver_id']) ? $_GET['driver_id']: $_GET['admin_id'];
?>
<form method="post">
<p>Name:
<input type="text" name="name" value="<?= $n ?>"></p>
<p>Username:
<input type="text" name="username" value="<?= $u ?>"></p>
<input type="hidden" name="id" value="<?= $id ?>">
<input type="hidden" name="customer_id" value="<?= $id ?>">
<p><input type="submit" value="Save"/>
<a href="view_user.php">Cancel</a></p>
</form>
