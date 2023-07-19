<?php

 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');
  
$id = $_GET['id'];
$result = $dbConn->query("SELECT agreement_id, property_id,owner_id,brokerage, tenant_id, agreement_date, agreement_from, agreement_to, possession_date, locking_period, deposit_amount, 
  deposit_date, rent_per_month, gst_applicable, gst_amount, maintainance_charges, manager_id, charges_paidby_tenant,	loading_charges,amc_tenant,remark, status FROM det_agreement 
  WHERE agreement_id='$id' ");
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_agreement_id=$row['agreement_id'];
    $v_property_name=$row['property_id'];
    $v_owner_id=$row['owner_id'];
    $v_tenant_id=$row['tenant_id'];
    
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
    $v_manager_id=$row['manager_id'];
    $v_brokerage=$row['brokerage'];
    $v_loading_charges=$row['loading_charges'];
    $v_amc_tenant=$row['amc_tenant'];
    $v_remark=$row['remark'];



  //  $v_charges=$row['charges_paidby_tenant'];     
    //$v_other_charges=$row['other_charges_desc'];
    //$v_charges=$row['oth_charges_amt'];
    
}
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
       <h3 class="card-title">Edit Agreement</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Edit Agreement</li>
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
   <select class="form-control form-control-sm" id ="propertyName" name="propertyName" required>
    <option value="0"> Select Property </option>
     <?php 
     $result = $dbConn->query("SELECT dp.property_id, dp.property_name, dp.flat_no, dp.city_id, dp.pincode ,c.name FROM det_property dp join cities c on dp.city_id = c.id ");
      // $result = $dbConn->query("SELECT p.property_id, p.property_name,p.flat_no, p.city_id,p.pincode, c.name FROM det_property p join cities c on p.city_id=c.id WHERE NOT EXISTS (SELECT property_id FROM det_agreement AS a WHERE a.property_id=p.property_id AND a.status='Active')");
      $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $propertyName=$row['property_name'];
         $id=$row['property_id'];   
     ?>
    <option value="<?php echo $id;?>" <?php  echo ($id == $v_property_name )?" selected":'' ?>>
                   <?php echo $propertyName . " - " . $row['flat_no'] . " - " . $row['name']." - ".$row['pincode'];?>
    </option>
     <?php  }
     ?>
   </select>  
 </div>
</li>

                      <!----------owner Name------------->

<li>
 <div class="form-group">
  <label>Owner Name<span>*</span></label>
   <select class="form-control form-control-sm" id="ownerName" name="ownerName" required>
    <option value="0"> Select Owner </option>
     <?php 
     $result = $dbConn->query("SELECT op.id ,o.owner_id,o.owner_name,op.unitNo ,op.property_id  FROM det_owner_property op JOIN det_owner o ON op.owner_id = o.owner_id  where op.property_id = '$v_property_name'");
      // $result = $dbConn->query("SELECT property_id, concat(property_name,' - ',flat_no,', ', unitNo, ' - ',pincode) as property_name FROM det_property AS p WHERE NOT EXISTS (SELECT property_id  FROM det_agreement AS a WHERE a.property_id=p.property_id AND a.status='Active')");
      $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
     ?>

    <option value="<?php echo  $row['owner_id']?>" <?php  echo ($v_owner_id == $row['owner_id'] )?" selected":'' ?>><?php echo $row['owner_name'].' - '.$row['unitNo']?>
    </option> 
     <?php  }
     ?>
   </select>  
 </div>
</li>

                      <!----------Tenant Name------------->


<li>
 <div class="form-group">
  <label>Tenant Name<span>*</span></label>
    <select class="form-control form-control-sm" id = "tenantyName" name="tenantyName" required>
     <option value="0"> Select Tenant </option>
      <?php 
      $result = $dbConn->query("SELECT tenant_id,concat(tenant_name, ' - ', pan_no) as tenant_name   FROM det_tenant ");

       $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
         {
          $tname=$row['tenant_name'];
          $tid=$row['tenant_id'];
        ?>
     <option value="<?php echo $tid;?>"
      <?php       
      
        if($tid=="$v_tenant_id")  
        {
         echo "selected";
        }
      ?>
      >
      <?php echo $tname;?></option>
       <?php  }?>
    </select>  
  </div>
</li>


<!----------Agreement Date------------->


<li>
   <div class="form-group">
  <label>Agreement Date <span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="agreement Date" name="agreementDate" value="<?php echo $v_agreement_from;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Agreement Form------------->

<li>
 <div class="form-group">
  <label>Agreement Starting Date <span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Agreement From" name="agreementFrom" value="<?php echo $v_agreement_from;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Agreement To------------->

<li>
 <div class="form-group">
  <label>Agreement End Date <span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Agreement To" name="agreementTo" value="<?php echo $v_agreement_to;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<!----------Possession Date------------->


<li>
 <div class="form-group">
  <label>Possession Date</label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Possession Date" 
   name="possessionDate" value="<?php echo $v_possession_date;?>" >
    <span class="text-danger"></span>
 </div>
</li>
                      <!----------Locking Period------------->

<li>
 <div class="form-group">
  <label>Locking Period (In Months)</label>
   <input type="text" class="form-control form-control-sm" placeholder="Locking Period" 
   name="lockingPeriod" value="<?php echo $v_locking_period;?>" onkeypress="return /[0-9]/i.test(event.key)">
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Maintaince Charges------------->

<li>
 <div class="form-group">
  <label>Deposit Amount<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Deposit Amount" 
   name="depositAmount" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_deposit_amount;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Deposit Date<span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Deposit Date" 
   name="depositDate" value="<?php echo $v_deposit_date;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Rent  <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Base Rent" 
   name="baseRent" id="baseRent" onkeypress="return /[0-9]/i.test(event.key)" 
   value="<?php echo $v_rent_per_month;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Maintenance  <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="maintenance charges" name="maintainceCharges" value="<?php echo $v_maintainance_charges;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

              <!----------GST No------------->

