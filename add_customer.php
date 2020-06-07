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
<html>
<head>
<title>RAZA ILTHAMISH</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<div class="container">
<body>
<h1>Tracking data for <?php echo(htmlentities((isset($_SESSION['driver'])) ? $_SESSION['driver'] : $_SESSION['admin'])); ?></h1>
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
<input type="number" name="mobile" id="mobile"><br/>
<label for="iqama">iqama</label>
<input type="number" name="iqama" id="iqama"><br/>
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
</body>
