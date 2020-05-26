 <?php

session_start();
require_once "pdo.php";
if (isset($_SESSION['driver'])){
  header('Location: agent_portal.php');
  return;
}
if (isset($_SESSION['admin'])) {
  header('Location: admin_portal.php');
  return;
}

if ((isset($_POST['username'])) && (isset($_POST['password'])))
{
  $sql = ("SELECT username, password,name,driver_id FROM pass_driver WHERE username = :username AND password =:pass");
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':username' => $_POST['username'],
      ':pass' => md5($_POST['password'])));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ( $row == true ) {
   $_SESSION['driver'] = $row['name'];
   $_SESSION['driver_id'] = $row['driver_id'];
   header('Location: agent_portal.php');
   return;
  }
  else {
    $_SESSION['error'] = 'Invalid Credentials';
    header('Location: index.php');
    return;
  }
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
        Login
    </header>
    <div class="login-info">
        <p>Login as Driver</p>
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
    <div class="login-form">
        <form action="">
            <label for="login-id">Driver Id</label>
            <input type="text" name="login-id" id="login-id" placeholder="Enter your Username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your Password">
            <input type="submit" name="submit" value="Log In">
        </form>
    </div>
    <footer>
        <p class="link-admin"><a href="">Go to Admin portal</a></p>
        <p class="copyright">&copy;All right Reserved Masafi water co.</p>
    </footer>
</div>
</div>
<!--<script src="asset/app.js"></script>-->
</body>
</html>