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
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/stylesheet.css">
    <title>Masafi water dist. co.</title>
</head>
<body>
<main>
<header>
    <div class="header--heading">
        Masafi Water - Admin Portal
    </div>
    <nav>
        <div class="nav--user-toggle">
            <div class="nav--user-toggle-info">You have logged in as <?php echo($_SESSION['admin']); ?></div>
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
    </nav>
</header>
<section>
<div class="container">
<div class="portal--option-box">
    <ul class="portal--options">
        <li>
            <div><i class="fa fa-bars" style="font-size: 48px;"></i></div><br/>
            <div><p>Report</p></div>
        </li>
        <li>
            <div><i class="fa fa-plus-square" style="font-size: 48px;"></i></div><br/>
            <div><p>Add Customer</p></div>
        </li>
        <li>
            <div><i class="fa fa-shopping-cart" style="font-size: 48px;"></i></div><br/>
            <div><p>Transaction</p></div>
        </li>
    </ul>
    <p>
      <a href="logout.php">Logout</a> |
      <a href="report.php">Report</a> |
      <a href="add_customer.php">Add Customer</a> |
      <a href="add_user.php">Add User</a> |
      <a href="view_customer.php">View Customer</a> |
      <a href="view_user.php">View Users</a> |
      <a href="transactions.php">Transactions</a>
    </p>
</div>
</div>
</section>

</main>
<!--<script src="asset/app.js"></script>-->
</body>
</html>
