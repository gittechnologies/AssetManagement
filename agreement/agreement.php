<?php
 session_start();
 include_once ('../conn.php');
 ?>

 <?php include '../menu.php';?>
 <!-- <style type="text/css">
   
 .inputFld{border:1px #ccc solid; display:inline-block; width:200px; padding:5px 10px;}
 .addIcon{display:inline-block; padding:5px; text-decoration:none; color:#green;}
 .addIcon:hover{color:#0000ff;}
 .crossIcon{display:inline-block; padding:5px; text-decoration:none; color:#ff0000;}
 .crossIcon:hover{color:#0000ff;}
 </style>
<style>
        /*Copied from bootstrap to handle input file multiple*/
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        /*Also */
        .btn-success {
            border: 1px solid #c5dbec;
            background: #D0E5F5;
            font-weight: bold;
            color: #2e6e9e;
        }
        /* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
        .fileinput-button {
            position: relative;
            overflow: hidden;
        }

            .fileinput-button input {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                opacity: 0;
                -ms-filter: 'alpha(opacity=0)';
                font-size: 200px;
                direction: ltr;
                cursor: pointer;
            }

        .thumb {
            height: 80px;
            width: 100px;
            border: 1px solid #000;
        }

        ul.thumb-Images li {
            width: 120px;
            float: left;
            display: inline-block;
            vertical-align: top;
            height: 120px;
        }

        .img-wrap {
            position: relative;
            display: inline-block;
            font-size: 0;
        }

            .img-wrap .close {
                position: absolute;
                top: 2px;
                right: 2px;
                z-index: 100;
                background-color: #D0E5F5;
                padding: 5px 2px 2px;
                color: #000;
                font-weight: bolder;
                cursor: pointer;
                opacity: .5;
                font-size: 23px;
                line-height: 10px;
                border-radius: 50%;
            }

            .img-wrap:hover .close {
                opacity: 1;
                background-color: #ff0000;
            }

        .FileNameCaptionStyle {
            font-size: 12px;
        }

    </style> -->
<script type="text/javascript" href="../js/multiDropSelect.js"></script>

<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Add Agreement</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Agreement</li>
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
      
<form action="add.php" name="forml" id="form1" method="POST" 
onsubmit="return myfunction()" >

                  <!----------Agreement Details------------->

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2"> 
  <h3 class="card-title">Agreement Details</h3>
</div>
<ul class="add-lead-ul">

                      <!----------Property Name------------->


<li>
 <div class="form-group">
  <label>Property Name<span>*</span></label>
   <select class="form-control form-control-sm" id = "propertyName" name="propertyName" required>
    <option value="0"> Select Property </option>
     <?php 
      $result = $dbConn->query("SELECT p.property_id, p.property_name,p.flat_no, p.city_id,p.pincode, c.name FROM det_property p join cities c on p.city_id=c.id WHERE NOT EXISTS (SELECT property_id FROM det_agreement AS a WHERE a.property_id=p.property_id AND a.status='Active')");
      $result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $propertyName=$row['property_name'];
         $id=$row['property_id'];   
     ?>
   <option value="<?php echo $id;?>"><?php echo $propertyName . " - " . $row['flat_no'] . " - " . $row['name']." - ".$row['pincode'];?>
    </option>
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
     
   </select>  
 </div>
</li>


                      <!----------Tenant Name------------->

<li>
 <div class="form-group">
  <label>Tenant Name<span>*</span></label>
  <select class="form-control form-control-sm" id = "tenantName" name="tenantName" required>
    <option value="0"> Select Tenant </option>
     <?php 
      $result = $dbConn->query("SELECT tenant_id,concat(tenant_name,' - ',pan_no) as tenant_name FROM det_tenant where status='Active'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $tenantName=$row['tenant_name'];
         $id=$row['tenant_id'];
     ?>
    <option value="<?php echo $id;?>">
     <?php echo $tenantName;?>
    </option>
     <?php  }?>
   </select> 
 </div>
</li>


                      <!----------Agreement Form------------->

<li>
   <div class="form-group">
  <label>Agreement Date<span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Select Agreement Date" name="agreementDate" id="agreementDate" value="" required>
    <span class="text-danger"></span>
 </div>
</li>
                                   

                      <!----------Agreement To------------->

<li>
 <div class="form-group">
  <label>Agreement Starting Date <span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Agreement From" name="agreementFrom" value="" required>
    <span class="text-danger"></span>
 </div>
</li>


<!----------Agreement To------------->

<li>
 <div class="form-group">
  <label>Agreement End Date <span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Agreement To" name="agreementTo" value="" required>
    <span class="text-danger"></span>
 </div>
</li>

                      
 <!----------Possession Date------------->


<li>
 <div class="form-group">
  <label>Possession Date</label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Possession Date" 
   name="possessionDate" value="" >
    <span class="text-danger"></span>
 </div>
</li>

                      
                      <!----------Locking Period------------->

<li>
 <div class="form-group">
  <label>Locking Period (In Months)</label>
   <input type="text" class="form-control form-control-sm" placeholder="Locking Period" 
   name="lockingPeriod" value="" onkeypress="return /[0-9]/i.test(event.key)">
    <span class="text-danger"></span>
 </div>
</li>

         

            <!----------Token Amount------------->


<!--<li>
 <div class="form-group">
  <label>Token Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Token Amount" name="tokenAmount" onkeypress="return /[0-9]/i.test(event.key)" >
    <span class="text-danger"></span>
 </div>
</li>
-->
            <!----------Deposit Amount------------->


<li>
 <div class="form-group">
  <label>Deposit Amount<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Deposit Amount" name="depositAmount" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------Deposit Date------------->


<li>
 <div class="form-group">
  <label>Deposit Date<span>*</span></label>
   <input type="text" class="form-control form-control-sm dates" placeholder="Deposit Date" 
   name="depositDate" value="" required>
    <span class="text-danger"></span>
 </div>
</li>

                   <!----------Rent Per Month------------->

<li>
 <div class="form-group">
  <label>Rent  <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Base Rent" 
   name="baseRent" id="baseRent" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li>

                <!----------Maintaince Charges------------->

<li>
 <div class="form-group">
  <label>Maintenance  <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="maintenance charges" name="maintainceCharges" required>
    <span class="text-danger"></span>
 </div>
</li>

                    <!----------GST No------------->

<li>
 <div class="form-group">
  <label>GST Amount (Is Applicable) <input type="checkbox" name="gstStatus" 
    id="gstStatus"/>
  </label>
   <input type="text" class="form-control form-control-sm" placeholder="GST Amount" 
   id="gstAmt" name="gstAmt" value="" readonly>
    <span class="text-danger"></span>
 </div>
</li>                   


                        <!----------Manager Name------------->
<li>
 <div class="form-group">
  <label>Commission Agent Name<span>*</span></label>
  <select class="form-control form-control-sm" id = "managerName" name="managerName" required>
    <option value="0"> Select Commission Agent </option>
     <?php 
      $result = $dbConn->query("SELECT manager_id, concat(manager_name,' - ',pan_no) as manager_name FROM det_manager 
        where status='Active'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $managerName=$row['manager_name'];
         $id=$row['manager_id'];
     ?>
    <option value="<?php echo $id;?>">
     <?php echo $managerName;?>
    </option>
     <?php  }?>
   </select> 
 </div>
</li>

                   <!----------Brokerage------------->

<li>
 <div class="form-group">
  <label>Commision <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Commision" name="Brokerage" onkeypress="return /[0-9]/i.test(event.key)" required>
    <span class="text-danger"></span>
 </div>
</li>

                   <!----------Loading/Unloading charges------------->

<li>
 <div class="form-group">
  <label>Loading/Unloading Charges </label>
   <input type="text" class="form-control form-control-sm" placeholder="Loading/Unloading charges" name="loadingCharges" onkeypress="return /[0-9]/i.test(event.key)" >
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------AMC-Tenant------------->

                      <li>
   <div class="form-group">
  <label>AMC-Tenant<span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="AMC-Tenant" name="AmcTenant" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

                        <!----------Remark------------->

<li>
 <div class="form-group">
  <label>Remark</label>
   <input type="text" class="form-control form-control-sm" placeholder="Remark" name="remark" value="">
    <span class="text-danger"></span>
 </div>
</li>

                      <!----------Agreement Cycle------------->


<!--<li>
 <div class="form-group">
  <label>Agreement Cycle <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="cycle" name="cycle" required>
     <option value="0"> Select Cycle </option>
     <option value="M">Monthly</option>
      <option value="Q">Quartly</option>
      <option value="H">Half Yearly</option>
      <option value="Y">Yearly</option>
    </select>  
  </div>

 </div> 
</li> -->

                <!----------Charges Paid By Tenant------------->
<!-- <li>

 <div class="form-group">
      <label>Charges Paid By Tenant</label>
      <select id="charges" name="charges" class="form-control form-control-sm" multiple="multiple">
        <option value="Electricity">Electricity Bill</option>
        <option value="Water">Water Bill</option>
        <option value="Property">Property Tax</option>
        <option value="Other">Other Charges</option>
      </select>
</div>
                   
</li>    -->

     

          <!----------Other Charges------------->

<!--<li>
 <div class="from-group">
 <label>Other Charges</span></label><br>
  <div class="appending_div row">
   <div class="col-md-6">
     <input type="text" name="otherChargesDesc" class="form-control form-control-sm" 
     placeholder="Charges Description">     
  </div>
   <div class="col-md-6">
    <input type="text" name="otherChargesAmt" class="form-control form-control-sm" placeholder="Charges Amount" onkeypress="return /[0-9]/i.test(event.key)">    
   </div>
 </div>
</div>
</li>-->



      

</ul>


                      <!----------Button------------->

<div class="card-footer" style="text-align: center;">
 <button type="submit" name="add_lead" class="btn btn-primary">Save</button>
 <button type="button" name="add_lead" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
</div>

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

      $('[id="docupload"]').click(function() { //ID begins with "del"
          //code here
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


      $('[id="rentdetails"]').click(function() { //ID begins with "del"
          //code here
          let propName = propertyName.value;
          let parName = tenantName.value;

          if(propName !=null && propName != 0 && parName !=null && parName != 0)
          {
            var url = 'rent.php?propertyName='+encodeURIComponent(propName)+"&tenantName="+encodeURIComponent(parName);
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

/*$('input:file[multiple]').change(
        function(e){
            console.log(e.currentTarget.files);
            var numFiles = e.currentTarget.files.length;
                for (i=0;i<numFiles;i++){
                    fileSize = parseInt(e.currentTarget.files[i].size, 10)/1024;
                    filesize = Math.round(fileSize);
                    $('<li />').text(e.currentTarget.files[i].name).appendTo($('#output'));
                    $('<span />').attr('anchor').appendTo($('#output'));
                    $('<span />').addClass('filesize').text('(' + filesize + 'kb)').appendTo($('#output li:last'));
                }
        });*/


$("#propertyName").on('change', function(){
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

  // do whatever here
});


</script>