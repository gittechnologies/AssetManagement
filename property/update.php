<?php 
 session_start();
 include_once ('../conn.php');

	$v_property_id=$_POST['property_id'];
	$v_p_name=$_POST['property_name'];
	$v_p_type=$_POST['property_type'];
	// $v_owner_id=$_POST['owner_name'];
	$v_p_sub_type=0;
	if ($v_p_type == 'R')
	{
		$v_p_sub_type=$_POST['p_subType'];
	}
	else if($v_p_type == 'C')
	{
		$v_p_sub_type=$_POST['p_subType'];
	}
	else
	{
		$v_p_sub_type=$_POST['p_subType'];
	}
	
	$v_flatno=$_POST['unitNo'];
	$v_address=$_POST['address'];
	$v_landmark=$_POST['landmark'];
	$v_location=$_POST['location'];
	$v_state=$_POST['state'];
    $v_city=$_POST['city'];
	$v_pincode=$_POST['pincode'];
	$v_buildup_area=$_POST['buildUpArea'];
	$v_carpet_area=$_POST['carpetArea'];
	$v_age_of_property=$_POST['ageOfProperty'];
	$v_elec_meter_no=$_POST['elecMeter'];
    $v_covered_parking=$_POST['coveredParking'];
	$v_open_parking=$_POST['openParking'];
    $v_status='Active';
    $v_last_modification_date='';
    $v_added_by='';
    $v_update_by=$_SESSION['Email'];
	
	if ($v_p_type == "C") {
		$v_covered_parking = 0;
		$v_open_parking = 0;
	}

$sql = "UPDATE det_property SET property_name='$v_p_name', property_type='$v_p_type', property_sub_type='$v_p_sub_type', flat_no='$v_flatno', address='$v_address', landmark='$v_landmark',location='$v_location', state_id='$v_state', city_id='$v_city',pincode='$v_pincode',buildup_area='$v_buildup_area',carpet_area='$v_carpet_area',covered_parking='$v_covered_parking',open_parking='$v_open_parking',age_of_property='$v_age_of_property', elec_meter_no='$v_elec_meter_no', last_modification_date=CURRENT_TIMESTAMP(), Update_by = '$v_update_by' 
	WHERE property_id='$v_property_id' ";

 $query = $dbConn->prepare($sql);
 $dbConn->exec($sql);

  echo "<script>alert('Data successfully updated!'); window.location='manage.php'</script>";
?>