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
$result = $dbConn->query("SELECT rent_id, agreement_id, rent_amount, rent_date, other_charges_desc, other_charges_amount, gst_status, gst_amount, total_amount FROM det_rent WHERE rent_id='$id' ");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    
    $v_rent_id=$row['rent_id'];
    $v_agreement_id=$row['agreement_id'];
    $v_rent_amount=$row['rent_amount'];
    $v_rent_date=$row['rent_date'];
    $v_gst_status=$row['gst_status'];
    $v_gst_amount=$row['gst_amount'];
    $v_other_charges=$row['other_charges_desc'];
    $v_charges_amount=$row['other_charges_amount'];
    $v_total_amount=$row['total_amount'];
    
}
?>


<!----------HTML Code------------->


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
       <h3 class="card-title">View Rent</h3>
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">View Rent</li>
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
      
<form action="update.php" name="forml" id="form1" method="POST" 
onsubmit="return myfunction()" >

                  <!----------Rent Details------------->


<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2">
  <h3 class="card-title">Rent Details</h3>
</div>
<ul class="add-lead-ul" id="myField">

                  <!----------Rent Id------------->


<input type="hidden" name="rentId" value="<?php echo $v_rent_id;?>">  

                 <!----------Property Name------------->

<li>
 <div class="form-group">
  <label>Agreement<span>*</span></label>
<div id="div0">

     <?php 
      $result = $dbConn->query("SELECT a.agreement_id, (select concat(t.tenant_name, ' - ', t.pan_no) FROM det_tenant t where t.tenant_id = a.tenant_id) as tenant_name, (select concat(p.property_name,' - ',p.flat_no,', ',p.city_id,' - ',p.pincode) as property_name from det_property p where p.property_id = a.property_id) as property_name 
        FROM `det_agreement` a where a.status = 'Active'  ");
      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
       
      if($row != null)
      {
        $pname=$row['property_name'];
      }
      else{
        $pname="";
      }

      ?>
     <label class="form-control form-control-sm">
    <?php echo $pname;?></label>
 
  </div>   
  </div>
</li>

<li>
   <div class="form-group">
  <label>Rent Date <span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_rent_date;?></label>
 </div>
</li>
                                   
                   <!----------Rent Per Month------------->

<li>
 <div class="form-group">
  <label>Rent<span>*</span></label>
  <label class="form-control form-control-sm"><?php echo $v_rent_amount;?></label>
 </div>
</li>

<!----------Other Charges------------->


<li id="dynamicLi">
  <label>Other Charges</label><br>

<?php 
  $other_charges_sql = $dbConn->query("select r.rent_id, oc.charges_description , oc.amount from det_rent r join det_rent_other_charges oc ON r.rent_id = oc.rent_id  where r.rent_id='$id'");
  // print_r($other_charges_sql);
  // die();
  $other_charges_sql->execute();
  $other_charges_data = $other_charges_sql->fetchAll(PDO::FETCH_ASSOC);
  foreach ($other_charges_data as $no => $charges)
  { 
    $v_other_charges_desc = ucwords($charges['charges_description']);
    $v_other_charges_amount = $charges['amount'];
    $other_charges_count = $no;
  ?>
  <div class="from-group dynamicAdd">
    <br>
    <div class="appending_div row">
      <div class="col-6">
        <label class="form-control form-control-sm"><?php echo $v_other_charges_desc;?></label> 
      </div>
      <div class="col-6">
        <label class="form-control form-control-sm"><?php echo $v_other_charges_amount;?></label> 
        </div>
      
      </div>
    </div>
  <?php 
    }
  
    ?>
</li>
<li>
 <div class="from-group">
 <label>Other Charges</span></label><br>
  <div class="appending_div row">
   <div class="col-md-6">
    <label class="form-control form-control-sm"><?php echo $v_other_charges;?></label> 
  </div>
   <div class="col-md-6">
    <label class="form-control form-control-sm"><?php echo $v_charges_amount;?></label>  
   </div>
 </div>
</div>
</li>

<!----------GST No------------->

<li>
 <div class="form-group">
 <label>GST Amount (Is Applicable) <input type="checkbox" name="gstStatus" 
    id="gstStatus" disabled value="<?php echo $v_gst_status;?>"

<?php 
 if ($v_gst_status == 'Y') {
   ?> checked 
 <?php } ?>
    /></label>
  <label class="form-control form-control-sm" placeholder="GST No" id="gstAmt" name="gstAmt"><?php echo $v_gst_amount;?>
 </div>
</li> 

<li>
 <div class="form-group">
  <label>Total Amount</label>
  <label class="form-control form-control-sm"><?php echo $v_total_amount;?></label> 
 </div>
</li>
<li>

</ul>
</div>

<div class="card-footer" style="text-align: center;">
 <button type="button" name="close" id="close-button" class="btn btn-primary">Close</button>
</div>
 

 </form>
    </div>
   </div>
  </div>
 </section>
</div>
</body>
                      <!----------Footer------------->


<script type="text/javascript">


  $(document).ready(function() {

      $('[id="rentdetails"]').click(function() { //ID begins with "del"
          //code here
          let propName = propertyName.value;
          let parName = partyName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'rent.php?propertyName='+encodeURIComponent(propName)+"&partyName="+encodeURIComponent(parName);
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
      let otheCharges = $('#otherChargesAmt').val();
      
      if(baseRent == null || baseRent <= 0)
      {
        alert("Base Rent cannot be blank");
        return false;
      }

      if(otheCharges == null || otheCharges <= 0)
      {
        otheCharges = 0;
      } 

      let perc = ((parseFloat(baseRent)+parseFloat(otheCharges))*18)/100;
      $('#gstAmt').val(perc);   

    }
    else{

        $('#gstAmt').val('0');
    }

    var totRent =  0;
    $("#myField .txtField").each(function(){

        var fieldValue = $(this).val();
      
        if($.isNumeric(fieldValue)){
            
            totRent+=parseFloat(fieldValue);
        }
    });

    $("#totalAmount").val(totRent);

});

});


$(document).ready(function(){
$("#myField").on('change paste input', '.txtField', function(){


/*if ($("#gstStatus").is(":checked")){

        let baseRent = $('#baseRent').val();
        let otherChargesAmt = $('#otherChargesAmt').val();

        if(baseRent == null || baseRent <= 0)
          {
            baseRent = 0;
          }

          if(otheCharges == null || otheCharges <= 0)
          {
            otheCharges = 0;
          }

            let perc = ((parseFloat(baseRent)+parseFloat(otheCharges))*18)/100;
            $('#gstAmt').val(perc);
        }
        else
        {
            $('#gstAmt').val(0);
        }

*/
    var totRent =  0;

    $("#myField .txtField").each(function(){
        
    
        var fieldValue = $(this).val();
      
        if($.isNumeric(fieldValue)){
            
            totRent+=parseFloat(fieldValue);
        }
    });

    $("#totalAmount").val(totRent);

    });  

}); 

$("#close-button").click(function (){
  parent.location.reload();
});
</script>
</html>