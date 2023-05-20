<?php
 session_start();
	 include_once ('../conn.php');
	$v_owner_id=$_POST['ownerId']; 
	$v_owner_name=$_POST['ownerName'];
	$v_address=$_POST['address'];
    $v_state=$_POST['state'];
    $v_city=$_POST['city'];
    $v_pincode=$_POST['pincode'];
    $v_contact_number=$_POST['contactNumber'];
    $v_email=$_POST['email'];
    $v_pan_no=$_POST['panNo'];
    $v_status_gst=$_POST['gstStatus'];    
    if ($v_status_gst)
    {
        $v_gst_no=$_POST['gstNo'];
        $v_company=$_POST['companyName'];
    }    
    else{
        $v_gst_no='';
        $v_company='';
    }
    $v_status='Active';
    $v_last_modification_date='';
    $v_AddedBy='';
    $v_UpdatedBy=$_SESSION['Email'];
    $v_bank_name=$_POST['bankName'];
    $v_branch_name=$_POST['branchName'];
    $v_account_no=$_POST['accountNo'];
    $v_ifsc_no=$_POST['ifscNo'];
    $v_Email='';

    $sql = "UPDATE det_owner SET owner_name='$v_owner_name', address='$v_address',state_id='$v_state', city_id='$v_city', pincode='$v_pincode',contact_number='$v_contact_number', email_id='$v_email',pan_no='$v_pan_no', gst_status='$v_status_gst', gst_no='$v_gst_no',company_name='$v_company', bank_name ='$v_bank_name',branch_name ='$v_branch_name',account_no ='$v_account_no',ifsc ='$v_ifsc_no', updated_by='$v_UpdatedBy', last_modification_date=CURRENT_TIMESTAMP() WHERE owner_id='$v_owner_id' ";
 $query = $dbConn->prepare($sql);
 $dbConn->exec($sql);

 echo "<script>alert('Data successfully Updated!'); window.location='manage.php'</script>";
?>