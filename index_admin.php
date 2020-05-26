<?php

session_start();
require_once "pdo.php";
if (isset($_SESSION['admin'])) {
  header('Location: admin_portal.php');
  return;
}

if ((isset($_POST['username'])) && (isset($_POST['password'])))
{
 $sql = ("SELECT username, password,name,admin_id FROM pass_admin WHERE username = :username AND password =:pass");
 $stmt = $pdo->prepare($sql);
 $stmt->execute(array(
     ':username' => $_POST['username'],
     ':pass' => md5($_POST['password'])));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 if ( $row == true ) {
  $_SESSION['admin'] = $row['name'];
  $_SESSION['admin_id'] = $row['admin_id'];
  header('Location: admin_portal.php');
  return;
 }
 else {
   $_SESSION['error'] = 'Invalid Credentials';
   header('Location: index_admin.php');
   return;
 }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/stylesheet.css">
    <title>Water dist.</title>
</head>
<body>
<main>
<header>
    <div class="header--heading">
        Masafi Water
    </div>
    <?php

    if ( isset($_SESSION['success']) ) {

        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
    if ( isset($_SESSION['error']) ) {

        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <nav>
        <div class="nav--user-toggle">
            <a href="index.php"><div class="nav--user-toggle-link">DRIVER</div></a>
            <a href="index_admin.php" class="active"><div class="nav--user-toggle-link">ADMIN</div></a>
        </div>
    </nav>
</header>
<section>
<div class="container">
<div class="login-box">
    <div class="login--icon">
        <img src="asset/img/car.png" alt="">
    </div>
    <form method="post">
        <div class="login--input"><input class="login--input-types" type="text" placeholder="Admin Id" id="username" name="username" required></div>
        <div class="login--input"><input class="login--input-types" type="password" placeholder="Password" id="password" name="password" required></div>
        <div class="login--input"><button class="login--input-types" id="submit" name="submit">Submit</button></div>
    </form>
</div>
</div>
</section>

</main>
<!--<script src="asset/app.js"></script>-->
</body>
</html>
