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
$v_file_desc=$_POST['fileDesc'];
$v_stamp_duty_charge=$_POST['stampdutyCharges'];
$v_registration_fee=$_POST['registrationFee'];
$v_legal_fee=$_POST['legalFee'];

$uploadOk = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


  $sql= "INSERT INTO det_file_upload (agreement_id, file_name, file_path, doc_type, uploaded_by, uploaded_on, status, file_desc,stamp_duty_charges,registration_charges,legal_charges) VALUES ('$v_agreement_id', '$v_file_name', '$target_file', 'A', '$v_uploaded_by',CURRENT_TIMESTAMP(),'1', '$v_file_desc','$v_stamp_duty_charge','$v_registration_fee','$v_legal_fee') ";
  
  $query = $dbConn->prepare($sql);
  $dbConn->exec($sql);

  if (!empty($_FILES)) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } 
}

  ?>
