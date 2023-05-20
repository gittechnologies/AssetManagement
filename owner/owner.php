
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
       <h3 class="card-title">Add Owner</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Owner</li>
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
 <h3 class="card-title">Owner Details</h3>
</div>

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr">  
<ul class="add-lead-ul">

                    <!----------Party Name------------->

<li>
 <div class="form-group">
  <label>Owner Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Owner Name" name="ownerName" required>
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

                            <!----------Pan No.------------->

<li>
 <div class="form-group">
  <label>Pan No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pan No" name="panNo" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------BANK Details------------->
                            <!----------BANK Name------------->

<li>
 <div class="form-group">
  <label id="bank" >Bank Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Bank Name" name="bankName" id="bankName" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >Branch Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Branch Name" name="branchName" id="branchName" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >Account Number<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Account Number" name="accountNo" id="accountNo" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >IFSC Number<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="IFSC Number" name="ifscNo" id="ifscNo" required>
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
    }
    else{
        $("#lblGST").hide();
         $("#gstNo").hide();
          $("#gstNo").removeAttr("required");

          $("#company").hide();
        $("#companyName").hide();
    }

});
});

</script>

<?php include '../footer.php';?> 
