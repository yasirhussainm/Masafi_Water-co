<?php
session_start();
require_once "pdo.php";
if (!isset($_SESSION['admin'])) {
    die("ACCESS DENIED");
}
if ( isset($_POST['cancel']) ) {
    header('Location: index_admin.php');
    return;
}
if ((isset($_POST['username'])) && (isset($_POST['name'])))
{
      if (((strlen($_POST['name']))<1) || ((strlen($_POST['username']))<1)) {
          $_SESSION['error'] = 'All fields are required';
          header('Location: add_user.php');
          return;
      }
      if (!isset($_POST['user_type'])){
          $_SESSION['error'] = 'Select User Type';
          header('Location: add_user.php');
          return;
      }

      //CHECKING DATABASE FOR EXISTING USERNAMES
      $stmt = $pdo->query("SELECT username FROM pass_driver UNION SELECT username FROM pass_admin");
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row){
        if ($row['username'] == $_POST['username']){
          $_SESSION['error'] = 'Username Unavailable OR Already Taken';
          print_r($row);
          header('Location: add_user.php');
          return;
        }
      }
      if ($_POST['user_type'] == 'driver'){

            $sql = "INSERT INTO pass_driver (name,username,password)
                      VALUES (:name, :username, :password)";
            ##echo ("<pre>\n".$sql."\n</pre>\n");
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':name'=>$_POST['name'],
                ':username'=>$_POST['username'],
                ':password'=>md5('masafi123')));
            $_SESSION['success'] = "Record added";
            header('Location: admin_portal.php');
            return;

      } else {
          $sql = "INSERT INTO pass_admin (name,username,password)
                    VALUES (:name, :username, :password)";
          ##echo ("<pre>\n".$sql."\n</pre>\n");
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':name'=>$_POST['name'],
              ':username'=>$_POST['username'],
              ':password'=>md5('masafi123')));
          $_SESSION['success'] = "Record added";
          header('Location: admin_portal.php');
          return;
      }

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
<h1>Adding User </h1>
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
<label for="username">username</label>
<input type="text" name="username" id="username"><br/>
<label for="name">name</label>
<input type="text" name="name" id="name"><br/>
<input type="radio" id="driver" name="user_type" value="driver">
<label for="driver">driver</label><br>
<input type="radio" id="admin" name="user_type" value="admin">
<label for="admin">admin</label><br>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="cancel">
</form>

</div>
<p>CONTACT ADMINISTRATOR FOR DEFAULT PASSWORD</p>
</body>
