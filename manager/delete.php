<?php

 include_once ('../conn.php');

$id = $_GET['id'];
$sqlInv = $dbConn->query("SELECT agreement_id from det_agreement where manager_id='$id' and status='Active'");
$sqlInv->execute();
if($row = $sqlInv->fetch(PDO::FETCH_ASSOC))
    {
       echo "<script>alert('You can not delete this Commission Agent !')</script>";

    }else{
$v_status='InActive';
$sql = "UPDATE det_manager SET status='$v_status' WHERE Id='$id' ";
$query = $dbConn->prepare($sql);
$dbConn->exec($sql);
}
?>
<script type="text/javascript">
 window.location="manage.php";
</script>
