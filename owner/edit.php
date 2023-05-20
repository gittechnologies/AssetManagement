
<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 
 $id = $_GET['id'];
$result = $dbConn->query("SELECT o.owner_id, o.owner_name, o.address, o.state_id,
o.city_id, o.pincode, o.contact_number, o.email_id, o.pan_no, 
o.gst_status, o.gst_no, o.company_name , o.bank_name ,o.branch_name, o.account_no,o.ifsc
FROM det_owner o WHERE o.owner_id='$id';");
$result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_owner_id=$row['owner_id'];
    $v_owner_name=$row['owner_name'];
    $v_address=$row['address'];
    $v_state=$row['state_id'];
    $v_city=$row['city_id'];
    $v_pincode=$row['pincode'];
    $v_contact_number=$row['contact_number'];
    $v_email=$row['email_id'];
    $v_pan_no=$row['pan_no'];
    $v_status_gst=$row['gst_status'];
    if($v_status_gst=='on'){
        $v_status_gst = 'checked';           
    }
    else{
        $v_status_gst = '';
    }
    $v_gst_no=$row['gst_no'];
    $v_company=$row['company_name'];
    $v_bank_name=$row['bank_name'];
    $v_branch_name=$row['branch_name'];
    $v_ifsc_no=$row['ifsc'];
    $v_account_no=$row['account_no'];

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
       <h3 class="card-title">Edit Owner</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Owner</li>
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
       <h3 class="card-title">Owner Details</h3>
      </div>
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr">  
<ul class="add-lead-ul">

<input type="hidden" name="ownerId" value="<?php echo $v_owner_id;?>">  

<li>
   <div class="form-group">
  <label>Owner Name <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Owner Name" name="ownerName" value="<?php echo $v_owner_name;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
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
  <label>Pan No.<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pan No" name="panNo" value="<?php echo $v_pan_no;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                            <!----------BANK Details------------->
                            <!----------BANK Name------------->

<li>
 <div class="form-group">
  <label id="bank" >Bank Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Bank Name" name="bankName" id="bankName" value="<?php echo $v_bank_name;?>" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >Branch Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Branch Name" name="branchName" id="branchName" value="<?php echo $v_branch_name;?>" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >Account Number<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="Account Number" name="accountNo" id="accountNo" value="<?php echo $v_account_no;?>" required>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label id="bank" >IFSC Number<span>*</span></label>
   <input type="text" class="form-control form-control-sm"  placeholder="IFSC Number" name="ifscNo" id="ifscNo" value="<?php echo $v_ifsc_no;?>" required>
    <span class="text-danger"></span>
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