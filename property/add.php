<?php 
session_start();
include_once ('../conn.php'); ?>	
<?php 
	$v_p_name=$_POST['propertyName'];
	$v_p_type=$_POST['prop_type'];
	$v_p_sub_type=$_POST['p_subType'];//new
	$v_owner_id=$_POST['owner_name'];//new
	$v_flatno=$_POST['unitNo'];
	$v_address=$_POST['address'];
	$v_landmark=$_POST['landmark'];
	$v_location=$_POST['location'];//new
	$v_state=$_POST['state'];
    $v_city=$_POST['city'];
	$v_pincode=$_POST['pincode'];
	$v_buildup_area=$_POST['buildUpArea'];
	$v_carpet_area=$_POST['carpetArea'];
	$v_age_of_property=$_POST['ageOfProperty'];
	$v_elecMeter=$_POST['elecMeter'];
    $v_covered_parking=$_POST['coveredParking'];
	$v_open_parking=$_POST['openParking'];
    $v_status='Active';
    $v_last_modification_date='';
    $v_added_by=$_SESSION['Email'];
    // $v_property_tax_no=$_SESSION['propertyTaxNo'];
    $v_update_by='';
  

	if ($v_p_type == "C") {
		$v_covered_parking = 0;
		$v_open_parking = 0;
	}

     // <------------------- Insert Query------------------------->

	$sql = "INSERT INTO det_property (property_name, property_type, property_sub_type, owner_id, flat_no, address, landmark, location, state_id, city_id, pincode, buildup_area, age_of_property,carpet_area,covered_parking,open_parking,elec_meter_no,status,creation_date,last_modification_date,added_by,Update_by) VALUES ('$v_p_name','$v_p_type','$v_p_sub_type','$v_owner_id','$v_flatno','$v_address','$v_landmark','$v_location','$v_state','$v_city','$v_pincode','$v_buildup_area','$v_carpet_area','$v_age_of_property','$v_covered_parking','$v_open_parking','$v_elecMeter','$v_status',CURRENT_TIMESTAMP(),'$v_last_modification_date','$v_added_by','$v_update_by')";
    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

	//      <------------------------Alert---------------------->

 echo "<script>alert('Data successfully added!');window.location='manage.php'</script>";

?>

