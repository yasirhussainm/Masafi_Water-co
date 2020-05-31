<?php
// session_start();
// if (isset($_SESSION['driver'])){
//   if (!isset($_SESSION['admin']))
//   die("YOU DONOT HAVE THE PRIVILAGE TO BE HERE - TRY LOGGING IN AS ADMIN");
// }
// if (!isset($_SESSION['admin'])) {
//   die("NOT LOGGED IN");
// }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/style.css" />
    <link rel="stylesheet" href="/">

    <title>Masafi water ditribution company</title>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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

        // if ( isset($_SESSION['success']) ) {

        //     echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        //     unset($_SESSION['success']);
        // }
        // if ( isset($_SESSION['error']) ) {

        //     echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        //     unset($_SESSION['error']);
        // }
        ?>
    <div class="admin--btn-layout row">
        <button class="btn onebytwo left-btn">
            <i class="fas fa-user-tie"></i> Driver
        </button>
        <button class="btn onebytwo">
            <i class="fas fa-user-friends"></i> Customer
        </button>
        <button class="btn one">
        <i class="fas fa-database"></i> Report
        </button>
        <button class="btn one">
        <i class="fas fa-users-cog"></i> Transaction
        </button>
    </div>
    <footer>
        <p class="link-admin"><a href="./logout.php">Logout</a></p>
        <p class="copyright">&copy;All right Reserved Masafi water co.</p>
    </footer>
</div>
</div>
<!--<script src="asset/app.js"></script>-->
</body>
</html>
