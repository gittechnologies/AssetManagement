
<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
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
       <h3 class="card-title">Add Tenant</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Tenant</li>
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
      
<form action="add.php" name="forml" id="form1" method="POST" onsubmit="return myfunction()">

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2">
 <h3 class="card-title">Tenant Details</h3>
</div>

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr">  
<ul class="add-lead-ul">

                    <!----------Tenant Name------------->

<li>
 <div class="form-group">
  <label>Tenant Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Tenant Name" name="tenantName" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------Tenant Type------------->
<li>
 <div class="form-group">
  <label>Tenant Type <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="tenantType" name="tenantType" required>
     <option value=""> Select Tenant Type </option>
     <option value="I">Individual</option>
      <option value="NI">Non Individual</option>
    </select>  
  </div>
 </div> 
</li>

                    <!----------Gender------------->
<li>
 <div class="form-group">
  <label>Gender <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="gender" name="gender" required>
     <option value="0"> Select State </option>
     <option value="M">Male</option>
      <option value="F">Female</option>
      <option value="T">Trans Gender</option>
      <option value="O">Other</option>
    </select>  
  </div>

 </div> 
</li>

                    <!----------Date of Birth------------->

<li>
   <div class="form-group">
  <label>Date of Birth <span>*</span></label>
   <input type="date" class="form-control form-control-sm" placeholder="date of birth" name="dob" value="" required>
    <span class="text-danger"></span>
 </div>
</li>


                              <!----------Address------------->

<li>
 <div class="form-group">
  <label>Address</label>
   <input type="text" class="form-control form-control-sm" placeholder="Address" name="address" value="">
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

                      <!----------Mobile Number------------->

<li>
 <div class="form-group">
  <label>Contact Number <span>*</span></label>
   <input type="tel" class="form-control form-control-sm" placeholder="Contact Number " name="contactNumber" pattern="[0-9]{10}" required>
    <span class="text-danger"></span>
 </div>
</li>

                     <!----------Email------------->

<li>
 <div class="form-group">
  <label> Email <span>*</span></label>
   <input type="email" class="form-control form-control-sm" placeholder="Enter Email " name="emailId" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------Occupation------------->

<li>
 <div class="form-group">
  <label>Occupation</label>
   <input type="text" class="form-control form-control-sm" placeholder="Occupation" name="Occupation" value="">
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------Pan No.------------->

<li>
 <div class="form-group">
  <label>Pan No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pan No" name="panNo" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------Power Of Attorney------------->
<li id="power_of_attorney">
 <div class="form-group">
  <label>Power Of Attorney</label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="power_of_attorney" name="power_of_attorney">
     <option value="0"> Select Power Of Attorney </option>
     <option value="1">Yes</option>
      <option value="0">No</option>
    </select>  
  </div>

 </div> 
</li>

                    <!----------director /partner Name------------->
                    <li>
 <div class="form-group">
  <label>Partner Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Director/ Partner Name" name="partnerName" required>
    <span class="text-danger"></span>
 </div>
</li>

                              <!----------partner Address------------->
<li>
 <div class="form-group">
  <label>Partner Address</label>
   <input type="text" class="form-control form-control-sm" placeholder="Partner Address" name="partnerAddress" value="">
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------partner Pan No.------------->

<li>
 <div class="form-group">
  <label>Partner Pan No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Partner Pan No" name="partnerPanNo" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------partner Pan No.------------->

<li>
 <div class="form-group">
  <label>Partner Aadhar No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Partner Aadhar No" name="partnerAadharNo" required>
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------GST No------------->

<li>
 <div class="form-group">
  <label>GST <span id="lblGST" style="display:none;">No. *</span> (Is Applicable) 
    <input type="checkbox" name="gstStatus" id="gstStatus"/></label>
   <input type="text" class="form-control form-control-sm" style="display:none;" placeholder="GST No" id="gstNo" name="gstNo" value="">
    <span class="text-danger"></span>
 </div>
</li>  

                            <!----------Company Name------------->

<li>
 <div class="form-group">
  <label id="company" style="display:none;">Company Name</label>
   <input type="text" class="form-control form-control-sm"  style="display:none;" placeholder="Company Name" name="companyName" id="companyName" value="">
    <span class="text-danger"></span>
 </div>
</li>     

                            <!----------Company Email------------->

<li>
 <div class="form-group">
  <label id="company_email" style="display:none;">Company Email</label>
   <input type="email" class="form-control form-control-sm"  style="display:none;" placeholder="Company Email" name="companyEmail" id="companyEmail" value="">
    <span class="text-danger"></span>
 </div>
</li>     
</ul>

                <!----------Button------------->

<div class="card-footer" style="text-align: center;">
 <button type="submit" name="add_lead" class="btn btn-primary">Save</button>
 <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
</div>

    </form>
   </div>
  </div>
 </section>
</div>
</div>
 </section>
</div>


<script>
$(document).ready(function(){

$('#prop_type').on('change', function(){
        var id = $(this).val();

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

    $('#tenantType').on('change', function(){
        var id = $(this).val();
            console.log(id);
        if (id == "NI") {
            $("#power_of_attorney").hide();
            $("#gstStatus").prop("checked", true);
            $("#lblGST").hide();
            $("#gstNo").show();
            $("#gstNo").focus();
            $("#gstNo").attr('required',false);

            $("#company").show();
            $("#companyName").show();

            $("#company_email").show();
            $("#companyEmail").show();

        } else {
            $("#gstStatus").prop("checked", false);
            $("#power_of_attorney").show();
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
