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

$v_file_desc=$_POST['fileDesc'];

$uploadOk = 1;

$v_director_name=$_POST['directorName'];
$v_address=$_POST['address'];
$v_pan_no=$_POST['panNo'];
$v_cin_llp=$_POST['cinLlp'];
$v_tenant_id=$_POST['tenant_id'];
$v_status = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  $sql= "INSERT INTO det_director (tenant_id, name, address, pan_no,cin_llp,status,file_name, file_path,  uploaded_by, file_desc) 
  VALUES ('$v_tenant_id', '$v_director_name','$v_address','$v_pan_no','$v_cin_llp','$v_status', '$v_file_name', '$target_file','$v_uploaded_by','$v_file_desc') ";
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
