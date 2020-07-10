<?php
session_start();
if (!isset($_SESSION['driver'])){
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
        Agent's portal
    </header>
    <div class="login-info">
        <p>Loged in as <?php echo($_SESSION['driver']); ?></p>
    </div>
    <?php

    if ( isset($_SESSION['success']) ) {

        echo('<p style="color: red;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
    if ( isset($_SESSION['error']) ) {

        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <div class="admin--btn-layout row">
        <button class="btn onebytwo left-btn" onclick="window.location.href='./add_customer.php'">
            <i class="fas fa-plus"></i> Add Customer
        </button>
        <button class="btn onebytwo" onclick="window.location.href='./view_customer.php'">
            <i class="fab fa-buffer"></i> View Customer
        </button>
        <button class="btn one" onclick="window.location.href='./report.php';">
        <i class="fas fa-database"></i> Report
        </button>
        <button class="btn one" onclick="window.location.href='./transactions.php';">
        <i class="fas fa-users-cog"></i> Transaction
        </button>
    </div>
</div>
<footer>
    <p class="link-admin"><a href="./logout.php">Logout</a></p>
    <p class="copyright">&copy;All right Reserved Masafi water co.</p>
</footer>

      <!-- <? echo('<a href="change_password_driver.php?driver_id='.$_SESSION['driver_id'].'">Change password</a>');
        echo($_SESSION['driver_id']);?> -->

</main>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!--<script src="asset/app.js"></script>-->
</body>
</html>