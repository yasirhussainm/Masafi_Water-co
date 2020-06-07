<?php
// Include the database configuration file
session_start();
include 'pdo.php';
$allow_types = array('jpg','png','jpeg','gif','pdf');

if(isset($_POST["submit"]) &&(isset($_POST['mobile'])) && (isset($_POST['iqama']))
        && (isset($_POST['name'])) && (isset($_POST['email']))) {
// File upload path
$targetDir = "uploads/";
$id=((isset($_SESSION['driver_id'])) ? $_SESSION['driver_id'] : $_SESSION['admin_id']);
//Generate A random file name based on current time and current loggend in user(considers micro seconds)
$file_name_iqama = round(microtime(true)).$id. '.' .pathinfo($_FILES["image_iqama"]["name"],PATHINFO_EXTENSION);
//Assigning new location to save file
$target_path_iqama = $targetDir . $file_name_iqama;
//Getting extension to determine file type
$file_type_iqama = pathinfo($target_path_iqama,PATHINFO_EXTENSION);
echo($target_path_iqama);

$file_name_agreement = round(microtime(true))+1 .$id. '.' .pathinfo($_FILES["image_agreement"]["name"],PATHINFO_EXTENSION);
$target_path_agreement = $targetDir . $file_name_agreement;
$file_type_agreement = pathinfo($target_path_agreement,PATHINFO_EXTENSION);

      if((empty($_FILES["image_iqama"]["name"]))  || (empty($_FILES["image_agreement"]["name"]))){
        $_SESSION['error'] = 'Please Select a file to upload';
      }
      if (((strlen($_POST['name']))<1) || ((strlen($_POST['email']))<1)
            || ((strlen($_POST['mobile']))<1) || ((strlen($_POST['iqama']))<1)) {
        $_SESSION['error'] = 'All fields are required';
        ##header('Location: add_customer.php');
        #return;
      }
      if (!is_numeric($_POST['mobile'])){
        $_SESSION['error'] = 'Invalid Mobile Number';
        #header('Location: add_customer.php');
        #return;
      }
      if (!is_numeric($_POST['iqama'])){
        $_SESSION['error'] = 'Invalid Iqama No';
        #header('Location: add_customer.php');
        #return;
      }
      if  (file_exists($target_path_iqama)) {
        $_SESSION['error'] = 'file exists';
        #header('Location: add_customer.php');
        #return;
      }
      if(!in_array($file_type_iqama, $allow_types)){
        $_SESSION['error'] = 'File Type is not supported';
        #header('Location: add_customer.php');
        #return;
      }
      if(!in_array($file_type_agreement, $allow_types)){
        $_SESSION['error'] = 'File Type is not supported';
        #header('Location: add_customer.php');
        #return;
      }
      if(!isset($_SESSION['error'])) {
        $sql = "INSERT INTO customer (name,email,mobile,iqama,rem_bottles,image_iqama,image_agreement)
                  VALUES (:name, :email, :mobile, :iqama, :rem_bottles, :image_iqama, :image_agreement)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name'=>$_POST['name'],
            ':email'=>$_POST['email'],
            ':mobile'=>$_POST['mobile'],
            ':rem_bottles'=>0,
            ':iqama'=>$_POST['iqama'],
            ':image_iqama'=>$file_name_iqama,
            ':image_agreement'=>$file_name_agreement));
        move_uploaded_file($_FILES["image_iqama"]["tmp_name"], $target_path_iqama);
        move_uploaded_file($_FILES["image_agreement"]["tmp_name"], $target_path_agreement);
        $_SESSION['success'] = "Record added";
        #header('Location: add_customer.php');
        #return;
      }


}
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}

?>
<p>
<a href="add_customer.php">Go Back</a>
