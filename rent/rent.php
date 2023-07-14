<?php
 session_start();
 include_once ('../conn.php');
 ?>

 <?php include '../menu.php';?>
 <style type="text/css">
   
   ol li{ padding:0 0 10px 0;}
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
    </style>

<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Add Rent</h3>
	   <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Add Rent</li>
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

                  <!----------Rent Details------------->

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<div class="card-primary2">
<div class="card-header2"> 
  <h3 class="card-title">Rent Details</h3>
</div>
<ul class="add-lead-ul add-lead-ul-rent" id="myField">


                          <!----------Tenant Name------------->

<li>
 <div class="form-group">
  <label>Agreement <span>*</span></label>
  <select class="form-control form-control-sm" id = "agreement" name="agreement" required>
    <option value="0"> Select Agreement </option>
     <?php 
      $result = $dbConn->query("SELECT a.agreement_id, (select concat(t.tenant_name, ' - ', t.pan_no) FROM det_tenant t where t.tenant_id = a.tenant_id) as tenant_name, (select concat(p.property_name,' - ',p.flat_no,', ',p.city_id,' - ',p.pincode) as property_name from det_property p where p.property_id = a.property_id) as property_name 
        FROM `det_agreement` a where a.status = 'Active'");

      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $agreement_id=$row['agreement_id'];
         $tenant_name=$row['tenant_name'];
         $property_name=$row['property_name'];
     ?>
    <option value="<?php echo $agreement_id;?>">
        <i class="fa fa-file"></i>
     <?php echo $tenant_name.'===>>'.$property_name;?>  
    </option>
     <?php  }?>
   </select> 
 </div>
</li>


<li>
   <div class="form-group">
  <label>Rent Date <span>*</span></label>
   <input type="date" class="form-control form-control-sm" placeholder="Rent Date" 
   name="rentDate" value="" required>
    <span class="text-danger"></span>
 </div>
</li>
                                   
                   <!----------Rent Per Month------------->

<li>
 <div class="form-group">
  <label>Rent<span>*</span></label>
   <input type="text" class="form-control form-control-sm txtField" placeholder="Base Rent" 
   name="baseRent" id="baseRent" onkeypress="return /[0-9]/i.test(event.key)"  
    required>
    <span class="text-danger"></span>
 </div>
</li>

<!----------Other Charges------------->

<li id="dynamicLi">
 <div class="from-group">
    <label>Other Charges</label><br>
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
</li>

<!----------GST No------------->

<li>
<br>

 <div class="form-group">
  <label>GST Amount (Is Applicable) <input type="checkbox" name="gstStatus" 
    id="gstStatus"/>
  </label>
   <input type="text" class="form-control form-control-sm txtField" placeholder="GST Amount" 
   id="gstAmt" name="gstAmt" value="" readonly>
    <span class="text-danger"></span>
 </div>
</li> 


<li>
  <br>
 <div class="form-group">
  <label>Total Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Amount to be paid" name="totalAmount" id="totalAmount" value="">
    <span class="text-danger"></span>
 </div>
</li>
<li>

</ul>

                      <!----------Button------------->

<div class="card-footer" style="text-align: center;">
 <button type="submit" name="add_lead" class="btn btn-primary">Save & Generate Invoice</button>
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
      // let otheCharges = $('#otherChargesAmt').val();

      let allOtherCharges = [];
      let otheCharges = 0;

      $('.otherChargesAmt').each(function() { allOtherCharges.push(parseInt($(this).val())); });


      allOtherCharges.forEach( num => {
        num = ~~num

        otheCharges += num;
      })


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
    var i = 0;

    $("#form1 #add").click(function(){
        ++i;

        $("#dynamicLi").append('<div class="from-group dynamicAdd"><br><div class="appending_div row"><div class="col-5"><input type="text" name="otherCharges['+i+'][otherChargesDesc]" class="form-control form-control-sm" placeholder="Charges Description"></div><div class="col-5"><input type="text" name="otherCharges['+i+'][otherChargesAmt]" id="otherChargesAmt" class="form-control form-control-sm txtField otherChargesAmt" placeholder="Other Charge Amount" onkeypress="return /[0-9]/i.test(event.key)"></div><div class="col-2 "><button type="button" class="btn btn-danger remove-div"><i class="fa fa-minus"></i></button></div></div></div>');

    });
   
    $('#form1').on('click', '.remove-div', function(){  
		  $(this).parents(':eq(2)').remove();
    });

}); 

</script>
                      <!----------Footer------------->

<?php include '../footer.php';?> 