<li>
 <div class="form-group">
  <label>GST Amount (Is Applicable) <input type="checkbox" name="gstStatus" 
    id="gstStatus" value="<?php echo $v_gst_applicable;?>"

<?php 
 if ($v_gst_applicable == 'Y') {
   ?> checked 
 <?php } ?>
    />
  </label>
   <input type="text" class="form-control form-control-sm" placeholder="GST Amount" 
   id="gstAmt" name="gstAmt" value="<?php echo $v_gst_amount;?>">
    <span class="text-danger"></span>
 </div>
</li> 


<!----------Manager Name------------->
<li>
 <div class="form-group">
  <label>Agent Name<span>*</span></label>
  <select class="form-control form-control-sm" id = "managerName" name="managerName" required>
    <option value="0"> Select Agent </option>
    <?php 
      $result = $dbConn->query("SELECT manager_id, concat(manager_name,' - ',pan_no) as manager_name FROM det_manager 
        where status='Active'");

       $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
         {
          $mname=$row['manager_name'];
          $mid=$row['manager_id'];
        ?>
     <option value="<?php echo $mid;?>"
      <?php       
      
        if($mid=="$v_manager_id")  
        {
         echo "selected";
        }
      ?>
      >
      <?php echo $mname;?></option>
       <?php  }?>     
   </select> 
 </div>
</li>

                   <!----------Brokerage------------->

 <li>
 <div class="form-group">
  <label>Commision <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Commision" name="Brokerage" value="<?php echo $v_brokerage;?>" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li>

<!----------Charges Paid By Tenant------------->
<!-- <li>
 <div class="from-group">
 <label>Charges Paid By Tenant</label><br/>
      <select id="charges" name="charges" class="form-control form-control-sm" multiple> 
            <option value="Electricity" <?php if($v_charges=="Electricity") echo 'selected'; ?>>Electricity Bill</option>
            <option value="Water" <?php if($v_charges=="Water") echo 'selected'; ?>>Water Bill</option>
            <option value="Property" <?php if($v_charges=="Property") echo 'selected'; ?>>Property Tax</option>
            <option value="Other" <?php if($v_charges=="Other") echo 'selected'; ?>>Other Charges</option>
        </select>

</select>     
</div>
</li>    -->

<!--
<li>
 <div class="from-group">
 <label>Other Charges </label><br>
  <div class="appending_div row">
   <div class="col-md-6">
     <input type="text" name="otherChargesDesc" class="form-control form-control-sm" 
     placeholder="Charges Description" value="<?php //echo $v_other_charges;?>">     
  </div>
   <div class="col-md-6">
    <input type="text" name="otherChargesAmt" class="form-control form-control-sm" placeholder="Charges Amount" value="<?php// echo $v_charges;?>" onkeypress="return /[0-9]/i.test(event.key)"> 
   </div>
 </div>
</div>
</li>

<br>-->

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

                   <!----------Loading/Unloading charges------------->

<li>
 <div class="form-group">
  <label>Loading/Unloading Charges </label>
   <input type="text" class="form-control form-control-sm" placeholder="Loading/Unloading charges" name="loadingCharges" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $v_loading_charges;?>">
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------AMC-Tenant------------->

<li>
   <div class="form-group">
  <label>AMC-Tenant<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="AMC-Tenant" name="AmcTenant" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" value="<?php echo $v_amc_tenant;?>" required>
    <span class="text-danger"></span>
 </div>
</li>

                        <!----------Remark------------->

<li>
 <div class="form-group">
  <label>Remark</label>
   <input type="text" class="form-control form-control-sm" placeholder="Remark" name="remark" value="<?php echo $v_remark;?>">
    <span class="text-danger"></span>
 </div>
</li>

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
  $(document).ready(function () {
    $('input[class$=dates]').datepicker({
      dateFormat: 'dd-mm-yy'			// Date Format "dd-mm-yy"
    });
  });

  $(document).ready(function() {
  

  $('[id="docdetails"]').click(function() { 
          let propName = propertyName.value;
          let parName = tenantName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'doc-details.php?propertyName='+encodeURIComponent(propName)+"&tenantName="+encodeURIComponent(parName);
          window.open(url,'win2',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
          }
          else
          {
            alert("Please select property and tenant name");
            return false;
          }
          
      }); 

  $('[id="rentdetails"]').click(function() { 
          let propName = propertyName.value;
          let parName = tenantName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'rent-details.php?propertyName='+encodeURIComponent(propName)+"&tenantName="+encodeURIComponent(parName);
          window.open(url,'win2',
            'status=no,toolbar=no,scrollbars=yes,titlebar=no, menubar=no, resizable=yes,width=1076,height=768,directories=no,location=no');
          }
          else
          {
            alert("Please select property and tenant name");
            return false;
          }
          
      });


});

$(document).on("change","#propertyName",function(){
  // $("#propertyName").on('change', function(){
    console.log("list item selected");
    var property_id = $(this).val();

    if(property_id){
        $.ajax({
            type:'POST',
            url:'../ajaxData.php',
            data:'owner_property_id='+property_id,
            success:function(html){

              if (html.trim() ==="false") {
                alert("Please add owner First");
                document.getElementById('propertyName').value= " Select Property ";
                window.location='../property/add-owner.php?id='+property_id;
              } else {
                console.log(html);

                $('#ownerName').html(html);
              }
            }
        }); 
    }else{
        $('#ownerName').html('<option value="">Select Property first</option>'); 
    }
  });
</script>