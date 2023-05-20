<?php
session_start();
	 include_once ('../conn.php');
	 
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
    $v_AddedBy=$_SESSION['Email'];
    $v_UpdatedBy='';


     // <------------------- Insert Query------------------------->

	$sql = "INSERT INTO det_manager (manager_name,address,location,state,city,pincode,contact_no,email,gst_status,gst_no,company_name,status,creation_date,last_modification_date,Added_by,Updated_by) VALUES ('$v_manager_name','$v_address','$v_location','$v_state','$v_city','$v_pincode','$v_contact_no','$v_email','$v_status_gst','$v_gst_no','$v_company_name','$v_status',CURRENT_TIMESTAMP(),'$v_last_modification_date','$v_AddedBy','$v_UpdatedBy')";
    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

	//      <------------------------Alert---------------------->

 echo "<script>alert('Data successfully added!'); window.location='manage.php'</script>";

?>

