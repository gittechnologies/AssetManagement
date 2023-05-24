<?php

session_start();
	 include_once ('../conn.php');

	 
	$v_tenant_name=$_POST['tenantName'];
	$v_gender=$_POST['gender'];
	$v_dob=$_POST['dob'];
	$v_address=$_POST['address'];
	$v_state=$_POST['state'];
    $v_city=$_POST['city'];
	$v_pincode=$_POST['pincode'];
	$v_contact_number=$_POST['contactNumber'];
	$v_email=$_POST['emailId'];
	$v_occupation=$_POST['Occupation'];	
	$v_pan_no=$_POST['panNo'];
	$v_status_gst=$_POST['gstStatus'];
	$v_gst=$_POST['gstNo'];
	$v_company=$_POST['companyName'];
	$v_company_email=$_POST['companyEmail'];
    $v_status='Active';
    $v_last_modification_date='';
    $v_AddedBy=$_SESSION['Email'];
    $v_power_of_attorney=$_POST['power_of_attorney'];
    $v_UpdatedBy='';

     // <------------------- Insert Query------------------------->

	$sql = "INSERT INTO det_tenant (tenant_name, gender, dob, address, state_id, city_id, pincode, contact_number, email_id, pan_no,occupation, gst_status, gst_no, company_name, company_email, status,power_of_attorney, creation_date, last_modification_date, Added_by,Updated_by) VALUES ('$v_tenant_name','$v_gender','$v_dob','$v_address','$v_state','$v_city','$v_pincode','$v_contact_number','$v_email','$v_pan_no','$v_occupation','$v_status_gst','$v_gst','$v_company','$v_company_email','$v_status','$v_power_of_attorney',CURRENT_TIMESTAMP(),'$v_last_modification_date','$v_AddedBy','$v_UpdatedBy')";
    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

	//      <------------------------Alert---------------------->

 echo "<script>alert('Data successfully added!'); window.location='manage.php'</script>";

?>

