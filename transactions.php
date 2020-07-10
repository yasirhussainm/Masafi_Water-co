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
if ((isset($_POST['returned'])) && (isset($_POST['invoice'])) && (isset($_POST['name'])) && (isset($_POST['added'])))
{
        if (((strlen($_POST['name']))<1) || ((strlen($_POST['added']))<1)
              || ((strlen($_POST['returned']))<1) || ((strlen($_POST['invoice']))<1)) {
          $_SESSION['error'] = 'All fields are required';
          header('Location: add_customer.php');
          return;
        }
        if (!is_numeric($_POST['returned'])){
          $_SESSION['error'] = 'returned must be an integer';
          header('Location: add_customer.php');
          return;
        }
        if (!is_numeric($_POST['invoice'])){
          $_SESSION['error'] = 'invoice must be an integer';
          header('Location: add_customer.php');
          return;
        }

        $stmt = $pdo->prepare("SELECT customer_id,rem_bottles FROM customer where name = :name");
        $stmt->execute(array(":name" => $_POST['name']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false){
          $_SESSION['error'] = 'Could not find '.$_POST['name'];
          header('Location: transactions.php');
          return;
        }
        $cid = $row['customer_id'];
        $did = $_SESSION['driver_id'];
        $rem_bottles = $row['rem_bottles'];
        $rem_bottles = $rem_bottles + $_POST['added'] - $_POST['returned'];



        //INSERTING VALUES TO TRANSACTION TABLE
            $sql = "INSERT INTO transactions (customer_id,driver_id,added,returned,invoice_no,date)
                      VALUES (:customer_id, :driver_id, :added, :returned, :invoice, :date)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':customer_id'=>$cid,
                ':driver_id'=>$did,
                ':added'=>$_POST['added'],
                ':returned'=>$_POST['returned'],
                ':date'=>date('y/m/d h:i:s'),
                ':invoice'=>$_POST['invoice']));

        //UPDATING THE VALUE OF BOTTLES REMAINING WITH CUSTOMER IN CUSTOMER TABLE
            $sql = "UPDATE customer SET rem_bottles = :rem WHERE customer_id = :cid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':cid'=>$cid,
                ':rem'=>$rem_bottles));
            $_SESSION['success'] = "Record added";
            header('Location: agent_portal.php');
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
        Transactions
    </header>
    <div class="login-info">
        <p>Loged in as <?php echo(htmlentities((isset($_SESSION['driver'])) ? $_SESSION['driver'] : $_SESSION['admin'])); ?></p>
    </div>
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
<input type="text" name="name" id="name" placeholder="Name" class="transaction--field" style="margin: 0;"><br/>
<input type="number" name="added" id="added" placeholder="Added" class="transaction--field" style="margin: 0;"><br/>
<input type="number" name="returned" id="returned" placeholder="Returned" class="transaction--field" style="margin: 0;"><br/>
<input type="text" name="invoice" id="invoice" placeholder="Invoice" class="transaction--field" style="margin: 0;"><br/>
<div class="row">
<input type="submit" name="cancel" value="cancel">
<input type="submit" value="Add" style="margin-left: 10;">
</div>
</form>
<script>

$(document).ready(function(){
    window.console && console.log('Document ready called');
    $('.customer_name').autocomplete({
        source: "customer_name_json.php"
    });
});
</script>
</div>
</body>
