<?php
 session_start();
 if(!isset($_SESSION['Email']))
  {
          header("location: login.php");
  }
  $name=$_SESSION['Email'];
 include_once ('../conn.php');
 
 $id = $_GET['id'];
$result = $dbConn->query("SELECT b.manager_id, b.manager_name, b.address, b.location, b.state_id as state_id,
b.city_id as city_id, b.pincode, b.contact_number, b.email_id, b.gst_status, b.gst_no, b.company_name
FROM det_manager b WHERE b.manager_id='$id'; ");
$result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_Id=$row['manager_id'];
    $v_manager_name=$row['manager_name'];
    $v_address=$row['address'];
    $v_location=$row['location'];
    $v_state=$row['state_id'];
    $v_city=$row['city_id'];
    $v_pincode=$row['pincode'];
    $v_contact_no=$row['contact_number'];
    $v_Email=$row['email_id'];
    // $v_brokerage=$row['brokerage'];
    $v_status_gst=$row['gst_status'];
    if($v_status_gst=='on'){
        $v_status_gst = 'checked';           
    }
    else{
        $v_status_gst = '';
    }
    $v_gst_no=$row['gst_no'];
    $v_company_name=$row['company_name'];

}

?>

<?php include '../menu.php';?>

<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Edit Agent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Agent</li>
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

                  <!----------manager Details------------->

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2"> 
  <h3 class="card-title">Agent Details</h3>
</div>
<ul class="add-lead-ul">

                    <!----------manager ID------------>

<input type="hidden" name="Id" value="<?php echo $v_Id;?>">  


                      <!----------manager Name------------->

<li>
   <div class="form-group">
  <label>Agent Name<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Agent Name" name="managerName" value="<?php echo $v_manager_name;?>" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>


<!----------Address------------->

<li>
 <div class="form-group">
  <label>Address</label>
   <input type="text" class="form-control form-control-sm" placeholder="Address" name="address" value="<?php echo $v_address;?>">
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

                      <!----------City------------->

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

                   <!----------Pincode------------->

<li class="text-area">
 <div class="form-group">
  <label>Pincode</label><span>*</span>
   <input type="text" id="pincode" class="form-control form-control-sm" placeholder="Pincode" name="pincode" pattern="[0-9]{6}" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_pincode;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Contact Number------------->

<li>
 <div class="form-group">
  <label>Contact Number <span>*</span></label>
   <input type="tel" class="form-control form-control-sm" id="contactNumber" name="contactNumber" placeholder="Contact Number" pattern="[0-9]{10}" value="<?php echo $v_contact_no;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

                  <!----------Email------------->

<li>
 <div class="form-group">
  <label>Email<span>*</span></label>
   <input type="email" class="form-control form-control-sm" placeholder="Email " name="email" value="<?php echo $v_Email;?>" required>
    <span class="text-danger"></span>
 </div>
</li>


                   <!----------Brokerage------------->
<!-- 
<li>
 <div class="form-group">
  <label>Brokerage <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Brokerage" name="Brokerage" value="<?php //echo $v_brokerage;?>" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li> -->

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
   <input type="text" class="form-control form-control-sm"  style="display:none;" placeholder="Company Name" name="companyName" id="companyName" value="<?php echo $v_company_name;?>">
    <span class="text-danger"></span>
 </div>
</li>  

                     <!----------Button------------->

 <div class="card-footer" align="center">
  <button type="submit" name="submit" class="btn btn-primary" >Update</button>
  <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
 </div>

    </div>
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