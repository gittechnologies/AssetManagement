<?php
session_start();
include_once ('../conn.php');

$v_property_id=$_POST['property_id'];
$v_owner_id=$_POST['owner_name'];
$v_unit_no=$_POST['unitNo'];
$v_property_tax=$_POST['property_tax'];
$v_build_up_area=$_POST['buildUpArea'];
$v_owner_property_id=$_POST['ownerPropId'];
$v_form_type=$_POST['form_type'];
$v_status = 1;

if (empty($v_owner_id)) {
  echo "Select owner";
} elseif (empty($v_build_up_area)) {
  echo "Add buildup area";
}

if (empty($v_unit_no)) {
  $v_unit_no = 0;
}

if ($v_form_type == "add") {
  if (isset($v_property_id) && isset($v_owner_id) && isset($v_unit_no) && isset($v_property_tax) && !empty($v_owner_id) && !empty($v_build_up_area)) {
    $sql= "INSERT INTO det_owner_property (property_id, owner_id, unitNo, property_tax,buildup_area,status) 
    VALUES ('$v_property_id', '$v_owner_id','$v_unit_no','$v_property_tax','$v_build_up_area','$v_status') ";
  
    $query = $dbConn->prepare($sql);
    $dbConn->exec($sql);
   echo "Data successfully added!";
  }
} elseif ($v_form_type == "update" && isset($v_owner_property_id)) {

  $result = $dbConn->query("SELECT * FROM det_owner_property where property_id = '$v_property_id' AND id='$v_owner_property_id'");
  $result->execute();
  if($result->rowCount() > 0){
    $sql = "UPDATE det_owner_property SET property_id='$v_property_id', owner_id='$v_owner_id', unitNo='$v_unit_no', property_tax='$v_property_tax', buildup_area='$v_build_up_area', status='$v_status',updated_at=CURRENT_TIMESTAMP() WHERE id='$v_owner_property_id' ";
  
   $query = $dbConn->prepare($sql);
   $dbConn->exec($sql);

   echo "Data successfully updated!";

  }else{ 
      echo "Something went wrong, please try again later.";
  } 

}


  ?>
