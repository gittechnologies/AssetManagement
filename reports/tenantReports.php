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
                                    <h3 class="card-title">Tenant Reports</h3>
                                </div>
                            </div>

                            <ul class="add-lead-ul">
                                <li>
                                    <div class="form-group">
                                        <label >Category</label>
                                        <select id="categories" name="categories" class="form-control form-control-sm">
                                            <option value="">Select Category</option>
                                            <option value="All">All Tenant</option>
                                            <option value="City">City Wise</option> 
                                            <option value="Outstanding">Outstanding</option>                                             
                                        </select>
                                    </div>
                                </li>

                                <li>                                    
                                    <div class="form-group status_type" id="cityId">
                                        <label >City</label>
                                        <select id="city" name="city" class="form-control form-control-sm">
                                            <option value="">Select City</option>
                                            <option value="All">All</option>
                                            <?php 
                                              $result = $dbConn->query("SELECT c.id, c.name FROM cities c WHERE EXISTS (Select p.city_id from det_property p where c.id=p.city_id and p.status='Active')");
                                              $result->execute();
                                               while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                 $v_city_name=$row['name'];
                                                 $v_city_id=$row['id'];
                                              ?>
                                             <option value="<?php echo $v_city_id;?>">

                                                <?php echo $v_city_name;?></option>

                                              <?php  }?>
                                        </select>
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
                      <th>Tenant</th>
                      <th>Tenant Address</th>
                      <th>PAN</th>
                      <th>Contact No.</th>
                      <th>Email</th>                      
                      <th>Property</th>
                      <?php if($v_categories=="Outstanding"){
                        echo "<th>Rent</th>";
                        echo "<th>Amount Paid</th>";
                         echo "<th>Outstanding</th>";
                      }else{
                        echo "<th>Property City</th>";
                      }
                        ?>                    
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php if ($v_categories == "All") {
                        $strsql = "SELECT t.tenant_id, t.tenant_name,t.pan_no,
concat(t.address,', ',(select c.name from cities c where c.id=t.city_id), ' - ',t.pincode, ', ',(select s.name from states s where s.id=t.state_id)) as tenant_address, t.contact_number, t.email_id,t.occupation, t.company_name, 
(select concat(p.property_name,',', p.flat_no,',',p.address,',', p.location,', ',(select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) from det_property p where p.property_id = a.property_id) as property_name,
(select (select c.name from cities c where c.id=p.city_id) from det_property p where p.property_id = a.property_id) as Property_city
FROM asset_management.det_tenant t, det_agreement a 
where a.tenant_id = t.tenant_id and t.status='Active'";
                        $result = $dbConn->prepare($strsql);
                        $result->execute();
                        $srNumber = 0;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $srNumber=$srNumber+1;

                    
                            ?>
                            <tr>
                                <td><?php echo $srNumber; ?></td>
                                <td><?php echo $row['tenant_name']; ?></td>                                  
                                <td><?php echo $row['tenant_address']; ?></td>
                                <td><?php echo $row['pan_no']; ?></td>
                                <td><?php echo $row['contact_number']; ?></td>
                                <td><?php echo $row['email_id']; ?></td>
                                <td><?php echo $row['property_name']; ?></td>
                                <td><?php echo $row['Property_city']; ?></td>
                            </tr>
                     <?php
                }
              }else if($v_categories == "City"){
                $v_city = $_POST['city'];
                if($v_city=="All" || $v_city==""){
                $strsql = "SELECT t.tenant_id, t.tenant_name,t.pan_no,
concat(t.address,', ',(select c.name from cities c where c.id=t.city_id), ' - ',t.pincode, ', ',(select s.name from states s where s.id=t.state_id)) as tenant_address, t.contact_number, t.email_id,t.occupation, t.company_name, 
concat(p.property_name,',', p.flat_no,',',p.address,',', p.location, ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_name,
(select c.name from cities c where c.id=p.city_id) as Property_city
FROM asset_management.det_tenant t, det_agreement a , det_property p
where a.tenant_id = t.tenant_id and p.property_id = a.property_id and t.status='Active'";
        }else{
            $strsql = "SELECT t.tenant_id, t.tenant_name,t.pan_no,
concat(t.address,', ',(select c.name from cities c where c.id=t.city_id), ' - ',t.pincode, ', ',(select s.name from states s where s.id=t.state_id)) as tenant_address, t.contact_number, t.email_id,t.occupation, t.company_name, 
concat(p.property_name,',', p.flat_no,',',p.address,',', p.location, ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_name,
(select c.name from cities c where c.id=p.city_id) as Property_city
FROM asset_management.det_tenant t, det_agreement a , det_property p
where a.tenant_id = t.tenant_id and p.property_id = a.property_id
and t.status='Active' and p.city_id='$v_city'";
        }
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                  ?>
                  <tr>
                      <td><?php echo $srNumber; ?></td>
                      <td><?php echo $row['tenant_name']; ?></td>                                  
                      <td><?php echo $row['tenant_address']; ?></td>
                      <td><?php echo $row['pan_no']; ?></td>
                      <td><?php echo $row['contact_number']; ?></td>
                      <td><?php echo $row['email_id']; ?></td>
                      <td><?php echo $row['property_name']; ?></td>
                      <td><?php echo $row['Property_city']; ?></td>
                  </tr>
                   <?php
              }
            }else if($v_categories == "Outstanding"){
              $strsql = "SELECT a.agreement_id, t.tenant_name,t.pan_no,
concat(t.address,', ',(select c.name from cities c where c.id=t.city_id), ' - ',t.pincode, ', ',(select s.name from states s where s.id=t.state_id)) as tenant_address, t.contact_number, t.email_id,
concat(p.property_name,',', p.flat_no,',',p.address,',', p.location,', ',(select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_name,
sum(rd.amount_paid) as amt_paid, sum(r.total_amount) as rent 
FROM det_rent_details rd, det_rent r, det_agreement a, det_tenant t, det_property p 
where rd.rent_id = r.rent_id and a.agreement_id = r.agreement_id
and a.tenant_id = t.tenant_id and p.property_id = a.property_id
group by a.tenant_id, a.property_id";
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                  ?>
                  <tr>
                      <td><?php echo $srNumber; ?></td>
                      <td><?php echo $row['tenant_name']; ?></td>                                  
                      <td><?php echo $row['tenant_address']; ?></td>
                      <td><?php echo $row['pan_no']; ?></td>
                      <td><?php echo $row['contact_number']; ?></td>
                      <td><?php echo $row['email_id']; ?></td>
                      <td><?php echo $row['property_name']; ?></td>
                      <td><?php echo $row['rent']; ?></td>
                      <td><?php echo $row['amt_paid']; ?></td>
                      <td><?php 
                          $vRent = $row['rent'];
                          $vAmtPaid = $row['amt_paid'];

                          $outstanding = $vRent-$vAmtPaid;
                          echo $outstanding; ?>
                          </td>
                  </tr>
                   <?php
              }
            }
              ?> 
          </tbody>
                                           
          <tfoot>
           <tr>
              <th>Sr. No.</th>
              <th>Tenant</th>
              <th>Tenant Address</th>
              <th>PAN</th>
              <th>Contact No.</th>
              <th>Email</th>                      
              <th>Property</th>                                                                          
              <?php if($v_categories=="Outstanding"){
                        echo "<th>Rent</th>";
                        echo "<th>Amount Paid</th>";
                         echo "<th>Outstanding</th>";
                      }else{
                        echo "<th>Property City</th>";
                      }
                        ?>
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
     $('#categories').on('change', function () {
        var id = $(this).val();
        if (id == "Location") {
            $("div.status_type").hide();
            $("#locationId").show();
        } else if (id == "City") {
            $("div.status_type").hide();
            $("#cityId").show();
        } else if (id == "Type") {
            $("div.status_type").hide();
            $("#typeId").show();
        } else if (id == "Status") {
            $("div.status_type").hide();
            $("#statusId").show();
        } else {
            $("div.status_type").hide();
        }
        });
     });
 </script>
         <?php include '../footer.php'; ?> 