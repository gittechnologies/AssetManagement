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
$other_charges_count =0;
?>


<!----------HTML Code------------->


<?php include '../menu.php';?>

<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Edit Rent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Rent</li>
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
    <select class="form-control form-control-sm" id = "agreement" 
    name="agreement" required>
     <option value="0"> Select Agreement </option>
      <?php 
       $result = $dbConn->query("SELECT a.agreement_id, (select concat(t.tenant_name, ' - ', t.pan_no) FROM det_tenant t where t.tenant_id = a.tenant_id) as tenant_name, (select concat(p.property_name,' - ',p.flat_no,', ',p.city_id,' - ',p.pincode) as property_name from det_property p where p.property_id = a.property_id) as property_name 
        FROM `det_agreement` a where a.status = 'Active'  ");
       $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
         {
          $pid=$row['agreement_id'];
          $pname=$row['property_name'];
        ?>
     <option value="<?php echo $pid;?>" 
      <?php      
        if($pid=="$v_agreement_id")  
        {
         echo " selected";
        }
      ?>
      >
      <?php echo $pname;?></option>
       <?php  }?>
    </select>  
  </div>
</li>

<li>
   <div class="form-group">
  <label>Rent Date <span>*</span></label>
   <input type="date" class="form-control form-control-sm" placeholder="Rent Date" name="rentDate" value="<?php echo $v_rent_date;?>" required>
    <span class="text-danger"></span>
 </div>
</li>
                                   
                   <!----------Rent Per Month------------->

<li>
 <div class="form-group">
  <label>Rent<span>*</span></label>
   <input type="text" class="form-control form-control-sm txtField baseRent" placeholder="Base Rent" 
   name="baseRent" id="baseRent" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_rent_amount;?>" 
    required>
    <span class="text-danger"></span>
 </div>
</li>

<!----------Other Charges------------->

<!-- <li>
 <div class="from-group">
 <label>Other Charges</span></label><br>
  <div class="appending_div row">
   <div class="col-md-6">
     <input type="text" name="otherChargesDesc" class="form-control form-control-sm" 
     placeholder="Charges Description" value="<?php echo $v_other_charges;?>" >     
  </div>
   <div class="col-md-6">
    <input type="text" name="otherChargesAmt" id="otherChargesAmt" class="form-control form-control-sm txtField" placeholder="Charges Amount" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_charges_amount;?>">    
   </div>
 </div>
</div>
</li> -->


<li id="dynamicLi">
  <label>Other Charges</label><br>

<?php 
  $other_charges_sql = $dbConn->query("select r.rent_id, oc.charges_description , oc.amount from det_rent r join det_rent_other_charges oc ON r.rent_id = oc.rent_id  where r.rent_id='$id'");
  // print_r($other_charges_sql);
  // die();
  $other_charges_sql->execute();
  $other_charges_data = $other_charges_sql->fetchAll(PDO::FETCH_ASSOC);

  if (count($other_charges_data) > 0) {
    foreach ($other_charges_data as $no => $charges)
    { 
      $v_other_charges_desc = ucwords($charges['charges_description']);
      $v_other_charges_amount = $charges['amount'];
      $other_charges_count = $no;
    ?>
    <?php if ($no == 0) { ?>
    <div class="from-group">   
        <br>
        <div class="appending_div row">
          <div class="col-5">
          <!-- <label>Charges Description</label> -->
          <input type="text" name="otherCharges[<?php echo $no; ?>][otherChargesDesc]" class="form-control form-control-sm" placeholder="Charges Description" value="<?php echo $v_other_charges_desc;?>">     
          </div>
          <div class="col-5">
          <!-- <label>Other Charge Amount</label> -->
          <input type="text" name="otherCharges[<?php echo $no; ?>][otherChargesAmt]" id="otherChargesAmt" class="form-control form-control-sm txtField otherChargesAmt" placeholder="Other Charge Amount" onkeypress="return /[0-9]/i.test(event.key)"  value="<?php echo $v_other_charges_amount;?>">    
          </div>
          <div class="col-2  ">
            <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
          </div>
        </div>
      </div>
    <?php 
      } else {
    ?>
    <div class="from-group dynamicAdd">
      <br>
      <div class="appending_div row">
        <div class="col-5">
          <input type="text" name="otherChargesDesc[]" class="form-control form-control-sm" placeholder="Charges Description" value="<?php echo $v_other_charges_desc;?>">
        </div>
        <div class="col-5">
            <input type="text" name="otherChargesAmt[]" id="otherChargesAmt" class="form-control form-control-sm txtField otherChargesAmt" placeholder="Other Charge Amount" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_other_charges_amount;?>">
          </div>
          <div class="col-2 ">
            <button type="button" class="btn btn-danger remove-div"><i class="fa fa-minus"></i></button>
          </div>
        </div>
      </div>
    <?php 
      }
    }
  } else {

  ?>
 <div class="from-group">
    <div class="appending_div row">
      <div class="col-5">
      <!-- <label>Charges Description</label> -->
      <input type="text" name="otherCharges[0][otherChargesDesc]" class="form-control form-control-sm" 
      placeholder="Charges Description">     
      </div>
      <div class="col-5">
      <!-- <label>Other Charge Amount</label> -->
      <input type="text" name="otherCharges[0][otherChargesAmt]" id="otherChargesAmt" class="form-control form-control-sm txtField otherChargesAmt" placeholder="Other Charge Amount" onkeypress="return /[0-9]/i.test(event.key)">    
      </div>
      <div class="col-2  ">
        <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
      </div>
    </div>
  </div>
  <?php
  }
    ?>
    <span class="other_charges_count" style="display:none;"><?php echo $other_charges_count; ?></span>
</li>

<!----------GST No------------->

<li>
  <br>
 <div class="form-group">
  <label>GST Amount (Is Applicable) <input type="checkbox" name="gstStatus" 
    id="gstStatus" value="<?php echo $v_gst_status;?>"

<?php 
 if ($v_gst_status == 'Y') {
   ?> checked 
 <?php } ?>
     />
  </label>
   <input type="text" class="form-control form-control-sm txtField" placeholder="GST Amount" 
   id="gstAmt" name="gstAmt" value="<?php echo $v_gst_amount;?>" readonly>
    <span class="text-danger"></span>
 </div>
</li> 

<li>
<br>
 <div class="form-group">
  <label>Total Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Amount to be paid" name="totalAmount" id="totalAmount" value="<?php echo $v_total_amount;?>">
    <span class="text-danger"></span>
 </div>
</li>
<li>

</ul>
</div>

<div class="card-footer" style="text-align: center;">
 <button type="submit" name="add_lead" class="btn btn-primary">Update</button>
 <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
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


function gstCal () {
  let baseRent = $('#baseRent').val();

    let allOtherCharges = [0];
    let otheCharges = 0;

    $('.otherChargesAmt').each(function() { allOtherCharges.push(parseInt($(this).val())); });

    allOtherCharges.forEach( num => {
      num = ~~num
      otheCharges += num;
    })
      // alert(allOtherCharges);
      // alert(otheCharges);

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

function  calTotal() {
  var totRent =  0;
    
    $("#myField .txtField").each(function(){

        var fieldValue = $(this).val();
      
        if($.isNumeric(fieldValue)){
            
            totRent+=parseFloat(fieldValue);
        }
    });

    $("#totalAmount").val(totRent);
}

  $(document).on("click","#gstStatus",function() {
// $("#gstStatus").click(function (){
    if ($(this).is(":checked")){

      gstCal();
    }
    else{

        $('#gstAmt').val('0');
    }

    calTotal();

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

let i = parseInt($('.other_charges_count').text());

$("#form1 #add").click(function(){
  ++i;

  $("#dynamicLi").append('<div class="from-group dynamicAdd"><br><div class="appending_div row"><div class="col-5"><input type="text" name="otherCharges['+i+'][otherChargesDesc]" class="form-control form-control-sm" placeholder="Charges Description"></div><div class="col-5"><input type="text" name="otherCharges['+i+'][otherChargesAmt]" id="otherChargesAmt" class="form-control form-control-sm txtField otherChargesAmt" placeholder="Other Charge Amount" onkeypress="return /[0-9]/i.test(event.key)"></div><div class="col-2 "><button type="button" class="btn btn-danger remove-div"><i class="fa fa-minus"></i></button></div></div></div>');

});
   
$('#form1').on('click', '.remove-div', function(){  
  $(this).parents(':eq(2)').remove();
});


$(document).on("keyup",".otherChargesAmt",function(){
  if ($("#gstStatus").is(":checked")) {
    gstCal();
  }
  calTotal();
});

$(document).on("keyup",".baseRent",function(){
  if ($("#gstStatus").is(":checked")) {
    gstCal();
  }
  calTotal();
});

</script>