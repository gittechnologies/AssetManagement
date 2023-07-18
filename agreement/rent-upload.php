<?php
session_start();
include_once ('../conn.php');

$target_dir = "/uploadedDoc/";

$v_file_name='';
$v_uploaded_by = $_SESSION["UserName"];
$target_file ='';
$fileType = '';

if (!empty($_FILES)) {
  $v_file_name = basename($_FILES["file"]["name"]);
  $target_dir = $target_dir. $_SESSION["UserName"].'/';

  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if file already exists
  if (!file_exists($target_dir)) {
    echo "Inside directory not exist";
    mkdir($target_dir,0777,true);
  }

  // Check file size
  if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
  && $fileType != "gif" && $fileType != "pdf" && $fileType != "doc") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
}



$v_agreement_id=$_POST['agreement_id'];
$v_type=$_POST['type_id'];
$v_amount=$_POST['amount'];
$v_over_due_amount=$_POST['overdueAmount'];
$v_amount_tobe_paid=$_POST['amountToBePaid'];
$v_amount_paid=$_POST['amountPaid'];
$v_next_due=$_POST['nextDue'];
$v_next_due_date=date("Y-m-d", strtotime($_POST['nextDueDate']));
$v_mode=$_POST['payment_mode'];
$v_pay_status=$_POST['pay_Status'];
$v_file_desc=$_POST['fileName'];

$v_total_rent = 0;


$uploadOk = 1;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


  $sql= "INSERT INTO det_rent_details (agreement_id, total_rent, rent_amount, overdue_amount,amount_to_paid, amount_paid,next_due,next_due_date, payment_mode, type, payment_status, file_name,  file_path, uploaded_by, uploaded_on, status, file_desc) 
  VALUES ('$v_agreement_id', '$v_total_rent', '$v_amount','$v_over_due_amount','$v_amount_tobe_paid','$v_amount_paid','$v_next_due','$v_next_due_date','$v_mode', '$v_type', '$v_pay_status', '$v_file_name', '$target_file', '$v_uploaded_by',CURRENT_TIMESTAMP(),'1', '$v_file_desc') ";

  $query = $dbConn->prepare($sql);
  $dbConn->exec($sql);

  if (!empty($_FILES)) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } 

  // if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

  //   $query = $dbConn->prepare($sql);
  //   $dbConn->exec($sql);

  //   echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
  // } else {
  //   echo "Sorry, there was an error uploading your file.";
  // }
}

  ?>
