<?php
 session_start();
	 include_once ('../conn.php');
	$v_tenant_id=$_POST['tenantId']; 
	$v_tenant_name=$_POST['tenantName'];
	$v_tenant_type=$_POST['tenantType'];
	$v_address=$_POST['address'];
    $v_state=$_POST['state'];
    $v_city=$_POST['city'];
    $v_pincode=$_POST['pincode'];
    $v_contact_number=$_POST['contactNumber'];
    $v_email=$_POST['email'];
    $v_pan_no=$_POST['panNo'];
    $v_occupation=$_POST['Occupation'];
    $v_status_gst=$_POST['gstStatus'];    

    if ($v_status_gst)
    {
        $v_gst_no=$_POST['gstNo'];
        $v_company=$_POST['companyName'];
        $v_company_email=$_POST['companyEmail'];
    }    
    else{
        $v_gst_no='';
        $v_company='';
        $v_company_email='';
    }
    $v_status='Active';
    $v_last_modification_date='';
    $v_AddedBy='';
    $v_UpdatedBy=$_SESSION['Email'];
    $v_Email='';
    $v_power_of_attorney=$_POST['power_of_attorney'];

    if ($v_tenant_type == 'NI')
    {
        $v_power_of_attorney = 0;
    }
    

    $sql = "UPDATE det_tenant SET tenant_name='$v_tenant_name', address='$v_address',state_id='$v_state', city_id='$v_city', pincode='$v_pincode',contact_number='$v_contact_number', email_id='$v_email',pan_no='$v_pan_no', occupation='$v_occupation', gst_status='$v_status_gst', gst_no='$v_gst_no',company_name='$v_company', company_email='$v_company_email', 	tenantType='$v_tenant_type', updated_by='$v_UpdatedBy', power_of_attorney ='$v_power_of_attorney',last_modification_date=CURRENT_TIMESTAMP() WHERE tenant_id='$v_tenant_id' ";
 $query = $dbConn->prepare($sql);
 $dbConn->exec($sql);

 echo "<script>alert('Data successfully Updated!'); window.location='manage.php'</script>";
?>