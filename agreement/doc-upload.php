<?php
session_start();
include_once ('../conn.php');
include_once ('../path.php');


$v_file_name='';
$v_uploaded_by = $_SESSION["UserName"];
$target_file ='';
$fileType = '';
$newfilename ='';

if (!empty($_FILES)) {
  $temp = explode(".", $_FILES["file"]["name"]);

  $v_file_name = basename($_FILES["file"]["name"],'.'.end($temp));
  $v_file_name = str_replace(' ', '_',$v_file_name);
  $v_file_name = preg_replace('/[^A-Za-z\-]/', '', $v_file_name);

  $newfilename = $v_file_name.'_'.round(microtime(true)) . '.' . end($temp);
  
  $target_dir = UPLOADED_DOC .AGREEMENT .'/'.$_SESSION["id"];
  $target_file =  $target_dir .'/'.$newfilename;

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
$v_doc_id=$_POST['doc_id'];
$v_form_type=$_POST['form_type'];


$uploadOk = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if ($v_form_type == "add") {
    $sql= "INSERT INTO det_file_upload (agreement_id, file_name, file_path, doc_type, uploaded_by, uploaded_on, status, file_desc,stamp_duty_charges,registration_charges,legal_charges) VALUES ('$v_agreement_id', '$v_file_name', '$newfilename', 'A', '$v_uploaded_by',CURRENT_TIMESTAMP(),'1', '$v_file_desc','$v_stamp_duty_charge','$v_registration_fee','$v_legal_fee') ";
    
    $query = $dbConn->prepare($sql);
    $dbConn->exec($sql);
    echo "Data successfully added!";

    if (!empty($_FILES)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    } 
  } elseif ($v_form_type == "update" && isset($v_doc_id)) {

    $result = $dbConn->query("SELECT * FROM det_file_upload where agreement_id = '$v_agreement_id' AND doc_id ='$v_doc_id'");
    $result->execute();
    if($result->rowCount() > 0){
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $sql_sub_string = "";

      if (!empty($_FILES)) {
        if (!empty($row['file_path'])) {
          unlink($target_dir.'/'.$row['file_path']);
        }

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
        } 

        $sql_sub_string = " , file_name='$v_file_name' ,file_path='$newfilename' ";
      }

      $sql = "UPDATE det_file_upload SET agreement_id='$v_agreement_id', doc_type='A', uploaded_by=CURRENT_TIMESTAMP(), status='1', file_desc='$v_file_desc', stamp_duty_charges='$v_stamp_duty_charge',registration_charges='$v_registration_fee',legal_charges='$v_legal_fee' $sql_sub_string WHERE doc_id='$v_doc_id' ";
    
      $query = $dbConn->prepare($sql);
      $dbConn->exec($sql);
    
      echo "Data successfully updated!";
    
    }else{ 
        echo "Something went wrong, please try again later.";
    } 
  }
}

  ?>
