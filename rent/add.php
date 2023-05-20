<?php 
session_start();
include_once ('../conn.php'); ?>	
<?php

	$v_gstStatus = 'N';
	$v_gstAmt='0';
	$v_agreement_id=$_POST['agreement'];
	$v_rent_date=$_POST['rentDate'];
	$v_base_rent=$_POST['baseRent'];
	// $v_otherChargesDesc=$_POST['otherChargesDesc'];
	// $v_otherChargesAmt=$_POST['otherChargesAmt'];
	$v_total_amount=$_POST['totalAmount'];
	$v_otherCharges=$_POST['otherCharges'];
	

	if(!isset($_POST['gstStatus'])) {
    	$v_gstStatus= 'N';
    	$v_gstAmt= '0';

    }else{
        $v_gstStatus = 'Y';
        $v_gstAmt=$_POST['gstAmt'];;
    }

	
    $v_status='Active';
    $v_AddedBy=$_SESSION['Email'];
    $v_UpdatedBy='';
	$v_invoice = '';

	$sqlInv = $dbConn->query("SELECT prefix, id+1 as id, 
		convert(lpad(id+1,4,'0'),CHAR) as inv, suffix FROM seq_invoice");

	$sqlInv->execute();
	if($row = $sqlInv->fetch(PDO::FETCH_ASSOC))
	{


    $v_id = $row['id'];
    $v_inv = $row['inv'];
    $v_prefix = $row['prefix'];
    $v_suffix = $row['suffix'];

	//while($row = $sqlInv->fetch(PDO::FETCH_ASSOC)){ 

		$v_invoice = $v_prefix.''.$v_inv.''.$v_suffix;

		$sqlUpd = "UPDATE seq_invoice SET ID = '$v_id'";

	    $query = $dbConn->prepare($sqlUpd);
		$dbConn->exec($sqlUpd);
	//}
	

}else
	{
		$v_invoice = 'INV_0001';
		$sqlIns = "INSERT INTO seq_invoice (prefix, id, suffix) 
		VALUES ('INV_', '0001','')";

	    $query = $dbConn->prepare($sqlIns);
		$dbConn->exec($sqlIns);
	}

     // <------------------- Insert Query------------------------->
	$sql = "INSERT INTO det_rent (agreement_id, rent_date, rent_amount , gst_status, gst_amount, total_amount, invoice_no, creation_date, last_modification_date, status, Added_by, Update_by, rent_status) VALUES ('$v_agreement_id', '$v_rent_date', '$v_base_rent', 
		'$v_gstStatus', '$v_gstAmt', '$v_total_amount', '$v_invoice', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '$v_status', '$v_AddedBy', '$v_UpdatedBy','UNPAID')";

    $query = $dbConn->prepare($sql);
	$rentResult = $dbConn->exec($sql);
	$rent_id = $dbConn->lastInsertId();

	if ($rentResult) {

		if (count($v_otherCharges) > 0) {
			foreach ($v_otherCharges as $oc) {
				$v_otherChargesDesc = $oc['otherChargesDesc'];
				$v_otherChargesAmt = $oc['otherChargesAmt'];

				if (isset($v_otherChargesAmt) && isset($v_otherChargesDesc)) {
					$other_charges_sql = "INSERT INTO det_rent_other_charges (rent_id, charges_description, amount) VALUES ('$rent_id', '$v_otherChargesDesc', '$v_otherChargesAmt')";
			
					$dbConn->prepare($other_charges_sql);
					$dbConn->exec($other_charges_sql);
				}
			}
		}
	}

  echo "<script>alert('Data successfully added!');
		if (confirm('You want to generate invoce?') == true) {
      	var url = 'invoice.php?id='+encodeURIComponent('$v_invoice');
      	popupWindow = window.open(url,'_blank',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
      //alert('Deleted Successfully !');
    }
		window.location='manage.php';</script>";
?>

