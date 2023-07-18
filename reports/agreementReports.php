<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("location: login.php");
}
$name = $_SESSION['Email'];
include_once ('../conn.php');

include '../menu.php';
?>
<style>
    .status_type{
        display: none;
    }
</style>

<div class="wrapper">
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reports</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card card-primary">
                        <form action="" name="forml" id="form1" method="POST">
                            <input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
                            <div class="card-primary2">
                                <div class="card-header2">
                                    <h3 class="card-title">Agreement Reports</h3>
                                </div>
                            </div>

                            <ul class="add-lead-ul">
                                <li>
                                    <div class="form-group">
                                        <label >Category</label>
                                        <select id="categories" name="categories" class="form-control form-control-sm">
                                            <option value="">Select Category</option>
                                            <option value="All">All Agreement</option>
                                            <option value="Date">Date Wise</option>
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-group status_type" id="fromId">
                                        <label>From</label>
   <input type="text" class="form-control form-control-sm dates" placeholder="agreement From" 
   name="agreementFrom" id="agreementFrom"></div>

                    <div class="form-group status_type" id="toId">
                        <label for="exampleInputEmail1">To </label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Agreement To" 
   name="agreementTo" id="agreementTo">
                        
                    </div>

                                    
                                </li>
                            </ul>
                            <div class="card-footer" align="center">
                                <button type="submit" id= "generate" name="generate" class="btn btn-primary">Generate Report</button>
                                
                            </div>
                        </form>
                    </div>  
                </div>
              </div>
            </div>
          </section>    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
             <?php                               
              if(isset($_POST['generate'])){
              if(!empty($_POST['categories'])) {
              $v_categories = $_POST['categories'];
              ?>
              <div class="card-header">
                  <h3 class="card-title">
                    <?php 
                    $v_category_append = '';
                  if($v_categories=="All" || $v_categories==""){
                    $v_category_append = $v_categories;
                  }else{
                    $v_category_append = $v_categories.' Wise';
                  } echo $v_category_append;
                ?> 
              Tenant Reports</h3>
               </div>
              
              <!-- /.card-header -->
              <div class="card-body">                 
                <table id="example1" class="table table-bordered table-striped small table-hover">
                  
                  <thead>
                 <tr>                  
                      <th>Sr. No.</th>
                        <th>Property</th>
                        <th>Tenant</th>
                        <?php 
                    if($v_categories == "Date"){
                        echo "<th>Agreement Date</th>";
                    }
                    ?>    
                        <th>Agreement Start</th>
                        <th>Agreement End</th>
                        <th>Locking Period (In Months)</th>
                        <th>Deposite (Rs)</th>
                        <th>Rent Per Month (Rs)</th>
                        <th>Commission Agent</th>                   
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php if ($v_categories == "All") {
                        $strsql = "SELECT agreement_id, 
concat(p.property_name,',',p.location,',',(select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property, 
concat(t.tenant_name,'-',t.pan_no) as tenant, 
DATE_FORMAT(a.agreement_from,'%d-%m-%Y') as agreement_from, DATE_FORMAT(a.agreement_to,'%d-%m-%Y') as agreement_to, deposit_amount, locking_period, rent_per_month, 
(SELECT concat(m.manager_name,'-', m.pan_no) FROM det_manager m where m.manager_id = a.manager_id) as manager
from det_agreement a, det_property p, det_tenant t
where a.property_id = p.property_id and a.tenant_id = t.tenant_id";
                            $result = $dbConn->prepare($strsql);
                            $result->execute();
                            $srNumber = 0;
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                                $srNumber=$srNumber+1;

                    
                            ?>
                            <tr>
                               <td><?php echo $srNumber; ?></td>
                                <td><?php echo $row['property']; ?></td>
                                <td><?php echo $row['tenant']; ?></td>
                                <td><?php echo $row['agreement_from']; ?></td>
                                <td><?php echo $row['agreement_to']; ?></td>
                                <td><?php echo $row['locking_period']; ?></td>
                                <td><?php echo $row['deposit_amount']; ?></td>
                                <td><?php echo $row['rent_per_month']; ?></td>
                                <td><?php echo $row['manager']; ?></td>
                            </tr>
                     <?php
                }
              }else if($v_categories == "Date"){ 
                $v_agreement_from = date("Y-m-d", strtotime($_POST['agreementFrom']));
                $v_agreement_to = date("Y-m-d", strtotime($_POST['agreementTo']));
                if($v_agreement_to=="" && $v_agreement_from==""){
                    $strsql = "SELECT agreement_id, a.agreement_date, 
concat(p.property_name,',',p.location,',',(select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property, 
concat(t.tenant_name,'-',t.pan_no) as tenant, 
DATE_FORMAT(a.agreement_from,'%d-%m-%Y') as agreement_from, DATE_FORMAT(a.agreement_to,'%d-%m-%Y') as agreement_to, deposit_amount, locking_period, rent_per_month, 
(SELECT concat(m.manager_name,'-', m.pan_no) FROM det_manager m where m.manager_id = a.manager_id) as manager
from det_agreement a, det_property p, det_tenant t
where a.property_id = p.property_id and a.tenant_id = t.tenant_id";
        }else{
             $strsql = "SELECT a.agreement_id,DATE_FORMAT(a.agreement_date,'%d-%m-%Y') as agreement_date ,
concat(p.property_name,',',p.location,',',(select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property, 
concat(t.tenant_name,'-',t.pan_no) as tenant, 
DATE_FORMAT(a.agreement_from,'%d-%m-%Y') as agreement_from, DATE_FORMAT(a.agreement_to,'%d-%m-%Y') as agreement_to, deposit_amount, locking_period, rent_per_month, 
(SELECT concat(m.manager_name,'-', m.pan_no) FROM det_manager m where m.manager_id = a.manager_id) as manager
from det_agreement a, det_property p, det_tenant t
where a.property_id = p.property_id and a.tenant_id = t.tenant_id 
and a.agreement_date between '$v_agreement_from' and '$v_agreement_to'";
  }
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                  ?>
                  <tr>
                      <td><?php echo $srNumber; ?></td>                    
                    <td><?php echo $row['property']; ?></td>                               
                    <td><?php echo $row['tenant']; ?></td>
                    <td><?php echo $row['agreement_date']; ?></td>
                    <td><?php echo $row['agreement_from']; ?></td>
                    <td><?php echo $row['agreement_to']; ?></td>
                    <td><?php echo $row['locking_period']; ?></td>
                    <td><?php echo $row['deposit_amount']; ?></td>
                    <td><?php echo $row['rent_per_month']; ?></td>
                    <td><?php echo $row['manager']; ?></td>
                  </tr>
                   <?php
              }
            }
              ?> 
          </tbody>
                                           
          <tfoot>
           <tr>
              <th>Sr. No.</th>
                <th>Property</th>
                <th>Tenant</th>
                <?php 
                    if($v_categories == "Date"){
                        echo "<th>Agreement Date</th>";
                    }
                    ?>    
                <th>Agreement Start</th>
                <th>Agreement End</th>
                <th>Locking Period (In Months)</th>
                <th>Deposite (Rs)</th>
                <th>Rent Per Month (Rs)</th>
                <th>Commission Agent</th>
              </tr>
          </tfoot>   
        </table> 
        </div>
        <?php }
            }  ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
     

<script>
  $(document).ready(function () {
    $('input[class$=dates]').datepicker({
      dateFormat: 'dd-mm-yy'			// Date Format "dd-mm-yy"
    });
  });

  $(document).ready(function () {
    $('#categories').on('change', function () {
      var id = $(this).val();
      if (id == "Date") {
          $("div.status_type").hide();
          $("#fromId").show();
          $("#toId").show();
      } else {
          $("div.status_type").hide();
      }
      });
    });
 </script>
         <?php include '../footer.php'; ?> 