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

  $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

}



$v_agreement_id=$_POST['agreement_id'];
$v_rent_id=$_POST['rent_id'];
$v_tot_due=$_POST['totalDue'];
$v_invoice_amount=$_POST['invoiceAmount'];
$v_amount_paid=$_POST['amountPaid'];
$v_payment_date=$_POST['paymentDate'];
$v_mode=$_POST['payment_mode'];
$v_file_desc=$_POST['fileName'];

$v_total_rent = 0;
$rent_status = 'UNPAID';

if($v_tot_due > 0 && $v_tot_due < $v_invoice_amount)
{
  $rent_status = 'PART_PAID';
}

if($v_tot_due = 0)
{
  $rent_status = 'PAID';
}

$uploadOk = 1;



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


  $sql= "INSERT INTO det_rent_details (rent_id, amount_paid, payment_date, payment_mode, file_name, file_path , file_desc, uploaded_by, uploaded_on, status) 
  VALUES ('$v_rent_id', '$v_amount_paid','$v_payment_date','$v_mode', '$v_file_name', '$target_file', '$v_file_desc', '$v_uploaded_by',CURRENT_TIMESTAMP(),'1') ";

  $sqlUpd= "update det_rent set rent_status = '$rent_status' 
  where rent_id = '$v_rent_id' ";
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

  //   $query = $dbConn->prepare($sqlUpd);
  //   $dbConn->exec($sqlUpd);

  //   echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
  // } else {
  //   echo "Sorry, there was an error uploading your file.";
  // }
}

  ?>
