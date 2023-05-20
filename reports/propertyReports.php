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
                                    <h3 class="card-title">Property Reports</h3>
                                </div>
                            </div>

                            <ul class="add-lead-ul">
                                <li>
                                    <div class="form-group">
                                        <label >Category</label>
                                        <select id="categories" name="categories" class="form-control form-control-sm">
                                            <option value="">Select Category</option>
                                            <option value="All">All Property</option>
                                            <option value="Location">Location Wise</option>
                                            <option value="City">City Wise</option>
                                            <!--<option value="Type">Type Wise</option>
                                            <option value="Rent">Property Wise Rent</option>
                                            
                                            <option value="Oustanding">Property Wise Oustanding</option>-->
                                            <option value="Status">Status Wise</option>
                                            
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-group status_type" id="locationId">
                                        <label >Location</label>
                                        <select id="location" name="location" class="form-control form-control-sm">
                                            <option value="">Select Location</option>
                                            <option value="All">All</option>
                                            <?php 
                                              $result = $dbConn->query("SELECT location FROM det_property");
                                              $result->execute();
                                               while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                 $v_location=$row['location'];
                                              ?>
                                             <option value="<?php echo $v_location;?>">

                                                <?php echo $v_location;?></option>

                                              <?php  }?>
                                        </select>
                                    </div>
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

                                    <div class="form-group status_type" id="typeId">
                                        <label >Property Type</label>
                                        <select id="property_type" name="property_type" class="form-control form-control-sm">
                                            <option value="">Select Property Type</option>
                                            <option value="All">All Type</option>
                                            <option value="R">Residential</option>
                                            <option value="C">Commercial</option>
                                            <option value="I">Industrial</option>
                                        </select>
                                    </div>

                                    <div class="form-group status_type" id="statusId">
                                        <label >Property Status</label>
                                        <select id="property_status" name="property_status" class="form-control form-control-sm">
                                            <option value="">Select Property Status</option>
                                            <option value="All">All Staus</option>
                                            <option value="Occupied">Occupied</option>
                                            <option value="Vacant">Vacant</option>
                                            <option value="Sold">Sold</option>
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
                    <th>Property Type</th>
                    <th>Property Name</th>
                    <th>Owner Name</th>
                    <th>Address</th>
                    <th>Location</th>
                    <?php 
                    if($v_categories == "City"){
                        echo "<th>City</th>";
                        echo "<th>States</th>";
                    }else{
                    echo "<th>City & State</th>";
                        }
                    ?>                    
                    <th>Status</th>                   
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php if ($v_categories == "All") {
                        $strsql = "SELECT p.property_id, p.property_name,
            concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
            p.location,
            concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_city,
            concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
            (select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name, 
            IFNULL((select CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END from det_agreement a where a.property_id = p.property_id),'Vacant') as property_status
            FROM det_property AS p where p.status='Active'";
                        $result = $dbConn->prepare($strsql);
                        $result->execute();
                        $srNumber = 0;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $srNumber=$srNumber+1;
                            if ($row["property_status"] == "Occupied") {
                                $statusColor = "#006600";
                            } else if ($row["property_status"] == "Vacant") {
                                $statusColor = "#981B1E";
                            } else {
                                $statusColor = "#CC0000";
                            }
                            ?>
                            <tr>
                                <td><?php echo $srNumber; ?></td>
                                <td><?php echo $row['property_type']; ?></td>
                                <td><?php echo $row['property_name']; ?></td>
                                <td><?php echo $row['owner_name']; ?></td>
                                <td><?php echo $row['property_address']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['property_city']; ?></td>                                
                                <td style="font-size: 11px; font-weight: bold; color: <?php echo $statusColor;?>"><?php echo $row['property_status']; ?></td>
                            </tr>
                     <?php
                }
              }else if($v_categories == "Location"){
                $v_location = $_POST['location'];
                                        if($v_location=="All" || $v_location==""){
                                            $strsql = "SELECT p.property_id, p.property_name, p.location,
            concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
            concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_city,
            concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
            (select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name, 
            IFNULL((select CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END from det_agreement a where a.property_id = p.property_id),'Vacant') as property_status
            FROM det_property AS p where p.status='Active'";
        }else{
             $strsql = "SELECT p.property_id, p.property_name, p.location,
            concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
            concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ', ',(select s.name from states s where s.id=p.state_id)) as property_city,
            concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
            (select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name, 
            IFNULL((select CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END from det_agreement a where a.property_id = p.property_id),'Vacant') as property_status
            FROM det_property AS p where p.status='Active' and p.location='$v_location'";
        }
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                  if ($row["property_status"] == "Occupied") {
                        $statusColor = "#006600";
                    } else if ($row["property_status"] == "Vacant") {
                        $statusColor = "#981B1E";
                    } else {
                        $statusColor = "#CC0000";
                    }
                  ?>
                  <tr>
                    <td><?php echo $srNumber; ?></td>
                    <td><?php echo $row['property_type']; ?></td>
                    <td><?php echo $row['property_name']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['property_address']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['property_city']; ?></td>                    
                     <td style="font-size: 11px; font-weight: bold; color: <?php echo $statusColor;?>"><?php echo $row['property_status']; ?></td>
                   <?php
              }
            }else if($v_categories == "City"){
                $v_city = $_POST['city'];
             if($v_city=="All" || $v_city==""){
                $strsql = "SELECT p.property_id, p.property_name, p.location,
                (select c.name from cities c where c.id=p.city_id) as city_name,
            concat(p.flat_no,', ', p.address,', ',p.landmark,', Pincode - ',p.pincode) as property_address,
            (select s.name from states s where s.id=p.state_id) as state_name,
            concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
            (select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name, 
            IFNULL((select CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END from det_agreement a where a.property_id = p.property_id),'Vacant') as property_status
            FROM det_property AS p where p.status='Active'";
        }else{
            $strsql = "SELECT p.property_id, p.property_name, p.location,
            (select c.name from cities c where c.id=p.city_id) as city_name,
            concat(p.flat_no,', ', p.address,', ',p.landmark,', Pincode - ',p.pincode) as property_address,
            (select s.name from states s where s.id=p.state_id) as state_name,
            concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
            (select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name, 
            IFNULL((select CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END from det_agreement a where a.property_id = p.property_id),'Vacant') as property_status
            FROM det_property AS p where p.status='Active' and p.city_id='$v_city'";
        }
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                    if ($row["property_status"] == "Occupied") {
                        $statusColor = "#006600";
                    } else if ($row["property_status"] == "Vacant") {
                        $statusColor = "#981B1E";
                    } else {
                        $statusColor = "#CC0000";
                    }
                  ?>
                  <tr>
                    <td><?php echo $srNumber; ?></td>
                    <td><?php echo $row['property_type']; ?></td>
                    <td><?php echo $row['property_name']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['property_address']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['city_name']; ?></td>  
                    <td><?php echo $row['state_name']; ?></td>                    
                     <td style="font-size: 11px; font-weight: bold; color: <?php echo $statusColor;?>"><?php echo $row['property_status']; ?></td>                                                          
                  </tr>
                   <?php
              }
            }else if($v_categories == "Status"){
                $v_status = $_POST['property_status'];
             if ($v_status == "Occupied") {
                $v_set_status= "Active";
            } else if ($v_status == "Vacant") {
                $v_set_status = "Active";
            } else if($v_status=="Sold"){
                $v_set_status = "InActive";
            }else{
                $v_set_status = "";
                    }

            if($v_status=="All" || $v_status==""){
                $strsql = "SELECT p.property_id, p.property_name,                                    
concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ' - ',(select s.name from states s where s.id=p.state_id)) as property_city,p.location, 
concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
(select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name,
 IF(p.status='Active', (CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END), 'Sold') as property_status 
FROM det_property AS p 
LEFT JOIN det_agreement a on a.property_id = p.property_id";

        }else if($v_status=="Occupied"){
 $strsql = "SELECT p.property_id, p.property_name,                                    
concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ' - ',(select s.name from states s where s.id=p.state_id)) as property_city,p.location, 
concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
(select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name,
case when a.status='Active' then 'Occupied' when a.status='InActive' then 'Vacant' when a.status IS NULL OR a.status='' then 'Vacant' else 'Vacant' end as property_status 
FROM det_property AS p 
LEFT JOIN det_agreement a on p.property_id = a.property_id 
WHERE p.status='$v_set_status' and a.status='$v_set_status'";

        }else if($v_status=="Vacant"){
 $strsql = "SELECT p.property_id, p.property_name,                                    
concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ' - ',(select s.name from states s where s.id=p.state_id)) as property_city,p.location, 
concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
(select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name,
 (case when a.status='Active' then 'Occupied' when a.status='InActive' then 'Vacant'when a.status IS NULL OR a.status='' then 'Vacant'else 'Vacant' end) as property_status 
FROM det_property AS p 
LEFT JOIN det_agreement a on p.property_id = a.property_id 
WHERE p.status='$v_set_status' and (a.status='InActive' OR a.status IS NULL OR a.status='')";

        }else if($v_status=="Sold"){
 $strsql = "SELECT p.property_id, p.property_name,                                    
concat(p.flat_no,', ', p.address,', ',p.landmark) as property_address,
concat((select c.name from cities c where c.id=p.city_id), ' - ',p.pincode, ' - ',(select s.name from states s where s.id=p.state_id)) as property_city,p.location, 
concat(CASE p.property_type WHEN 'R' THEN 'Residential' WHEN 'C' THEN 'Commercial' ELSE 'Industrial' END,' :: ',(select prop_sub_type from m_property_type AS pr where pr.id=p.property_sub_type)) as property_type,
(select concat(o.owner_name,' - ',o.pan_no) from det_owner o where o.owner_id = p.owner_id) as owner_name,
 IF(p.status='Active', (CASE a.status WHEN 'Active' THEN 'Occupied' WHEN 'InActive' THEN 'Vacant' ELSE 'Vacant' END), 'Sold') as property_status 
FROM det_property AS p LEFT JOIN det_agreement a on p.property_id = a.property_id WHERE p.status='$v_set_status'";

        }
              $result = $dbConn->prepare($strsql);
              $result->execute();
              $srNumber = 0;
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $srNumber=$srNumber+1;
                if ($row["property_status"] == "Occupied") {
                        $statusColor = "#006600";
                    } else if ($row["property_status"] == "Vacant") {
                        $statusColor = "#981B1E";
                    } else {
                        $statusColor = "#CC0000";
                    }
                  ?>
                  <tr>
                      <td><?php echo $srNumber; ?></td>                       
                        <td><?php echo $row['property_type']; ?></td>
                        <td><?php echo $row['property_name']; ?></td>
                        <td><?php echo $row['owner_name']; ?></td>
                        <td><?php echo $row['property_address']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['property_city']; ?></td>                   
                        <td style="font-size: 11px; font-weight: bold; color: <?php echo $statusColor;?>"><?php echo $row['property_status']; ?></td>
                  </tr>
                   <?php
              }
            }
              ?> 
          </tbody>
                                           
          <tfoot>
           <tr>
            <th>Sr. No.</th>
            <th>Property Type</th>
            <th>Property Name</th>
            <th>Owner Name</th>
            <th>Address</th>
            <th>Location</th>
            <?php if($v_categories == "City"){
                        echo "<th>City</th>";
                        echo "<th>States</th>";
                    }else{
                    echo "<th>City & State</th>";
                    }
                    ?>            
            <th>Status</th>  
            </tr>
          </tfoot>   
        </table> 
        </div>
        <?php }
            }  
        ?>
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
            }  else if (id == "Status") {
                $("div.status_type").hide();
                $("#statusId").show();
            } else {
                $("div.status_type").hide();
            }
        });
     });
 </script>
         <?php include '../footer.php'; ?> 