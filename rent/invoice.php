<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 include '../menu.php';

  
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
(select a.owner_unit_detail from det_agreement a where a.agreement_id = r.agreement_id) as owner_unit_detail,
(select concat(o.bank_name,'-',o.branch_name)  from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_bank_details,
(select o.account_no  from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_account_no,
(select o.ifsc  from det_owner o where o.owner_id = 
(select p.owner_id from det_property p where p.property_id = 
(select a.property_id from det_agreement a where a.agreement_id = r.agreement_id))) as owner_ifsc_no,
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
 FROM det_rent r where rent_id='$id'");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{

    $v_rent_id=$row['rent_id'];
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

    $v_owner_name=$row['owner_name'] .' - '. $row['owner_unit_detail'];

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
    $v_owner_bank_details = $row['owner_bank_details'];
    $v_owner_account_no = $row['owner_account_no'];
    $v_owner_ifsc_no = $row['owner_ifsc_no'];
}

?>

<!--JSPDF CDN-->
     <style>
      .container {
         position: fixed;
         top: 20%;
         left: 28%;
         border-radius: 7px;
      }
      .card {
         box-sizing: content-box;
         width: 800px;
         height: 1000px;
         padding: 30px;
         border: 1px solid black;
         font-style: sans-serif;
         background-color: #f0f0f0;
      }
      h2 {
         text-align: center;
         color: #24650b;
      }
   </style>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to print.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="generatePDF">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h2 style="text-align: center;">Tax Invoice</h2><br>
                  <h4>
                    <img src="../images/git-logo.png" height="50px" width="50px"> GIT, Tech
                    <small class="float-right">Date: <?php echo $v_invoice_date;?></small>
                  </h4>
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
                    <?php echo $v_tenant_address1;?><br/><br>
                    <b>GST No.:</b> <?php echo $v_tenant_gst;?><br/>
                    <b>Phone:</b> <?php echo $v_tenant_contact;?><br/>          
                    <b>Email:</b> <a href="<?php echo $v_tenant_company_email;?>"><?php echo $v_tenant_company_email;?></a>
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
            ?><br><br>
                  <b>Bank Details:</b> <br>
                  <b>Bank Name:</b> 
                  <?php echo $v_owner_bank_details;?><br/>
                  <b>Account Number:</b> 
                  <?php echo $v_owner_account_no;?><br/>
                  <b>IFSC Number:</b> 
                  <?php echo $v_owner_ifsc_no;?><br/>
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
                      <th>Serial #</th>                      <
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
                      <td colspan="4"><b>Other Charges</b></td>                      
                    </tr> 
                    
                    <?php 
                      $other_charges_sql = $dbConn->query("select r.rent_id, oc.charges_description , oc.amount from det_rent r join det_rent_other_charges oc ON r.rent_id = oc.rent_id  where r.rent_id='$id'");
                      // print_r($other_charges_sql);
                      // die();
                      $other_charges_sql->execute();
                      $total_other_charges = 0;
                      while($other_charges_row = $other_charges_sql->fetch(PDO::FETCH_ASSOC))
                      { 
                        $v_other_charges_desc = ucwords($other_charges_row['charges_description']);
                        $v_other_charges_amount = $other_charges_row['amount'];
                        $total_other_charges = $total_other_charges + $v_other_charges_amount;
                        echo "<tr> <td colspan='2'></td>";
		                    echo "<td>&#x2022; ".$v_other_charges_desc."</td>";
		                    echo "<td>".$v_other_charges_amount."</td>";
                        echo "<td>1</td>";
                        ?>
                        <td><?php 
                          $v_total_charges = $v_other_charges_amount * 1;
                        echo $v_total_charges;?></td>
                       <?php 
                       $v_total_taxable = $v_total_rent + $total_other_charges;
                         echo "</tr>";
                      }  ?>  
                      </tr>               
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-7">
                  <p class="lead">Payment Methods:</p>
                  <img src="../dist/img/credit/visa.png" alt="Visa">
                  <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   <label class="lead">Terms & condition:</label> <br/>
                    Payment should be paid before valid date. If not an amount of Rs. <?php echo $v_total_taxable*2/100;?>/- is charged for every month of extension. Total amount apeared in this invoice shall be paid at a time before the valid date.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-5">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?php 
            $v_total_taxable = $v_total_rent + $total_other_charges;
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
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
           <!-- this row will not appear when printing -->
           <div class="row no-print p-3">
                <div class="col-12">
                  <a href="invoice-print.php?id=<?php echo $v_rent_id;?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right" onclick="window.location='manage.php'"><i class="fa fa-window-close"></i> Cancel</button>
                  <!--<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment</button>-->
                  <button type="button" class="btn btn-primary" id="pdfButton" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF</button>
                </div>
              </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
      var button = document.getElementById("pdfButton");
      var makepdf = document.getElementById("generatePDF");
      button.addEventListener("click", function () {
         var mywindow = window.open("", "PRINT", "height=800,width=1000");
         mywindow.document.write(makepdf.innerHTML);
         mywindow.document.close();
        //  mywindow.focus();
         mywindow.print();
         return true;
      });
   </script>
<?php include '../footer.php';?> 

