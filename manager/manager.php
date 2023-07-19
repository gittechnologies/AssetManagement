<?php
 session_start();
 include_once ('../conn.php');
 include '../menu.php';
 ?>

<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Add Agent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Agent</li>
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
      
<form action="add.php" name="forml" id="form1" method="POST" onsubmit="return myfunction()" >

                  <!----------Agent Details------------->

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2"> 
  <h3 class="card-title">Agent Details</h3>
</div>
<ul class="add-lead-ul">


                      <!----------manager Name------------->

<li>
   <div class="form-group">
  <label>Agent Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Agent Name" name="managerName" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
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

                      <!----------Contact Number------------->

<li>
 <div class="form-group">
  <label>Contact Number <span>*</span></label>
   <input type="tel" class="form-control form-control-sm" id="contactNumber" name="contactNumber" placeholder="Contact Number" pattern="[0-9]{10}" required>
    <span class="text-danger"></span>
 </div>
</li>

                  <!----------Email------------->

<li>
 <div class="form-group">
  <label>Email<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Email" name="email" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                   <!----------Brokerage------------->

<!-- <li>
 <div class="form-group">
  <label>Brokerage <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Brokerage" name="Brokerage" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li> -->

                           <!----------GST No------------->

<li>
 <div class="form-group">
  <label>GST No.<span id="lblGST" style="display:none;">*</span> (Is Applicable) <input type="checkbox" name="gstStatus" id="gstStatus"/></label>
   <input type="text" class="form-control form-control-sm" style="display:none;" placeholder="GST No" id="gstNo" name="gstNo" value="">
    <span class="text-danger"></span>
 </div>
</li>  

                            <!----------Company Name------------->

<li>
 <div class="form-group">
  <label id="company" style="display:none;">Company Name</label>
   <input type="text" class="form-control form-control-sm" placeholder="Company Name" id ="companyName" name="companyName" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" style="display:none;">
    <span class="text-danger"></span>
 </div>
</li>     
                      


                     <!----------Button------------->

 <div class="card-footer" align="center">
  <button type="submit" name="submit" class="btn btn-primary" >Save</button>
  <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
 </div>

    </div>
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

                      <!----------Footer------------->

<?php include '../footer.php';?> 