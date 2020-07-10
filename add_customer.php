<?php
session_start();
require_once "pdo.php";
require_once "util.php";
require_once "head.php";
if ((!isset($_SESSION['driver'])) && (!isset($_SESSION['admin']))) {
    die("ACCESS DENIED");
}
if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
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
        Tracking data for <?php echo(htmlentities((isset($_SESSION['driver'])) ? $_SESSION['driver'] : $_SESSION['admin'])); ?>
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
?>
<form action="upload.php" method="POST" enctype="multipart/form-data"><br/><br/>
<label for="name">Name</label>
<input type="text" name="name" id="name"><br/>
<label for="email">email</label>
<input type="text" name="email" id="email"><br/>
<label for="mobile">mobile</label>
<input type="text" name="mobile" id="mobile"><br/>
<label for="iqama">iqama</label>
<input type="text" name="iqama" id="iqama"><br/>
<label>iqama photo:</label>
<input type="file" name="image_iqama"><br/>
<label>agreement photo:</label>
<input type="file" name="image_agreement"><br/>
<input type="submit" name="submit" value="Add">
</form>
<form  method="POST">
<input type="submit" name="cancel" value="cancel">
</form>
</div>
</div>
</body>
