<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['customer_id']) ) {
    $sql = "DELETE FROM customer WHERE customer_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['customer_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that customer_id is present
if ( ! isset($_GET['customer_id']) ) {
  $_SESSION['error'] = "Missing customer_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT name, customer_id FROM customer where customer_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['customer_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for customer_id';
    header( 'Location: index.php' ) ;
    return;
}

?>
<p>Confirm: Deleting <?= htmlentities($row['name']) ?></p>

<form method="post">
<input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="view_customer.php">Cancel</a>
</form>
