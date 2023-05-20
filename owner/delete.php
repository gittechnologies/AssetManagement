<?php

 include_once ('../conn.php');

$id = $_GET['id'];
$sqlInv = $dbConn->query("SELECT property_id from det_property where owner_id='$id' and status='Active'");
$sqlInv->execute();
if($row = $sqlInv->fetch(PDO::FETCH_ASSOC))
    {
       echo "<script>alert('You can not delete this owner !')</script>";

    }else{
$v_status='InActive';
$sql = "UPDATE det_owner SET status='$v_status' WHERE owner_id='$id' ";
$query = $dbConn->prepare($sql);
$dbConn->exec($sql);
}
?>
<script type="text/javascript">
 window.location="manage.php";
</script>
