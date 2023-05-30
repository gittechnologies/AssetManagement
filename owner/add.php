<?php

session_start();
	 include_once ('../conn.php');

	 
	$v_owner_name=$_POST['ownerName'];
	$v_address=$_POST['address'];
	$v_state=$_POST['state'];
    $v_city=$_POST['city'];
	$v_pincode=$_POST['pincode'];
	$v_contact_number=$_POST['contactNumber'];
	$v_email=$_POST['emailId'];
	$v_pan_no=$_POST['panNo'];
	$v_status_gst= isset($_POST['gstStatus']) ?$_POST['gstStatus'] : '';
	$v_gst=$_POST['gstNo'];
	$v_company=$_POST['companyName'];
    $v_status='Active';
    $v_last_modification_date='';
    $v_AddedBy=$_SESSION['Email'];
    $v_bank_name=$_POST['bankName'];
    $v_branch_name=$_POST['branchName'];
    $v_account_no=$_POST['accountNo'];
    $v_ifsc_no=$_POST['ifscNo'];
    $v_UpdatedBy='';

     // <------------------- Insert Query------------------------->

	$sql = "INSERT INTO det_owner (owner_name, address, state_id, city_id, pincode, contact_number, email_id, pan_no, gst_status, gst_no, company_name,bank_name,branch_name,account_no,ifsc, status, creation_date, last_modification_date, Added_by,Updated_by) VALUES ('$v_owner_name','$v_address','$v_state','$v_city','$v_pincode','$v_contact_number','$v_email','$v_pan_no','$v_status_gst','$v_gst','$v_company','$v_bank_name','$v_branch_name','$v_account_no','$v_ifsc_no','$v_status',CURRENT_TIMESTAMP(),'$v_last_modification_date','$v_AddedBy','$v_UpdatedBy')";
    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

	//      <------------------------Alert---------------------->

 echo "<script>alert('Data successfully added!'); window.location='manage.php'</script>";

?>

