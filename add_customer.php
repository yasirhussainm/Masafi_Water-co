<?php
session_start();
require_once "pdo.php";
if ((!isset($_SESSION['driver'])) && (!isset($_SESSION['admin']))) {
    die("ACCESS DENIED");
}
if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}
if ((isset($_POST['mobile'])) && (isset($_POST['iqama'])) && (isset($_POST['name'])) && (isset($_POST['email'])))
{
        if (((strlen($_POST['name']))<1) || ((strlen($_POST['email']))<1)
              || ((strlen($_POST['mobile']))<1) || ((strlen($_POST['iqama']))<1)) {
          $_SESSION['error'] = 'All fields are required';
          header('Location: add_customer.php');
          return;
        }
        if (!is_numeric($_POST['mobile'])){
          $_SESSION['error'] = 'mobile must be an integer';
          header('Location: add_customer.php');
          return;
        }
        if (!is_numeric($_POST['iqama'])){
          $_SESSION['error'] = 'iqama must be an integer';
          header('Location: add_customer.php');
          return;
        }


            $sql = "INSERT INTO customer (name,email,mobile,iqama,rem_bottles)
                      VALUES (:name, :email, :mobile, :iqama, :rem_bottles)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':name'=>$_POST['name'],
                ':email'=>$_POST['email'],
                ':mobile'=>$_POST['mobile'],
                ':rem_bottles'=>0,
                ':iqama'=>$_POST['iqama']));
            $_SESSION['success'] = "Record added";
            header('Location: agent_portal.php');
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
// Note triple not equals and think how badly double
// not equals would work here...
if ( isset($_SESSION['success']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
if ( isset($_SESSION['error']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
<form method="POST"><br/><br/>
<label for="name">Name</label>
<input type="text" name="name" id="name"><br/>
<label for="email">email</label>
<input type="text" name="email" id="email"><br/>
<label for="mobile">mobile</label>
<input type="text" name="mobile" id="mobile"><br/>
<label for="iqama">iqama</label>
<input type="text" name="iqama" id="iqama"><br/>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="cancel">
</form>
</div>
</body>
