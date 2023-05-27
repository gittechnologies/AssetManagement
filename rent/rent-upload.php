<?php
session_start();
include_once ('../conn.php');
include_once ('../path.php');

$target_dir = "";
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
  
  $target_dir = UPLOADED_DOC .RENT .'/'.$_SESSION["id"];
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
$v_rent_details_id=$_POST['rent_details_id'];
$v_form_type=$_POST['form_type'];

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

  if ($v_form_type == "add") { 
    $sql= "INSERT INTO det_rent_details (rent_id, amount_paid, payment_date, payment_mode, file_name, file_path , file_desc, uploaded_by, uploaded_on, status) 
    VALUES ('$v_rent_id', '$v_amount_paid','$v_payment_date','$v_mode', '$v_file_name', '$newfilename', '$v_file_desc', '$v_uploaded_by',CURRENT_TIMESTAMP(),'1') ";
    $query = $dbConn->prepare($sql);
    $insert_result = $dbConn->exec($sql);

    $sqlUpd= "update det_rent set rent_status = '$rent_status' 
    where rent_id = '$v_rent_id' ";
    $query = $dbConn->prepare($sqlUpd);
    $dbConn->exec($sqlUpd);


    if (!empty($_FILES)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    } 
  } elseif ($v_form_type == "update" && isset($v_rent_details_id)) {

    $result = $dbConn->query("SELECT * FROM det_rent_details where rent_id = '$v_rent_id' AND rent_details_id ='$v_rent_details_id'");
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

      $sql = "UPDATE det_rent_details SET rent_id='$v_rent_id', file_desc='$v_file_desc', amount_paid='$v_amount_paid',payment_date='$v_payment_date',payment_mode='$v_mode',file_desc ='$v_file_desc', uploaded_by ='$v_uploaded_by', uploaded_on=CURRENT_TIMESTAMP(), status='1'  $sql_sub_string WHERE rent_details_id='$v_rent_details_id' ";
    
      $query = $dbConn->prepare($sql);
      $dbConn->exec($sql);
      
      $sqlUpd= "update det_rent set rent_status = '$rent_status' 
      where rent_id = '$v_rent_id' ";
      $query = $dbConn->prepare($sqlUpd);
      $dbConn->exec($sqlUpd);

      echo "Data successfully updated!";
    
    }else{ 
        echo "Something went wrong, please try again later.";
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
