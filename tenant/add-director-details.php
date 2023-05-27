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
  // $v_file_name = str_replace(' ', '_',$v_file_name);
  // $v_file_name = preg_replace('/[^A-Za-z\-]/', '', $v_file_name);

  $newfilename = $v_file_name.'_'.round(microtime(true)) . '.' . end($temp);
  
  $target_dir = UPLOADED_DOC .TENANT .'/'.$_SESSION["id"];
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

$v_file_desc=$_POST['fileDesc'];

$uploadOk = 1;

$v_director_name=$_POST['directorName'];
$v_address=$_POST['address'];
$v_pan_no=$_POST['panNo'];
$v_cin_llp=$_POST['cinLlp'];
$v_tenant_id=$_POST['tenant_id'];
$v_status = 1;
$v_director_id=$_POST['director_id'];
$v_form_type=$_POST['form_type'];

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if ($v_form_type == "add") {
    $sql= "INSERT INTO det_director (tenant_id, name, address, pan_no,cin_llp,status,file_name, file_path,  uploaded_by, file_desc) 
    VALUES ('$v_tenant_id', '$v_director_name','$v_address','$v_pan_no','$v_cin_llp','$v_status', '$v_file_name', '$newfilename','$v_uploaded_by','$v_file_desc') ";
    $query = $dbConn->prepare($sql);
    $dbConn->exec($sql);

    if (!empty($_FILES)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    } 
  } elseif ($v_form_type == "update" && isset($v_director_id)) {

    $result = $dbConn->query("SELECT * FROM det_director where tenant_id = '$v_tenant_id' AND id ='$v_director_id'");
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

      $sql = "UPDATE det_director SET tenant_id='$v_tenant_id', name='$v_director_name',status='$v_status', address='$v_address', pan_no='$v_pan_no',cin_llp='$v_cin_llp',uploaded_by='$v_uploaded_by', file_desc= '$v_file_desc' $sql_sub_string WHERE id='$v_director_id' ";
    
      $query = $dbConn->prepare($sql);
      $dbConn->exec($sql);
    
      echo "Data successfully updated!";
    
    }else{ 
        echo "Something went wrong, please try again later.";
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
