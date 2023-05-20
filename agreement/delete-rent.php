<?php

 include_once ('../conn.php');

$id = $_POST['id'];
$v_status='0';

$sql = "UPDATE det_rent_details SET status='$v_status' WHERE id='$id' ";
$query = $dbConn->prepare($sql);
$dbConn->exec($sql);

echo "Files deleted successfully";
?>
