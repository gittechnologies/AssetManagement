
<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 
 $id = $_GET['id'];
$result = $dbConn->query("SELECT t.tenant_id, t.tenant_name, t.gender, t.dob, t.address, t.state_id,
t.city_id, t.pincode, t.contact_number, t.email_id, t.pan_no, t.occupation, t.gst_status, t.gst_no, t.company_name, t.company_email,t.power_of_attorney
FROM det_tenant t WHERE t.tenant_id='$id'");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_tenant_id=$row['tenant_id'];
    $v_tenant_name=$row['tenant_name'];
    $v_address=$row['address'];
    $v_gender=$row['gender'];
    $v_dob=$row['dob'];
    $v_state=$row['state_id'];
    $v_city=$row['city_id'];
    $v_pincode=$row['pincode'];
    $v_contact_number=$row['contact_number'];
    $v_email=$row['email_id'];
    $v_pan_no=$row['pan_no'];
    $v_occupation=$row['occupation'];
    $v_status_gst=$row['gst_status'];
    if($v_status_gst=='on'){
        $v_status_gst = 'checked';           
    }
    else{
        $v_status_gst = '';
    }
    $v_gst_no=$row['gst_no'];
    $v_company=$row['company_name'];
    $v_company_email=$row['company_email'];
    $v_power_of_attorney=$row['power_of_attorney'];
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
       <h3 class="card-title">Edit Tenant</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Tenant</li>
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
<form action="update.php" name="forml" id="form1" method="POST" onsubmit="return myfunction()" >
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2">
       <h3 class="card-title">Tenant Details</h3>
      </div>
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr">  
<ul class="add-lead-ul">

<input type="hidden" name="tenantId" value="<?php echo $v_tenant_id;?>">  

<li>
   <div class="form-group">
  <label>Tenant Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Tenant Name" name="tenantName" value="<?php echo $v_tenant_name;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>


                    <!----------Gender------------->
<li>
 <div class="form-group">
  <label>Gender <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="gender" name="gender" required>
     <option value="S" <?php if($v_gender=="S") echo 'selected'; ?>> Select Gender </option>
     <option value="M" <?php if($v_gender=="M") echo 'selected'; ?>>Male</option>
      <option value="F" <?php if($v_gender=="F") echo 'selected'; ?>>Female</option>
      <option value="T" <?php if($v_gender=="T") echo 'selected'; ?>>Trans Gender</option>
      <option value="O" <?php if($v_gender=="O") echo 'selected'; ?>>Other</option>
    </select>  
  </div>

 </div> 
</li>

                    <!----------Date of Birth------------->

<li>
   <div class="form-group">
  <label>Date of Birth <span>*</span></label>
   <input type="date" class="form-control form-control-sm" placeholder="date of birth" name="dob" value="<?php echo $v_dob;?>" required>
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

      <?php }?>
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

<li>
 <div class="form-group">
  <label>Contact Number <span>*</span></label>
   <input type="tel" class="form-control form-control-sm" placeholder="Contact Number " name="contactNumber" value="<?php echo $v_contact_number;?>" pattern="[0-9]{10}" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Email <span>*</span></label>
   <input type="email" class="form-control form-control-sm" placeholder="Email " name="email" value="<?php echo $v_email;?>" required>
    <span class="text-danger"></span>
 </div>
</li>


<li>
 <div class="form-group">
  <label>Occupation</label>
   <input type="text" class="form-control form-control-sm" placeholder="Occupation" name="Occupation" value="<?php echo $v_occupation;?>">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Pan No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pan No" name="panNo" value="<?php echo $v_pan_no;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>
                    <!----------Power Of Attorney------------->
<li>
 <div class="form-group">
  <label>Power Of Attorney</label><br>

    <div id="div0">
    <select class="form-control form-control-sm" id="power_of_attorney" name="power_of_attorney">
     <option value="0" > Select Power Of Attorney </option>
     <option value="0" <?php if($v_power_of_attorney=="0") echo 'selected'; ?>>No</option>
     <option value="1" <?php if($v_power_of_attorney=="1") echo 'selected'; ?>>Yes</option>
    </select>  
  </div>

 </div> 
</li>
<li>
 <div class="form-group">
  <label>GST No.<span id="lblGST" style="display:none;">*</span> (Is Applicable) <input type="checkbox" name="gstStatus" id="gstStatus" <?php echo $v_status_gst?> /></label>
   <input type="text" class="form-control form-control-sm" style="display:none;" placeholder="GST No" id="gstNo" name="gstNo" value="<?php echo $v_gst_no;?>">
    <span class="text-danger"></span>
 </div>
</li>  

<li>
 <div class="form-group">
  <label id="company" style="display:none;">Company Name</label>
   <input type="text" class="form-control form-control-sm"  style="display:none;" placeholder="Company Name" name="companyName" id="companyName" value="<?php echo $v_company;?>">
    <span class="text-danger"></span>
 </div>
</li>     

<li>
 <div class="form-group">
  <label id="company_email" style="display:none;">Company Email</label>
   <input type="email" class="form-control form-control-sm"  style="display:none;" placeholder="Company Email" name="companyEmail" id="companyEmail" value="<?php echo $v_company_email;?>">
    <span class="text-danger"></span>
 </div>
</li>  

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

if($("#gstStatus").is(':checked') == true){
    $("#lblGST").show();
        $("#gstNo").show();
        $("#gstNo").focus();
        $("#gstNo").attr('required',true);

        $("#company").show();
        $("#companyName").show();

        $("#company_email").show();
        $("#companyEmail").show();

}

$(document).ready(function(){
$("#gstStatus").click(function (){
     if ($(this).is(":checked")){

        $("#lblGST").show();
        $("#gstNo").show();
        $("#gstNo").focus();
        $("#gstNo").attr('required',true);

        $("#company").show();
        $("#companyName").show();

        $("#company_email").show();
        $("#companyEmail").show();
    }
    else{
        $("#lblGST").hide();
         $("#gstNo").hide();
          $("#gstNo").removeAttr("required");

          $("#company").hide();
        $("#companyName").hide();

        $("#company_email").hide();
        $("#companyEmail").hide();
    }

});
});
</script>

<?php include '../footer.php';?> 