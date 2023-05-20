 <?php define('URL', 'http://localhost/pms/'); ?>
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
    $v_property_sub_type=$row['prop_sub_type']; 
    $v_owner_id=$row['owner_id'];
    $v_location=$row['location'];
    $v_city=$row['city'];
     
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
<div class="" >
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Property Details</h3>
       <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Property Details</li>
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
   <label class="form-control form-control-sm"><?php echo $v_property_name;?></label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Property Type <span>*</span></label><br>
    
    <div id="div0">

     <?php 
      $result = $dbConn->query("SELECT param_value FROM mst_common_param where group_id = 1 and param_code= '$v_property_type'");
      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $param_value=$row['param_value'];
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

<li >
 <div class="form-group">
  <label>Property Sub Type <span>*</span></label>

<div id="div0">

     <?php 
      $result = $dbConn->query("SELECT prop_sub_type  FROM m_property_type where prop_type = '$v_property_type' 
        and id='$v_property_sub_type'");
      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
      if($row != null)
      {
        $param_value=$row['prop_sub_type'];
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
<!-- 
<li>
 <div class="form-group">
  <label>Owner Name <span>*</span></label><br>
    
    <div id="div0">
     <?php 
      // $result = $dbConn->query("SELECT owner_name FROM det_owner where owner_id = '$v_owner_id'");
      // $result->execute();
      // $row = $result->fetch(PDO::FETCH_ASSOC);
      //   if($row != null)
      // {
      //   $owner_name=$row['owner_name'];
      // }
      // else{
      //   $owner_name="";
      // }

      ?>
     <label class="form-control form-control-sm">
    <?php //echo $owner_name;?></label>
  </div>

 </div> 
</li> -->

<li class="text-area">
 <div class="form-group">
  <label>Flat/Unit/Shop No. <span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_flatno;?> </label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Address <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_address;?></label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Landmark </label>
  <label class="form-control form-control-sm" ><?php echo $v_landmark;?></label>
 </div>
</li>

<!----------lOCATION------------->
<li class="text-area">
 <div class="form-group">
  <label>Location <span>*</span></label>
   <label class="form-control form-control-sm" ><?php echo $v_location;?></label>
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
    <span class="text-danger"></span>
 </div>
</li>

<li class="text-area">
 <div class="form-group">
  <label>Pincode <span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_pincode;?></label>
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
  <label>Build-Up Area</label>
  <label class="form-control form-control-sm"><?php echo $v_build_up_area;?></label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Carpet Area </label>
  <label class="form-control form-control-sm"><?php echo $v_carpet_area;?></label>
   
 </div>
</li>

<li>
 <div class="form-group">
  <label>Age of Property (In Years)</label>
  <label class="form-control form-control-sm"><?php echo $v_age_of_property;?></label>
   
 </div>
</li>

<li>
 <div class="form-group">
  <label>Electric Meter No.</label>
  <label class="form-control form-control-sm"><?php echo $v_elec_meter_no;?></label>

 </div>
</li>

                    <!----------Covered Parking------------->

<li>
 <div class="form-group">
  <label for="exampleInputEmail1">Covered Parking</label><br>
   <div id="div0">


<?php 
      $result = $dbConn->query("SELECT param_value FROM mst_common_param where group_id = 2 and param_code ='$v_covered_parking'");

      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $param_value=$row['param_value'];
      }
      else{
        $param_value="";
      } 
      
      ?>
     <label class="form-control form-control-sm">
    <?php echo $param_value;?></label>

  </div>
     <span class="text-danger"></span>
 </div>
</li>

                <!----------Open Parking------------->

<li>
 <div class="form-group">
  <label for="exampleInputEmail1">Open Parking</label><br>
   <div id="div0">
    <?php 
      $result = $dbConn->query("SELECT param_value FROM mst_common_param where group_id = 2 and param_code ='$v_open_parking'");

      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $param_value=$row['param_value'];
      }
      else{
        $param_value="";
      } 
      ?>
     <label class="form-control form-control-sm">
    <?php echo $param_value;?></label>  
  </div>
     <span class="text-danger"></span>
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

$('#prop_type').on('change', function(){
        var id = $(this).val();

        if(id){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
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
                url:'ajaxData.php',
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

$("#close-button").click(function (){
  parent.location.reload();
});
</script>

</html>