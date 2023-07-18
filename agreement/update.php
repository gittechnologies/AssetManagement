<?php
 session_start();
 include_once ('../conn.php');


    $v_gstStatus = 'N';
    $v_gstAmt='0';
    $v_agreementId=$_POST['agreementId'];
    $v_propertyName=$_POST['propertyName'];
    $v_owner_id = $_POST['ownerName'];
    $v_tenanty_Id=$_POST['tenantyName'];
    $v_brokerage=$_POST['Brokerage'];

    $v_agreementDate=date("Y-m-d", strtotime($_POST['agreementDate']));
	$v_agreementFrom=date("Y-m-d", strtotime($_POST['agreementFrom']));
	$v_agreementTo=date("Y-m-d", strtotime($_POST['agreementTo']));
	$v_possessionDate=date("Y-m-d", strtotime($_POST['possessionDate']));
	$v_depositDate=date("Y-m-d", strtotime($_POST['depositDate']));

    $v_lockingPeriod=$_POST['lockingPeriod'];
    $v_depositAmount=$_POST['depositAmount'];
    $v_baseRent=$_POST['baseRent'];
    $v_loading_charges=$_POST['loadingCharges'];
	$v_amc_tenant=$_POST['AmcTenant'];
	$v_remark=$_POST['remark'];



    if(!isset($_POST['gstStatus'])) {
        $v_gstStatus= 'N';
        $v_gstAmt= '0';

    }else{
        $v_gstStatus = 'Y';
        $v_gstAmt=$_POST['gstAmt'];;
    }

    $v_maintainceCharges=$_POST['maintainceCharges'];
    // foreach ($_GET['charges'] as $value) {
    //         $v_charges.= $value.", ";
    //     }
    // $v_charges=$_POST['charges'];    
    //$v_otherChargesDesc=$_POST['otherChargesDesc'];
    //$v_otherChargesAmt=$_POST['otherChargesAmt'];
    $v_UpdatedBy=$_SESSION['Email'];



    $sql = "UPDATE det_agreement SET property_id='$v_propertyName', owner_id = '$v_owner_id',
    tenant_id='$v_tenanty_Id', agreement_date = '$v_agreementDate', 
    agreement_from='$v_agreementFrom', agreement_to='$v_agreementTo', 
    possession_date='$v_possessionDate', locking_period='$v_lockingPeriod', 
    deposit_amount='$v_depositAmount', deposit_date='$v_depositDate', 
    rent_per_month='$v_baseRent', gst_applicable='$v_gstStatus', gst_amount='$v_gstAmt', maintainance_charges='$v_maintainceCharges',brokerage='$v_brokerage', loading_charges = '$v_loading_charges',amc_tenant = '$v_amc_tenant', remark='$v_remark',last_modification_date=CURRENT_TIMESTAMP(), updated_by='$v_UpdatedBy' WHERE agreement_id='$v_agreementId' ";

 $query = $dbConn->prepare($sql);
 $dbConn->exec($sql);

  echo "<script>alert('Data successfully Updated!'); window.location='manage.php'</script>";
?>