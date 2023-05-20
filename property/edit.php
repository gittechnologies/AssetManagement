
 <?php
 session_start();
 if(!isset($_SESSION['Email']))
  {
          header("location: login.php");
  }
  $name=$_SESSION['Email'];
include_once ('../conn.php');

$id = $_GET['id'];

$result = $dbConn->query("SELECT p.property_id, p.property_name, 
p.property_type as property_type,
p.owner_id,
p.location, 
p.city_id as city,
p.property_sub_type as prop_sub_type,
p.flat_no, p.address, p.landmark, p.pincode, p.buildup_area, p.carpet_area, p.age_of_property, p.elec_meter_no,
p.state_id as state,
p.covered_parking as covered_parking,
p.open_parking as open_parking 
FROM det_property p WHERE p.property_id='$id' ");

$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_property_id=$row['property_id'];
    $v_property_name=$row['property_name'];
    $v_property_type=$row['property_type'];
    $v_owner_id=$row['owner_id'];
    $v_location=$row['location'];
    $v_city=$row['city'];
    $v_property_sub_type=$row['prop_sub_type']; 

    $v_flatno=$row['flat_no'];
    $v_address=$row['address'];
    $v_landmark=$row['landmark'];
    
    $v_pincode=$row['pincode'];
    $v_build_up_area=$row['buildup_area'];
    $v_carpet_area=$row['carpet_area'];
    
    $v_age_of_property=$row['age_of_property'];
    $v_elec_meter_no=$row['elec_meter_no'];
    $v_state=$row['state'];

    $v_covered_parking=$row['covered_parking'];
    $v_open_parking=$row['open_parking'];

}

?>

<?php include '../menu.php';?>

<div class="content-wrapper" >
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Edit Property</h3>
       <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Property</li>
     </ol>
      </div>
     </div>
     </div>
     </div>
     </div>
</section>

 <section class="content">
  <div class="container-fluid" >
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary">
      
<form action="update.php" name="forml" id="form1" method="POST" 
onsubmit="return myfunction()">

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2">
       <h3 class="card-title">Property Address</h3>
      </div>
</div>    
<ul class="add-lead-ul">

<input type="hidden" name="property_id" id="property_id" value=<?php echo $v_property_id;?>>

<li>
 <div class="form-group">
  <label>Property Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Property Name" name="property_name" value="<?php echo $v_property_name;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Property Type <span>*</span></label><br>
    
    <div id="div0">
    <select class="form-control form-control-sm" id="property_type" name="property_type" required>
     <option value="0"> Select Property Type </option>
     <?php 
      $result = $dbConn->query("SELECT param_code, param_value FROM mst_common_param where group_id = 1");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['param_code'];
         $param_value=$row['param_value'];
      ?>
     <option value="<?php echo $param_code;?>" 

        <?php       
      
            if($param_code=="$v_property_type")  
            {
             echo "selected";
            }
        ?>
        >
        <?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li>

<li >
 <div class="form-group">
  <label>Property Sub Type <span>*</span></label>
   <div id="div0">
    <select class="form-control form-control-sm" id="p_subType" name="p_subType" required>
     <option value="0"> Select Property Type </option>

     <?php 
      $result = $dbConn->query("SELECT id ,prop_sub_type  FROM m_property_type where prop_type = '$v_property_type'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['id'];
         $param_value=$row['prop_sub_type'];
      ?>
     <option value="<?php echo $param_code;?>" 

        <?php       
      
            if($param_code=="$v_property_sub_type")  
            {
             echo "selected";
            }
        ?>
        >
        <?php echo $param_value;?></option>
      <?php  }?>

    </select>  
   </div>
 </div>
</li>


<!-- <li>
 <div class="form-group">
  <label>Owner Name <span>*</span></label><br>
    
    <div id="div0">
    <select class="form-control form-control-sm" id="owner_name" name="owner_name" required>
     <option value="0"> Select Owner </option>
     <?php 
      $result = $dbConn->query("SELECT owner_id, owner_name FROM det_owner where status = 'Active'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $owner_id=$row['owner_id'];
         $owner_name=$row['owner_name'];
      ?>
     <option value="<?php echo $owner_id;?>" 

        <?php       
      
            if($owner_id=="$v_owner_id")  
            {
             echo "selected";
            }
        ?>
        >
        <?php echo $owner_name;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li> -->

<li class="text-area">
 <div class="form-group">
  <label>Flat/Unit/Shop No. <span>*</span></label>
   <input type="text" id="unitNo" class="form-control form-control-sm" placeholder="Flat/Unit/Shop No." name="unitNo" value="<?php echo $v_flatno;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Address <span>*</span></label>
  <input type="text" id="address" class="form-control form-control-sm" placeholder="Address" name="address" value="<?php echo $v_address;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Landmark </label>
  <input type="text" id="landmark" class="form-control form-control-sm" 
  placeholder="Landmark" name="landmark" value="<?php echo $v_landmark;?>">
    <span class="text-danger"></span>
 </div>
</li>

<!----------lOCATION------------->
<li class="text-area">
 <div class="form-group">
  <label>Location <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Location" name="location" value="<?php echo $v_location;?>" required>
    <span class="text-danger"></span>
 </div>
</li>


<li>
 <div class="form-group">
  <label>State <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="state" name="state" required>
     <option value="0"> Select State </option>
     <?php 
      $result = $dbConn->query("SELECT id, name FROM states where country_id = 101");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['id'];
         $param_value=$row['name'];
      ?>
     <option value="<?php echo $param_code;?>"

        <?php       
      
            if($param_code=="$v_state")  
            {
             echo "selected";
            }
        ?>

        >

        <?php echo $param_value;?></option>

      <?php  }?>
    </select>  
  </div>

 </div> 
