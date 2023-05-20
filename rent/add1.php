	<?php
 include_once ('../conn.php');

	$v_property_name=$_POST['propertyName'];
	$v_party_name=$_POST['partyName'];
	$v_file_name=$_POST['fileName'];
	$v_document="reassetmanagement\lease\documents";
    $v_status="Active";

	$sql= "INSERT INTO images (property_name, party_name, file_name, document, status) VALUES ('$v_property_name', '$v_party_name', '$v_file_name', '$v_document', '$v_status') ";
	    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

  echo "<script>alert('Data successfully added!'); window.location='rent-details.php'</script>";

?>