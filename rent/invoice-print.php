<?php define('URL', 'http://localhost/pms/'); ?>

<!DOCTYPE html>
<html lang="en">

<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
  
$id = $_GET['id'];
$result = $dbConn->query("SELECT r.rent_id, r.agreement_id, r.invoice_no, date_format(r.creation_date,'%d/%m/%Y') as invoice_date,
(select t.tenant_name from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_name,
(select t.company_name from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_company,
(select t.address from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_address,
(select concat(nvl((select c.name from cities c where c.id = t.city_id),''),'-',nvl(t.pincode,''), ',', nvl((select s.name from states s where s.id = t.state_id),'')) from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_address1,
(select t.gst_no from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_gst,
(select t.contact_number from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_contact,
(select t.company_email from det_tenant t where t.tenant_id = 
(select a.tenant_id from det_agreement a where a.agreement_id = r.agreement_id)) as tenant_company_email,
(select p.property_name from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id)) as property_name,
(select concat(p.flat_no,', ', nvl(p.address,''),', ', nvl(p.location,''), ',', nvl((select c.name from cities c where c.id = p.city_id),'')) from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id)) as property_address,
(select concat(nvl((select c.name from cities c where c.id = p.city_id),''),', ', nvl(p.pincode,''), ',', nvl((select s.name from states s where s.id = p.state_id),'')) from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id)) as property_address1,
(select o.owner_name from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_name,
(select o.company_name from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_company_name,
(select o.address from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_address,
(select concat(nvl((select c.name from cities c where c.id = o.city_id),''),'-',nvl(o.pincode,''), ',', nvl((select s.name from states s where s.id = o.state_id),'')) 
from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_address1,
(select o.gst_no from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_gst,
(select o.email_id from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_email,
(select o.contact_number from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_contact,
 DATE_FORMAT(r.rent_date, '%b-%Y') AS period, r.rent_amount, r.other_charges_desc, r.other_charges_amount, 
 r.gst_status, r.gst_amount, r.total_amount
 FROM asset_management.det_rent r where rent_id='$id'");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{

    $v_agreement_id=$row['agreement_id'];
    $v_invoice_no=$row['invoice_no'];
    $v_invoice_date=$row['invoice_date'];

    $v_tenant_name=$row['tenant_name'];
    $v_tenant_company=$row['tenant_company'];
    $v_tenant_address=$row['tenant_address'];
    $v_tenant_address1=$row['tenant_address1'];
    $v_tenant_gst=$row['tenant_gst'];
    $v_tenant_contact=$row['tenant_contact'];
    $v_tenant_company_email=$row['tenant_company_email'];

    $v_property_name=$row['property_name'];
    $v_property_address=$row['property_address'];
    $v_property_address1=$row['property_address1'];

    $v_owner_name=$row['owner_name'];

    //echo "<script>alert(' $v_owner_name')</script>";
    $v_owner_company_name=$row['owner_company_name'];
    $v_owner_address=$row['owner_address'];
    $v_owner_address1=$row['owner_address1'];
    $v_owner_gst=$row['owner_gst'];
    $v_owner_email=$row['owner_email'];
    $v_owner_contact=$row['owner_contact'];

    $v_period = $row['period'];
    $v_rent_amount = $row['rent_amount'];
    $v_other_charges_desc = $row['other_charges_desc'];
    $v_other_charges_amount = $row['other_charges_amount'];
    $v_gst_status = $row['gst_status'];
   //echo "<script>alert(' $v_gst_status')</script>";
    $v_gst_amount = $row['gst_amount'];
    $v_total_amount = $row['total_amount'];
    
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIT | Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 style="text-align: center;">Tax Invoice</h2><br>
        <h2 class="page-header">
          <img src="../images/git-logo.png" height="50px" width="50px"> GIT, Tech                    
          <small class="float-right">Date: <?php echo $v_invoice_date;?></small> 
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
              <address>
                <strong><?php echo $v_owner_company_name;?></strong><br>
                <strong><?php echo $v_owner_name;?></strong><br>
                <?php echo $v_owner_address;?><br/>
                <?php echo $v_owner_address1;?><br/>
                <b>GST No.:</b> <?php echo $v_owner_gst;?><br/>
                <b>Phone:</b> <?php echo $v_owner_contact;?><br/>
                <b>Email:</b> <a href="mailto:<?php echo $v_owner_email;?>"><?php echo $v_owner_email;?></a>
              </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $v_tenant_company;?></strong><br>
                    <strong><?php echo $v_tenant_name;?></strong><br>
                    <?php echo $v_tenant_address;?><br/>
                    <?php echo $v_tenant_address1;?><br/>
                    <b>GST No.:</b> <?php echo $v_tenant_gst;?><br/>
                    <b>Phone:</b> <?php echo $v_tenant_contact;?><br/>          
                    <b>Email:</b> <a href="mailto:john@example.com"><?php echo $v_tenant_company_email;?></a>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo $v_invoice_no;?></b><br>
                  <br>
                  <b>Order ID:</b> <br>
                  <b>Payment Due:</b> <?php 
                  $v_due_date=strtotime($v_invoice_date);
                  $v_due_date = strtotime($v_due_date. ' + 7 days');
                  echo date('d/m/Y', $v_due_date);
            ?><br>
              <b>Account:</b> 
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Serial #</th>                      
            <th>Item</th>                      
            <th>Description</th>
            <th>Rent / Month</th>
            <th>Months</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
                      <td>Rent of <?php echo $v_period;?></td>                      
                      <td><?php 
              echo $v_property_name;
              echo $v_property_address;
              echo $v_property_address1;
              ?></td>
                      <td><?php echo $v_rent_amount;?></td>
                      <td>1</td>
                      <td><?php 
             $v_total_rent = $v_rent_amount * 1;
            echo $v_total_rent;?></td>
          </tr>
          <tr>
            <td>2</td>
                      <td>Other Charges</td>                      
                      <td><?php echo $v_other_charges_desc;?></td>
                      <td><?php echo $v_other_charges_amount;?></td>
                      <td>1</td>
                      <td><?php 

             $v_total_charges = $v_other_charges_amount * 1;
            echo $v_total_charges;?></td>
            <?php 
            $v_total_taxable = $v_total_rent + $v_total_charges;?>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
         <img src="../dist/img/credit/visa.png" alt="Visa">
                  <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../dist/img/credit/paypal2.png" alt="Paypal">                                
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  <lable class="lead">Terms & condition:</lable> <br/>
                    Payment should be paid before valid date. If not an amount of Rs. <?php echo $v_total_taxable*2/100;?>/- is charged for every month of extension. Total amount apeared in this invoice shall be paid at a time before the valid date.
                  </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due <?php 
                  $v_due_date=strtotime($v_invoice_date);
                  $v_due_date = strtotime($v_due_date. ' + 7 days');
                  echo date('d/m/Y', $v_due_date);
            ?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?php 
            echo $v_total_taxable;?></td>
                      </tr>
                      <tr>
                        <th>Tax (CGST @ 9%)</th>
                        <td><?php 
            $v_cgst_amount = 0;
            if($v_gst_status=="Y"){
            $v_cgst_amount = ($v_total_taxable * 9)/100;
            }else if($v_gst_status=="N"){
              $v_cgst_amount = 0;
            }
            echo $v_cgst_amount;?></td>
                      </tr>
                      <tr>
                        <th>Tax (SGST @ 9%)</th>
                        <td><?php
            $v_sgst_amount = 0; 
            if($v_gst_status=="Y"){
            $v_sgst_amount = ($v_total_taxable * 9)/100;
             }else if($v_gst_status=="N"){
              $v_sgst_amount = 0;
            }
            echo $v_sgst_amount;?></td>
                      </tr>
                      <tr>
                        <th>Oustanding:</th>
                        <td>0.00</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php 
            $v_grand_total = $v_total_taxable + $v_cgst_amount + $v_sgst_amount;
            echo $v_grand_total;?></td>
                      </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
