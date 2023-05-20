
<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 ?>

<?php include '../menu.php';?>
 
<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Add Property</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Property</li>
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
     <div class="card card-primary">
      
<form action="add.php" name="forml" id="form1" method="POST" onsubmit="return myfunction()  ">
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
 <div class="card-primary2">
 <div class="card-header2">
  <h3 class="card-title">Property Address</h3>
 </div>
 </div>

<ul class="add-lead-ul">

                <!----------Property Name------------->

 <li>
 <div class="form-group">
  <label>Property Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Property Name" name="propertyName"  onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

             <!----------Property Type------------->

<li>
 <div class="form-group">
  <label>Property Type <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="prop_type" name="prop_type" required>
     <option value="0"> Select Property Type </option>
     <?php 
      $result = $dbConn->query("SELECT param_code, param_value FROM mst_common_param where group_id = 1");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $param_code=$row['param_code'];
         $param_value=$row['param_value'];
      ?>
     <option value="<?php echo $param_code;?>"><?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li>

             <!----------Property Sub-Type------------->

<li >
 <div class="form-group">
  <label>Property Sub Type <span>*</span></label>
   <div id="div0">
    <select class="form-control form-control-sm" id="p_subType" name="p_subType" required>
     <option value="0"> Select Property Type </option>
    </select>  
   </div>
 </div>
</li>

  <!----------Property Type------------->

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
     <option value="<?php echo $owner_id;?>"><?php echo $owner_name;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li> -->

                <!----------Flat-No.------------->

<li>
 <div class="form-group">
  <label>Flat/Unit/Shop No. <span>*</span></label>
   <input type="text" id="unitNo" class="form-control form-control-sm" placeholder="Flat/Unit/Shop No." name="unitNo">
    <span class="text-danger"></span>
 </div>
</li>

                <!----------Address------------->

<li>
 <div class="form-group">
  <label>Address <span>*</span></label>
  <input type="text" id="address" class="form-control form-control-sm" placeholder="Address" name="address" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------LandMark------------->

<li>
 <div class="form-group">
  <label>Landmark </label>
  <input type="text" id="landmark" class="form-control form-control-sm" placeholder="Landmark" name="landmark" >
    <span class="text-danger"></span>
 </div>
</li>


                    <!----------lOCATION------------->

<li class="text-area">
 <div class="form-group">
  <label>Location <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Location" name="location" value="" required>
    <span class="text-danger"></span>
 </div>
</li>


                      <!----------State------------->
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
     <option value="<?php echo $param_code;?>"><?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li>

                      <!----------City------------->

<li class="text-area">
 <div class="form-group">
  <label>City <span>*</span></label>
   <div id="div0">
    <select class="form-control form-control-sm" id="city" name="city" required>
     <option value="0"> Select City </option>
    </select>  
   </div>
    <span class="text-danger"></span>
 </div>
</li>

                   <!----------Pincode------------->

<li class="text-area">
 <div class="form-group">
  <label>Pincode</label><span>*</span>
   <input type="text" id="pincode" class="form-control form-control-sm" placeholder="Pincode" name="pincode" pattern="[0-9]{6}" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li>
</ul>

               <!----------Property Details------------->

<div class="card-primary2">
 <div class="card-header2">
  <h3 class="card-title">Property Details</h3>
 </div>
  
<ul class="add-lead-ul">

                 <!----------Build-Up Area------------->

<li>
 <div class="form-group">
  <label>Build-Up Area </label>
   <input type="text" class="form-control form-control-sm" placeholder="Build-Up Area" name="buildUpArea" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')">
  <span class="text-danger"></span>
 </div>
</li>
  
                 <!----------Carpet Area------------->

<li>
 <div class="form-group">
  <label>Carpet Area </label>
   <input type="text" class="form-control form-control-sm" placeholder="Carpet Area" name="carpetArea" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')">
    <span class="text-danger"></span>
 </div>
</li>

                  <!----------Age Of Property------------->

<li>
 <div class="form-group">
  <label>Age of Property (In Years)</label>
   <input type="number" class="form-control form-control-sm" placeholder="Age of Property" name="ageOfProperty" onkeypress="return /[0-9]/i.test(event.key)">
    <span class="text-danger"></span>
 </div>
</li>


<li>
 <div class="form-group">
  <label>Electric Meter No.</label>
   <input type="text" class="form-control form-control-sm" placeholder="Electric Meter" name="elecMeter" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                  <!----------Gram panchayat No / property tax------------->

                  <!-- <li>
 <div class="form-group">
  <label>Gram Panchayat No. / Property Tax</label>
   <input type="number" class="form-control form-control-sm" placeholder="Gram Panchayat No. / Property Tax" name="propertyTaxNo" onkeypress="return /[0-9]/i.test(event.key)">
    <span class="text-danger"></span>
 </div>
</li> -->

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
     <option value="<?php echo $param_code;?>"><?php echo $param_value;?></option>
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
     <option value="<?php echo $param_code;?>"><?php echo $param_value;?></option>
      <?php  }?>
    </select>  
  </div>
     <span class="text-danger"></span>
 </div>
</li>
</ul>

                 <!----------Button------------->

<div class="card-footer" align="center">
 <button type="submit" name="add_lead" class="btn btn-primary"> Save </button>
 <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary"> Cancel </button>
</div>

    </form>
   </div>
  </div>
 </section>
</div>

<script>
$(document).ready(function(){

$('#prop_type').on('change', function(){
        var id = $(this).val();
        console.log(id);
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
                      <!----------Footer------------->

<?php include '../footer.php';?> 