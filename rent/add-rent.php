	<?php
 include_once ('../conn.php');

	$v_property_name=$_POST['propertyName'];
	$v_party_name=$_POST['partyName'];
    $v_year=$_POST['year'];
	$v_fromMonth=$_POST['fromMonth'];
	$v_toMonth=$_POST['toMonth'];
	$v_rentAmount=$_POST['rentAmount'];
	$v_fileName=$_POST['fileName'];
	$v_document="reassetmanagement\lease\documents";
    $v_status="Active";

	$sql= "INSERT INTO images (property_name, party_name, year, from_month, to_month, rent_amount ,file_name, document, status, file_desc) VALUES ('$v_property_name', '$v_party_name', '$v_year', '$v_fromMonth', '$v_toMonth', '$v_rentAmount', '$v_fileName' ,'$v_document', '$v_status') ";
	    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

  echo "<script>alert('Data successfully added!'); window.location='rent.php'</script>";

?>