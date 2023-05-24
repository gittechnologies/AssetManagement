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
      <li class="breadcrumb-item active">Rent Per Month</li>
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
    <th>Rent Per month (Rs)</th>
    <th>Rent Period</th>
    <th>Invoice Number</th>
    <th>Invoice Date</th>
    <th>Invoice Amount</th>
    <th>Amount Paid</th>
    <th>Outstanding</th>
  </tr>
  </thead>
<tbody>
 <?php 
  $result = $dbConn->query("SELECT p.property_name, t.tenant_name, a.rent_per_month, 
date_format(r.creation_date,'%d/%m/%Y') as invoice_date, 
DATE_FORMAT(r.rent_date, '%b-%Y') AS period, r.total_amount, r.invoice_no,
nvl((select sum(rd.amount_paid) from det_rent_details rd where rd.rent_id = r.rent_id group by rd.rent_id),0) as total_amount_paid  
FROM det_rent r, det_agreement a, det_property p, det_tenant t 
where a.tenant_id = t.tenant_id and a.property_id = p.property_id 
and a.agreement_id = r.agreement_id 
 and r.rent_status <> 'PAID'");

  $srNumber = 0;
  $result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {  

$srNumber=$srNumber+1;

    echo "<tr>";
    echo "<td>".$srNumber."</td>";
    echo "<td>".$row['property_name']."</td>"; 
    echo "<td>".$row['tenant_name']."</td>"; 
    echo "<td>".$row['rent_per_month']."</td>"; 
    echo "<td>".$row['period']."</td>"; 
    echo "<td>".$row['invoice_no']."</td>"; 
    echo "<td>".$row['invoice_date']."</td>"; 
    echo "<td>".$row['total_amount']."</td>"; 
    echo "<td>".$row['total_amount_paid']."</td>"; 
    echo "<td>".$row['total_amount']-$row['total_amount_paid']."</td>"; 
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