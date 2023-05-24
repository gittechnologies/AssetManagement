<?php 
include_once ('../path.php');
?>

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
       <h3 class="card-title">Vaccant Property</h3>
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Vaccant Property</li>
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
    <th>Address</th>
    <th>City & State</th>
    <th>Build Up-Area</th>
    <th>Carpet-Area</th>
    <th>Owner</th>
  </tr>
  </thead>
<tbody>
 <?php 
  $result = $dbConn->query("SELECT  p.property_name, 
concat(p.flat_no,', ',p.address,', ',p.landmark) as address,
concat(p.location,', ',(select c.name from cities c where c.id = p.city_id),'-',p.pincode,', ',(select s.name from states s where s.id = p.state_id)) as property_location,
p.buildup_area, p.carpet_area, (select concat(o.owner_name,'-',o.pan_no) from det_owner o where o.owner_id=p.owner_id) as owner_name
FROM det_property p
WHERE property_id NOT IN (SELECT property_id FROM det_agreement) and status = 'Active'");


  $srNumber = 0;
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {  

$srNumber=$srNumber+1;

    echo "<tr>";
    echo "<td>".$srNumber."</td>";
    echo "<td>".$row['property_name']."</td>"; 
    echo "<td>".$row['address']."</td>";
    echo "<td>".$row['property_location']."</td>"; 
    
    echo "<td>".$row['buildup_area']."</td>"; 
    echo "<td>".$row['carpet_area']."</td>";
    echo "<td>".$row['owner_name']."</td>";  


}
?>
</ul>

</tbody>
</table> 
 </div>
    </div>
   </div>
  </div>
</div>
 </section>
</div>
<?php include '../footer.php';?> 
