<?php 
session_start();
include_once ('../conn.php'); ?>	
<?php

	$v_gstStatus = 'N';
	$v_gstAmt='0';
	$v_propertyName=$_POST['propertyName'];
	$v_tenant_id=$_POST['tenantName'];
	$v_owner_id=$_POST['ownerName'];


	$v_agreementDate=date("Y-m-d", strtotime($_POST['agreementDate']));
	$v_agreementFrom=date("Y-m-d", strtotime($_POST['agreementFrom']));
	$v_agreementTo=date("Y-m-d", strtotime($_POST['agreementTo']));
	$v_possessionDate=date("Y-m-d", strtotime($_POST['possessionDate']));

	$v_lockingPeriod=$_POST['lockingPeriod'];
	$v_depositAmount=$_POST['depositAmount'];
	$v_depositDate=date("Y-m-d", strtotime($_POST['depositDate']));
	$v_baseRent=$_POST['baseRent'];


	if(!isset($_POST['gstStatus'])) {
    	$v_gstStatus= 'N';
    	$v_gstAmt= '0';

    }else{
        $v_gstStatus = 'Y';
        $v_gstAmt=$_POST['gstAmt'];;
    }

	$v_maintainceCharges=$_POST['maintainceCharges'];

	// $v_charges=$_POST['charges'];        
      
	$v_manager_id=$_POST['managerName'];
	$v_brokerage=$_POST['Brokerage'];
	$v_loading_charges=$_POST['loadingCharges'];
	$v_amc_tenant=$_POST['AmcTenant'];
	$v_remark=$_POST['remark'];

    $v_status='Active';
    $v_AddedBy=$_SESSION['Email'];
    $v_UpdatedBy='';

     // <------------------- Insert Query------------------------->
	$sql = "INSERT INTO det_agreement (property_id,owner_id, tenant_id, agreement_date, agreement_from, agreement_to, possession_date, locking_period, deposit_amount, deposit_date, rent_per_month, gst_applicable, gst_amount, maintainance_charges, manager_id,brokerage,loading_charges,amc_tenant,remark, status, creation_date, last_modification_date, Added_by, Updated_by) VALUES ('$v_propertyName', '$v_owner_id', '$v_tenant_id', '$v_agreementDate','$v_agreementFrom', '$v_agreementTo', '$v_possessionDate','$v_lockingPeriod', '$v_depositAmount', '$v_depositDate', '$v_baseRent', '$v_gstStatus', '$v_gstAmt','$v_maintainceCharges', '$v_manager_id','$v_brokerage', '$v_loading_charges','$v_amc_tenant','$v_remark','$v_status', CURRENT_TIMESTAMP() , CURRENT_TIMESTAMP(), '$v_AddedBy', '$v_UpdatedBy')";

    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);


  echo "<script>alert('Data successfully added!'); window.location='manage.php'</script>";

?>

