<?php

 include_once ('../conn.php');

$id = $_GET['id'];
$sqlInv = $dbConn->query("SELECT agreement_id from det_agreement where tenant_id='$id' and status='Active'");
$sqlInv->execute();
if($row = $sqlInv->fetch(PDO::FETCH_ASSOC))
    {
       echo "<script>alert('You can not delete this tenant !')</script>";

    }else{
$v_status='InActive';
$sql = "UPDATE det_tenant SET status='$v_status' WHERE tenant_id='$id' ";
$query = $dbConn->prepare($sql);
$dbConn->exec($sql);
}
?>
<script type="text/javascript">
 window.location="manage.php";
</script>
