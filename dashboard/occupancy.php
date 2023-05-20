<?php define('URL', 'http://localhost/pms/'); ?>

<!DOCTYPE html>
<html>
<?php
 session_start();
 include_once ('../conn.php');
 ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" type="text/css" href="<?php echo URL ?>css/tempusdominus-bootstrap-4.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/icheck-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/jqvmap.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/asset-style.css">
<link rel="stylesheet" href="<?php echo URL ?>css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/daterangepicker.css">
<link rel="stylesheet" href="<?php echo URL ?>css/summernote-bs4.min.css">
<link href="<?php echo URL ?>css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo URL ?>css/style.css">
<link rel="stylesheet" href="<?php echo URL ?>css/responsive.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.min.css">
<style >
div li.abc2 {
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:20px;
  height:25px;
  border-radius:50%;
  background-color:#000;
  color:#fff;
}

body {
  font-family: 'Poppins';
  margin-left: 0px;
}
.hide {
  display: none;
}
p {
  font-weight: normal;
}

div class.content-wrapper
{
  margin: 0px!important;
}

</style>
</head>
<body>
<div class="content-wrapper" style="margin: 0px!important;">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Occupied Property</h3>
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Occupied Property</li>
     </ol>
      </div>
   </div>
   </div>
   </div>
   </div>
</section>

<section class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="card">
     <div class="flash-message">
      <div class="row m-2">
       <div class="col-lg-6 col-md-6 col-xs-6">
 </div> 
 <div class="col-lg-6 col-md-6 col-xs-6" style="text-align:right">
 </div> 
</div>
  
<div class="card-body">
 <div class="table-responsive">
<table class="table table-bordered">
 <thead>
  <tr>
    <th>Sr. No.</th>
    <th>Property Name</th>
    <th>Tenant Name</th>
    <th>Owner</th>
    <th>Rent Per Month(Rs.)</th>
    <th>Commission Agent</th>    
    <th>Status</th>
  </tr>
  </thead>
<tbody>
 <?php 
  $result = $dbConn->query("SELECT 
concat(p.property_name,', ',p.flat_no,', ',p.address,', ',p.landmark,', ',p.location,'-',p.pincode) as property,
concat(t.tenant_name,'-',t.pan_no) as tenant, a.rent_per_month,
(select concat(m.manager_name,'-',m.pan_no) from det_manager m where m.manager_id=a.manager_id) as manager,
(select concat(o.owner_name,'-',o.pan_no) from det_owner o where o.owner_id=p.owner_id) as owner,
IF(a.status='Active','Occupied','Vacant') as property_status, 
(select count(1) from det_property where status = 'Active') as property_count
FROM det_agreement a, det_property p, det_tenant t
where a.property_id = p.property_id and a.tenant_id = t.tenant_id");


  $srNumber = 0;
  $propertyCount = 0;
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {  

    $srNumber=$srNumber+1;
    $propertyCount = $row['property_count'];
    echo "<tr>";
    echo "<td>".$srNumber."</td>";
    echo "<td>".$row['property']."</td>"; 
    echo "<td>".$row['tenant']."</td>";
    echo "<td>".$row['owner']."</td>";
    echo "<td>".$row['rent_per_month']."</td>"; 
    echo "<td>".$row['manager']."</td>";
    echo "<td>".$row['property_status']."</td>";  


}
?>
</ul>

</tbody>
<tfoot>
  <tr>
    <td colspan="7" align="right"><h5>Total Property : <?php echo $propertyCount;?></h5></td>
  </tr>  
</tfoot>
</table> 
 </div>
    </div>
   </div>
  </div>
</div>
 </section>
</div>
<?php include '../footer.php';?> 
