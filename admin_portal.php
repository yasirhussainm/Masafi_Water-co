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
    <div class="login-info">
        <p>Loged in as Admin</p>
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
    <div class="admin--btn-layout row">
        <button class="btn onebytwo left-btn" onclick="document.getElementById('id01').style.display='block'">
            <i class="fas fa-user-tie"></i> Driver
        </button>
        <button class="btn onebytwo" onclick="document.getElementById('id02').style.display='block'">
            <i class="fas fa-user-friends"></i> Customer
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
</div>
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <div class="modal-content">
    <div class="modal--container">
      <h2>Driver</h2>
      <hr>
      <div class="row">
        <button class="btn onebytwo left-btn" onclick="window.location.href='./add_user.php';">
        <i class="fas fa-plus"></i> Add
        </button>
        <button class="btn onebytwo" onclick="window.location.href='./view_user.php';">
        <i class="fab fa-buffer"></i> View
        </button>
      </div>
    </div>
  </div>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <div class="modal-content">
    <div class="modal--container">
      <h2>Customer</h2>
      <hr>
      <div class="row">
      <button class="btn onebytwo left-btn" onclick="window.location.href='./add_customer.php';">
      <i class="fas fa-plus"></i> Add
        </button>
        <button class="btn onebytwo" onclick="window.location.href='./view_customer.php';">
        <i class="fab fa-buffer"></i> View
        </button>
      </div>
    </div>
    </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Get the modal
var modalOne = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalOne) {
    modalOne.style.display = "none";
  }
}
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!--<script src="asset/app.js"></script>-->
</body>
</html>
