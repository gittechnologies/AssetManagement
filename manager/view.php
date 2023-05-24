 <?php 
 include_once ('../path.php');
 ?>
 <!DOCTYPE html>
 <html>
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
b.city_id as city_id, b.pincode, b.contact_number, b.email_id,  b.gst_status, b.gst_no, b.company_name
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
    $v_company_name=$row['company_name'];

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
       <h3 class="card-title">Commission Agent Details</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Commission Agent Details</li>
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
  <h3 class="card-title">Commission Agent Details</h3>
</div>
<ul class="add-lead-ul">

                    <!----------manager ID------------>

<input type="hidden" name="Id" value="<?php echo $v_Id;?>">  


                      <!----------manager Name------------->

<li>
   <div class="form-group">
  <label>Commission Agent Name<span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_manager_name;?></label>
 </div>
</li>


<!----------Address------------->

<li>
 <div class="form-group">
  <label>Address</label>
   <label class="form-control form-control-sm"><?php echo $v_address;?></label>
 </div>
</li>

                        <!----------lOCATION------------->

<li class="text-area">
 <div class="form-group">
  <label>Location <span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_location;?></label>
 </div>
</li>


                            <!----------State------------->
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

                      <!----------City------------->

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

                   <!----------Pincode------------->

<li class="text-area">
 <div class="form-group">
  <label>Pincode</label><span>*</span>
   <label class="form-control form-control-sm"><?php echo $v_pincode;?></label>
 </div>
</li>

                      <!----------Contact Number------------->

<li>
 <div class="form-group">
  <label>Contact Number <span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_contact_no;?></label>
 </div>
</li>

                  <!----------Email------------->

<li>
 <div class="form-group">
  <label>Email<span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_Email;?></label>
 </div>
</li>


                   <!----------Brokerage------------->

<!-- <li>
 <div class="form-group">
  <label>Brokerage <span>*</span></label>
   <label class="form-control form-control-sm"><?php //echo $v_brokerage;?></label>
 </div>
</li> -->

 <li>
 <div class="form-group">
  <label>GST No.<span id="lblGST" style="display:none;">*</span> (Is Applicable) : <?php echo $gstStatus;?> <input type="checkbox" name="gstStatus" id="gstStatus" <?php echo $v_status_gst;?> /></label>
  <label class="form-control form-control-sm" style="display:none;" placeholder="GST No" id="gstNo" name="gstNo"><?php echo $v_gst_no;?> </label>  
 </div>
</li>  

<li>
 <div class="form-group">
  <label id="company" style="display:none;">Company Name</label>
  <label class="form-control form-control-sm" style="display:none;" placeholder="Company Name" name="companyName" id="companyName"><?php echo $v_company_name;?> </label>
 </div>
</li>   

                     <!----------Button------------->

 <div class="card-footer" align="center">
 <button type="button" name="close" id="close-button" class="btn btn-primary">Close</button>
 </div>

    </div>
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

$("#close-button").click(function (){
  parent.location.reload();
});
</script>

</html>