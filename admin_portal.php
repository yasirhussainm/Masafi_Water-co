<?php
session_start();
if (isset($_SESSION['driver'])){
  if (!isset($_SESSION['admin']))
  die("YOU DONOT HAVE THE PRIVILAGE TO BE HERE - TRY LOGGING IN AS ADMIN");
}
if (!isset($_SESSION['admin'])) {
  die("NOT LOGGED IN");
}

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
        Admin's portal
    </header>
    <!-- <div class="login-info">
        <p>Login as Admin</p>
    </div> -->
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
    <div class="admin--btn-layout">
    <a href="logout.php">Logout</a>
    </div>
    <footer>
        <p class="link-admin"><a href="./index_admin.php">Go to Admin portal</a></p>
        <p class="copyright">&copy;All right Reserved Masafi water co.</p>
    </footer>
</div>
</div>
<!--<script src="asset/app.js"></script>-->
</body>
</html>