</li>

<li class="text-area">
 <div class="form-group">
  <label>City <span>*</span></label>
   <div id="div0">
    <select class="form-control form-control-sm" id="city" name="city" required>
     <option value="0"> Select City </option>
     <?php 
      $result = $dbConn->query("SELECT id, name FROM cities WHERE state_id = '$v_state'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['id'];
         $param_value=$row['name'];
      ?>
     <option value="<?php echo $param_code;?>"

        <?php       
      
            if($param_code=="$v_city")  
            {
             echo "selected";
            }
        ?>

        >

        <?php echo $param_value;?></option>

      <?php  }?>
    </select>  
  </div>
    <span class="text-danger"></span>
 </div>
</li>

<li class="text-area">
 <div class="form-group">
  <label>Pincode <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pincode" name="pincode" value="<?php echo $v_pincode;?>" pattern="[0-9]{6}" required>
    <span class="text-danger"></span>
 </div>
</li>


</ul>
       <div class="card-primary2">
<div class="card-header2">
       <h3 class="card-title">Property Details</h3>
      </div>    

 <ul class="add-lead-ul">
<li>
 <div class="form-group">
  <label>Build-Up Area </label>
   <input type="text" class="form-control form-control-sm" placeholder="Build-Up Area" name="buildUpArea" value="<?php echo $v_build_up_area;?>" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Carpet Area </label>
   <input type="text" class="form-control form-control-sm" placeholder="Carpet Area" name="carpetArea" value="<?php echo $v_carpet_area;?>" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Age of Property (In Years)</label>
   <input type="number" class="form-control form-control-sm" placeholder="Age of Property" name="ageOfProperty" value="<?php echo $v_age_of_property;?>">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Electric Meter No.</label>
   <input type="text" class="form-control form-control-sm" placeholder="Electric Meter" 
   value="<?php echo $v_elec_meter_no;?>" name="elecMeter" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------Covered Parking------------->

<li class="parking">
 <div class="form-group">
  <label for="exampleInputEmail1">Covered Parking</label><br>
   <div id="div0">
    <select class="form-control form-control-sm" id="coveredParking" name="coveredParking" required>
     <option value="0"> Select Covered Parking </option>
     <?php 
      $result = $dbConn->query("SELECT param_code, param_value FROM mst_common_param where group_id = 2");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['param_code'];
         $param_value=$row['param_value'];
      ?>
     <option value="<?php echo $param_code;?>" 
        <?php       
      
            if($param_code=="$v_covered_parking")  
            {
             echo "selected";
            }
        ?>
        >
        <?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>
     <span class="text-danger"></span>
 </div>
</li>

                <!----------Open Parking------------->

<li class="parking">
 <div class="form-group">
  <label for="exampleInputEmail1">Open Parking</label><br>
   <div id="div0">
    <select class="form-control form-control-sm" id="openParking" name="openParking" required>
     <option value="0"> Select Open Parking </option>
     <?php 
      $result = $dbConn->query("SELECT param_code, param_value FROM mst_common_param where group_id = 2");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['param_code'];
         $param_value=$row['param_value'];
      ?>
     <option value="<?php echo $param_code;?>"
        
        <?php       
      
            if($param_code=="$v_open_parking")  
            {
             echo "selected";
            }
        ?>
        >
        <?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>
     <span class="text-danger"></span>
 </div>
</li>

<li><input type="hidden"  name="status"  value="status"></li>
<li><input type="hidden"  name="creation_date"  value="creation_date"></li>
<li><input type="hidden"  name="last_modification_date" value="last_modification_date"></li>
<li><input type="hidden"  name="Added_by"  value="Added_by"></li>
<li><input type="hidden"  name="Updated_by"  value="Updated_by"></li>
<li><input type="hidden"  name="Email"  value="Email"></li>

</ul>
 <div class="card-footer" align="center">
    <button type="submit" name="add_lead" class="btn btn-primary">Update</button>
    <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
 </div>

</form>
   </div>
  </div>
 </section>
</div>


<script>
$(document).ready(function(){

$('#property_type').on('change', function(){
        var id = $(this).val();

        if (id == "C") {
          $(".parking").hide();
        } else {
          $(".parking").show();
        }

        if(id){
            $.ajax({
                type:'POST',
                url:'../ajaxData.php',
                data:'prop_type_id='+id,
                success:function(html){
                    $('#p_subType').html(html);
                }
            }); 
        }else{
            $('#p_subType').html('<option value="">Select Property Type first</option>');
        }
    });

$('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'../ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });

    
});
</script>

<?php include '../footer.php';?> 