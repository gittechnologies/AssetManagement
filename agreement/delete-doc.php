<?php

 include_once ('../conn.php');

$id = $_POST['id'];

$v_status='0';
$sql = "UPDATE det_file_upload SET status='$v_status' WHERE doc_id='$id' ";

$query = $dbConn->prepare($sql);
$dbConn->exec($sql);

echo "Files deleted successfully";

?>

 
