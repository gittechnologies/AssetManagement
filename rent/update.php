<?php
 session_start();
 include_once ('../conn.php');


    $v_gstStatus = 'N';
    $v_gstAmt='0';
    
    $v_rent_id=$_POST['rentId'];
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

    $v_UpdatedBy=$_SESSION['Email'];

    $sql = "UPDATE det_rent SET agreement_id='$v_agreement_id',
    rent_date = '$v_rent_date', rent_amount='$v_base_rent', gst_status='$v_gstStatus', gst_amount='$v_gstAmt', total_amount='$v_total_amount', 
    last_modification_date=CURRENT_TIMESTAMP(), update_by='$v_UpdatedBy' WHERE rent_id='$v_rent_id' ";

 $query = $dbConn->prepare($sql);
 $rentResult = $dbConn->exec($sql);

 if ($rentResult) {

    if (count($v_otherCharges) > 0) {
        $delete_charges_sql = "DELETE FROM det_rent_other_charges WHERE rent_id='$v_rent_id'";
                
        $dbConn->prepare($delete_charges_sql);
        $deleteResult = $dbConn->exec($delete_charges_sql);

        foreach ($v_otherCharges as $oc) {
            $v_otherChargesDesc = $oc['otherChargesDesc'];
            $v_otherChargesAmt = $oc['otherChargesAmt'];

            if (isset($v_otherChargesAmt) && isset($v_otherChargesDesc)) {

                $other_charges_sql = "INSERT INTO det_rent_other_charges (rent_id, charges_description, amount) VALUES ('$v_rent_id', '$v_otherChargesDesc', '$v_otherChargesAmt')";
        
                $dbConn->prepare($other_charges_sql);
                $dbConn->exec($other_charges_sql);
            }
        }
    }
}

  echo "<script>alert('Data successfully Updated!'); 
    if (confirm('You want to generate invoce?') == true) {
        var url = 'invoice.php?id='+encodeURIComponent('$v_rent_id');
        popupWindow = window.open(url,'_blank',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
      //alert('Deleted Successfully !');
           
    }
 window.location='manage.php';
    </script>";
  
?>