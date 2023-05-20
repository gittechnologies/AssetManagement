<?php
 session_start();

	include_once ('../conn.php');
	$v_Id=$_POST['Id']; 
	$v_manager_name=$_POST['managerName'];
	$v_address=$_POST['address'];
	$v_location=$_POST['location'];//new
	$v_state=$_POST['state'];
    $v_city=$_POST['city'];
	$v_pincode=$_POST['pincode'];
	$v_contact_no=$_POST['contactNumber'];
	$v_email=$_POST['email'];	
	// $v_brokerage=$_POST['Brokerage'];
	$v_status_gst=$_POST['gstStatus'];
	$v_gst_no=$_POST['gstNo'];
	$v_company_name=$_POST['companyName'];
    $v_status='Active';
    $v_last_modification_date='';
    $v_AddedBy='';
    $v_UpdatedBy=$_SESSION['Email'];


    $sql = "UPDATE det_manager SET manager_name='$v_manager_name', address='$v_address', location='$v_location', state_id='$v_state', city_id='$v_city',pincode='$v_pincode', contact_number='$v_contact_no', email_id='$v_email', gst_status='$v_status_gst', gst_no='$v_gst_no', company_name='$v_company_name',updated_by='$v_UpdatedBy',last_modification_date=CURRENT_TIMESTAMP()  WHERE manager_id='$v_Id' ";

 $query = $dbConn->prepare($sql);
 $dbConn->exec($sql);

 echo "<script>alert('Data successfully Updated!'); window.location='manage.php'</script>";
?>