<?php

 include_once ('../conn.php');

$id = $_GET['id'];
$v_status='InActive';
$sql = "UPDATE det_agreement SET last_modification_date= CURRENT_TIMESTAMP(), 
status='$v_status' WHERE agreement_id='$id' ";
$query = $dbConn->prepare($sql);
$dbConn->exec($sql);

?>
<script type="text/javascript">
 window.location="manage.php";
</script>
