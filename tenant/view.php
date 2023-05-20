 <?php define('URL', 'http://localhost/pms/'); ?>
 <!DOCTYPE html>
 <html>
<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: ../login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
 
 $id = $_GET['id'];
$result = $dbConn->query("SELECT t.tenant_id, t.tenant_name, t.gender, t.dob, t.address, t.state_id as state_id,
t.city_id as city_id, t.pincode, t.contact_number, t.email_id, t.pan_no, 
t.occupation, t.gst_status, t.gst_no, t.company_name, t.company_email,
t.power_of_attorney FROM det_tenant t WHERE t.tenant_id='$id';");
$result->execute();
  while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_tenant_id=$row['tenant_id'];
    $v_tenant_name=$row['tenant_name'];
    $v_gender=$row['gender'];
    $v_dob=$row['dob'];
    $v_address=$row['address'];
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
        $gstStatus = 'Yes';          
    }
    else{
        $v_status_gst = '';
        $gstStatus = 'No';
    }
    $v_gst_no=$row['gst_no'];
    $v_company=$row['company_name'];
    $v_official_email=$row['company_email'];
    $v_power_of_attorney=$row['power_of_attorney'];
}

?>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../js/ModalPopupWindow.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" type="text/css" href="<?php echo URL ?>css/tempusdominus-bootstrap-4.min.css">

<link rel="stylesheet" href="<?php echo URL ?>css/icheck-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/jqvmap.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/asset-style.css">
<link rel="stylesheet" href="<?php echo URL ?>css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?php echo URL ?>css/daterangepicker.css">
<link rel="stylesheet" href="<?php echo URL ?>css/summernote-bs4.min.css">
<link href="<?php echo URL ?>css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo URL ?>css/style.css">
<link rel="stylesheet" href="<?php echo URL ?>css/responsive.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo URL ?>css/font-awesome.min.css">

<style>
div li.abc2 {
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:20px;
  height:25px;
  border-radius:50%;
  background-color:#000;
  color:#fff;
}

body {
  font-family: 'Poppins';
  margin-left: 0px;
}
.hide {
  display: none;
}
p {
  font-weight: normal;
}

div class.content-wrapper
{
  margin: 0px!important;
}
</style>

</head>
<body>

<div class="">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Tenant Details</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Tenant Details</li>
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
  <label class="form-control form-control-sm"><?php echo $v_tenant_name;?> </label>
 </div>
</li>
<li>
   <div class="form-group">
  <label>Gender <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_gender;?> </label>
 </div>
</li>
<li>
   <div class="form-group">
  <label>Date of Birth <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_dob;?> </label>
 </div>
</li>
<li>
 <div class="form-group">
  <label>Address <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_address;?> </label>
 </div>
</li>
<li>
 <div class="form-group">
  <label>State <span>*</span></label><br>

<div id="div0">
     <?php 
      $result = $dbConn->query("SELECT name FROM states where country_id = 101 and id='$v_state'");

      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $param_value=$row['name'];
      }
      else{
        $param_value="";
      }  
      
      ?>
     <label class="form-control form-control-sm">
    <?php echo $param_value;?></label>
  </div>

 </div> 
</li>

<li class="text-area">
 <div class="form-group">
  <label>City <span>*</span></label>
   <div id="div0">
    <?php 
      $result = $dbConn->query("SELECT name FROM cities where id='$v_city'");

      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $param_value=$row['name'];
      }
      else{
        $param_value="";
      }
      ?>
     <label class="form-control form-control-sm">
    <?php echo $param_value;?></label>
  </div>
 </div>
</li>

<li class="text-area">
 <div class="form-group">
  <label>Pincode <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_pincode;?> </label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Mobile Number <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_contact_number;?> </label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Email <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_email;?> </label>
 </div>
</li>


<li>
 <div class="form-group">
  <label>Occupation</label>
  <label class="form-control form-control-sm"><?php echo $v_occupation;?> </label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Pan No.<span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_pan_no;?> </label>
 </div>
</li>
<li>
   <div class="form-group">
  <label>Power Of Attorney </label>
  <label class="form-control form-control-sm"><?php echo $v_power_of_attorney;?> </label>
 </div>
</li>
<li>
 <div class="form-group">
  <label>GST No.<span id="lblGST" style="display:none;">*</span> (Is Applicable) : <?php echo $gstStatus;?> 
  <input type="checkbox" name="gstStatus" id="gstStatus" <?php echo $v_status_gst;?> /></label>
  <label class="form-control form-control-sm" style="display:none;" placeholder="GST No" id="gstNo" name="gstNo"><?php echo $v_gst_no;?> </label>  
 </div>
</li>  

<li>
 <div class="form-group">
  <label id="company" style="display:none;">Company Name</label>
  <label class="form-control form-control-sm" style="display:none;" placeholder="Company Name" name="companyName" id="companyName"><?php echo $v_company;?> </label>
 </div>
</li>     

<li>
 <div class="form-group">
  <label id="company_email" style="display:none;">Company Email</label>
  <label class="form-control form-control-sm" style="display:none;" placeholder="Company Email" name="companyEmail" id="companyEmail"><?php echo $v_official_email;?> </label>  
 </div>
</li>  

</ul>

 <div class="card-footer">
  <button type="button" name="close" id="close-button" class="btn btn-primary">Close</button>
 </div>
    </form>
   </div>
  </div>
 </section>
</div>
</body>

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
$("#gstStatus").attr("disabled", true);

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

$("#close-button").click(function (){
  parent.location.reload();
});
</script>

</html>