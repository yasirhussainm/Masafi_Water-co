<?php
require_once "pdo.php";
session_start();
if ((!isset($_SESSION['driver'])) && (!isset($_SESSION['admin']))){
    die("Not logged in");
}

if (isset($_POST['customer_id'])){
  if ( strlen($_POST['npassword']) < 1 || strlen($_POST['cpassword']) < 1) {
      $_SESSION['error'] = 'Missing data';
      header("Location: change_password_driver.php?driver_id=".$_POST['customer_id']);
      return;
  }
    if (isset($_POST['npassword']) && isset($_POST['cpassword'])){
      // Data validation

      if ($_POST['npassword'] == $_POST['cpassword'])
      {
        if (isset($_POST['password']))
        {
         $sql = ("SELECT username, password,name,driver_id FROM pass_driver WHERE password =:pass");
         $stmt = $pdo->prepare($sql);
         $stmt->execute(array(
             ':pass' => md5($_POST['password'])));
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

             if ( $row == true ) {
                $_SESSION['driver'] = $row['name'];
                $_SESSION['driver_id'] = $row['driver_id'];
                $password = $_POST['npassword'];
                $hashed_password = md5($password);
                $sql = "UPDATE pass_driver SET password = :password
                        WHERE driver_id = :driver_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':password' => $hashed_password,
                    ':driver_id' => $_POST['id']));
                $_SESSION['success'] = 'Password successfully changed';
                header( 'Location: agent_portal.php' ) ;
                return;
  }


  else {
     $_SESSION['error'] = "Invalid Credentials";
     header("Location: change_password_driver.php?driver_id=".$_POST['customer_id']);
     return;
   }
 }
     }
    else {
      $_SESSION['error']="Both password should match";
      header("Location: change_password_driver.php?driver_id=".$_POST['customer_id']);
      return;
    }
  }else {
    $_SESSION['error']="Both Fields are to be filled";
    header("Location: change_password_driver.php?driver_id=".$_POST['customer_id']);
    return;
  }
}


// Guardian: name sure that customer_id is present
if ( (!isset($_GET['driver_id']) && (!isset($_GET['admin_id'])))) {
  $_SESSION['error'] = "Missing info";
  header('Location: index.php');
  return;
}
//TAKING PREVIOUS VALUES FROM TABLE TO DISPLAY
if (isset($_GET['driver_id'])) {
  $stmt = $pdo->prepare("SELECT name,username,password,driver_id FROM pass_driver where driver_id = :xyz");
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
<h1>Change Password for <?php
if (isset($_GET['admin_id'])){
    echo($row['name']);
   }
if (isset($_GET['driver_id'])){
    echo($row['name']);
   }
?></h1>
<?php

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$u = htmlentities($row['password']);
$id = isset($row['driver_id']) ? $row['driver_id']: $row['admin_id'];
//$id = isset($_GET['driver_id']) ? $_GET['driver_id']: $_GET['admin_id'];
?>
<form method="post">
<p>Password :
<input type="password" name="password" id="password" placeholder="Enter your Password">
<p>New Password:
<input type="password" name="npassword" placeholder="Enter your New Password"></p>
<p>Confirm Password:
<input type="password" name="cpassword" placeholder="Confirm New your Password"></p>
<input type="hidden" name="id" value="<?= $id ?>">
<input type="hidden" name="customer_id" value="<?= $id ?>">
<p><input type="submit" value="Save"/>
<a href="agent_portal.php">Cancel</a></p>
</form>
