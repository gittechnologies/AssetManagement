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
$result = $dbConn->query("SELECT agreement_id, property_id, tenant_id, agreement_date, agreement_from, agreement_to, possession_date, locking_period, deposit_amount, 
  deposit_date, rent_per_month, gst_applicable, gst_amount, maintainance_charges, status FROM det_agreement 
  WHERE agreement_id='$id' ");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_agreement_id=$row['agreement_id'];
    $v_property_name=$row['property_id'];
    $v_party_name=$row['tenant_id'];
    
    $v_agreement_date=$row['agreement_date'];
    $v_agreement_from=$row['agreement_from'];
    $v_agreement_to=$row['agreement_to'];
    $v_possession_date=$row['possession_date'];

    $v_locking_period=$row['locking_period'];
    $v_deposit_amount=$row['deposit_amount'];
    $v_deposit_date=$row['deposit_date'];

    $v_rent_per_month=$row['rent_per_month'];
    $v_gst_applicable=$row['gst_applicable'];
    $v_gst_amount=$row['gst_amount'];

    $v_maintainance_charges=$row['maintainance_charges'];
    // $v_other_charges=$row['other_charges_desc'];
    // $v_charges=$row['oth_charges_amt'];
    
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
       <h3 class="card-title">View Agreement</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">View Agreement</li>
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
      
<form action="" name="forml" id="form1" method="POST" 
onsubmit="return myfunction()" >

                  <!----------Agreement Details------------->


<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2">
  <h3 class="card-title">Agreement Details</h3>
</div>
<ul class="add-lead-ul">

                  <!----------Agreement Id------------->


<input type="hidden" name="agreementId" value="<?php echo $v_agreement_id;?>">  

                 <!----------Property Name------------->

<li>
 <div class="form-group">
  <label>Property Name<span>*</span></label>
    <label class="form-control form-control-sm">
     
      <?php 
       $result = $dbConn->query("SELECT 
        concat(property_name,' - ',flat_no,', ', city_id, ' - ',pincode) as property_name  FROM det_property 
        where property_id = '$v_property_name' ");
       $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
         {

          $pname=$row['property_name'];
        }
        
      ?>
       <?php echo $pname;?>
    </label>  
  </div>
</li>

                      <!----------Party Name------------->


<li>
 <div class="form-group">
  <label>Party Name<span>*</span></label>
    <label class="form-control form-control-sm">
      <?php 
      $result = $dbConn->query("SELECT concat(tenant_name, ' - ', pan_no) as tenant_name   FROM det_tenant where tenant_id = '$v_party_name' ");
       $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
         {

          $pname=$row['tenant_name'];
        }
     ?>
      <?php echo $pname;?>
    </label>  
  </div>
</li><br>

<!----------Agreement Date------------->


<li>
   <div class="form-group">
  <label>Agreement Date <span>*</span></label>
   <label class="form-control form-control-sm"><?php echo $v_agreement_date;?></label>
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Agreement Form------------->

<li>
 <div class="form-group">
  <label>Agreement Starting Date <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_agreement_from;?></label>
   
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Agreement To------------->

<li>
 <div class="form-group">
  <label>Agreement End Date <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_agreement_to;?></label>
    <span class="text-danger"></span>
 </div>
</li>

<!----------Possession Date------------->


<li>
 <div class="form-group">
  <label>Possession Date</label>
  <label class="form-control form-control-sm"><?php echo $v_possession_date;?></label>
    <span class="text-danger"></span>
 </div>
</li>
                      <!----------Locking Period------------->

<li>
 <div class="form-group">
  <label>Locking Period (In Months)</label>
  <label class="form-control form-control-sm"><?php echo $v_locking_period;?></label>
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Maintaince Charges------------->

<li>
 <div class="form-group">
  <label>Deposit Amount<span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_deposit_amount;?></label>
   
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Deposit Date<span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_deposit_date;?></label>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Base Rent  <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_rent_per_month;?></label>
    <span class="text-danger"></span>
 </div>
</li>

<!----------GST No------------->

<li>
 <div class="form-group">
  <label>GST Amount [18%] (Is Applicable) 

    <input type="checkbox" name="gstStatus" disabled 
    id="gstStatus" value="<?php echo $v_gst_applicable;?>"

<?php 
 if ($v_gst_applicable == 'Y') {
   ?> checked 
 <?php } ?>
    />
  </label>
   <label class="form-control form-control-sm"><?php echo $v_gst_amount;?></label>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
 <div class="form-group">
  <label>Maintenance  <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_maintainance_charges;?></label>
    <span class="text-danger"></span>
 </div>
</li>

<!-- <li>
 <div class="from-group">
 <label>Other Charges </label><br>
  <div class="appending_div row">
   <div class="col-md-6">
    <label class="form-control form-control-sm"><?php //echo $v_other_charges;?></label> 
  </div>
   <div class="col-md-6">
    <label class="form-control form-control-sm"><?php //echo $v_charges;?></label> 
   </div>
 </div>
</div>
</li> -->

<br>

<!----------Rent Details------------->
<!--<li>
 <div class="form-group">
   <button type="button" name="docdetails" id="docdetails" class="btn btn-success" >
   Documents Upload</button>
</li>
<li>
 <div class="form-group">
   <button type="button" name="rentdetails" id="rentdetails" class="btn btn-success" >
   View/ Update Rents</button>
</li>-->
</ul>
</div>

<div class="card-footer" style="text-align: center;">
 <button type="button" name="add_lead" id="close-button"  class="btn btn-primary">Close</button>
</div>
 

 </form>
    </div>
   </div>
  </div>
 </section>
</div>

                      <!----------Footer------------->


<?php include '../footer.php';?> 

<script type="text/javascript">
  $(document).ready(function() {
  

  $('[id="docdetails"]').click(function() { 
          let propName = propertyName.value;
          let parName = partyName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'doc-details.php?propertyName='+encodeURIComponent(propName)+"&partyName="+encodeURIComponent(parName);
          window.open(url,'win2',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
          }
          else
          {
            alert("Please select property and party name");
            return false;
          }
          
      }); 

  $('[id="rentdetails"]').click(function() { 
          let propName = propertyName.value;
          let parName = partyName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'rent-details.php?propertyName='+encodeURIComponent(propName)+"&partyName="+encodeURIComponent(parName);
          window.open(url,'win2',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
          }
          else
          {
            alert("Please select property and party name");
            return false;
          }
          
      });

});

  $(document).ready(function(){
$("#gstStatus").click(function (){
     if ($(this).is(":checked")){
      let baseRent = $('#baseRent').val();
      
      if(baseRent == null || baseRent <= 0)
      {
        alert("Base Rent cannot be blank");
        return false;
      }
      else
      {
        let perc = (baseRent*18)/100;
        $('#gstAmt').val(perc);
      }    

    }
    else{

        $('#gstAmt').val('0');
    }

});
});

$(document).ready(function () {
  $('#forml').ajaxForm(function () {
  window.close();
  });
});

$("#close-button").click(function (){
  parent.location.reload();
});
</script>