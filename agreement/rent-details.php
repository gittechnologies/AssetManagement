
<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');

 $id=$_GET['id'];


$result = $dbConn->query("SELECT a.agreement_id, a.property_id, a.tenant_id,
(select concat(p.property_name,' - ',p.flat_no,', ', nvl(p.location,''), ',', nvl((select c.name from cities c where c.id = p.city_id),''), ' - ',p.pincode) from det_property p where p.property_id = a.property_id) as property_name,
(select t.tenant_name from det_tenant t where t.tenant_id = a.tenant_id) as tenant_name
FROM det_agreement a where agreement_id ='$id' ");

$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
	$v_agreement_id=$row['agreement_id'];
    $v_property_id=$row['property_id'];
    $v_tenant_id=$row['tenant_id'];
    $v_property_name=$row['property_name'];
    $v_tenant_name=$row['tenant_name'];
}

 ?>



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

<?php include '../menu.php';?>

<div class="content-wrapper">
 <section class="content">
	<div class="container-fluid">
	 <div class="row">
		<div class="col-md-12">
		 <div class="card card-primary mt-2">
			<div class="card-header">
			 <h3 class="card-title">Rent Payment</h3>
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Rent Payment</li>
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

<form action="rent-upload.php" method="post" enctype="multipart/form-data">   
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<input type="hidden" id="agreement_id" name="agreement_id" value="<?php echo $v_agreement_id;?>"> 
<div class="card-primary2">

<ul class="add-lead-ul">

<li>
 <div class="form-group">
	<label >Property Name</label>
	 <select class="form-control form-control-sm" id = "propertyName" name="propertyName" 
	 disabled>
		<option value="<?php echo $v_property_id; ?>"><?php echo $v_property_name;?></option>

	 </select>  
 </div>
</li>

<li>
 <div class="form-group">
	<label for="exampleInputEmail1">Tenant Name</label>
	<select class="form-control form-control-sm" id = "tenantName" name="tenantName" 
	disabled>
		<option value="<?php echo $v_tenant_id; ?>"><?php echo $v_tenant_name;?></option>
	 </select> 
 </div>
</li>
<li>
 <div class="form-group">
  <label>Total Amount</label>
   <label style="font-size: 30; color: red; font-weight: bold;">RENT</label>
 </div>
</li>
<li>
 <div class="form-group">
	<label>Type</label>
	<select class="form-control form-control-sm" id="type" name="type">
		<option value="0">Select Payment Type</option>
		<option value="1"> Rent </option>
		<option value="2"> Other Charges </option>
	 </select> 
 </div>
</li>

<li>
<div class="form-group">
  <label>Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Amount" name="amount" id="amount" value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Overdue Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Overdue Amount" name="overdueAmount" id="overdueAmount" value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Amount to be paid</label>
   <input type="text" class="form-control form-control-sm" placeholder="Amount to be paid" name="amountToBePaid" id="amountToBePaid" value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Amount Paid</label><span>* </span> <span class="amountPaidError"></span>
   <input type="text" class="form-control form-control-sm" placeholder="Amount paid" name="amountPaid" id="amountPaid" value="" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Next Due Amount</label>
   <input type="text" class="form-control form-control-sm" placeholder="Next Due" name="nextDue" id="nextDue" value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Next Due Date</label>
   <input type="date" class="form-control form-control-sm" placeholder="Next Due Date" name="nextDueDate" id="nextDueDate"  value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
	<label>Mode of Payment</label><span>* </span> <span class="modeError"></span>
	<select class="form-control form-control-sm" id = "mode" name="mode">
		<option value="0">Select Mode of Payment</option>
		<option value="1"> RTGS/NEFT/IMPS </option>
		<option value="2"> DD </option>
		<option value="3"> CASH </option>
		<option value="4"> CHEQUE </option>
	 </select> 
 </div>
</li>

<!--<li>
 <div class="form-group">
  <label>Amount in Rs.</label>
   <input type="text" class="form-control form-control-sm" placeholder="Enter Amount" name="amount" id="amount" value="">
    <span class="text-danger"></span>
 </div>
</li>-->

<li>
 <div class="form-group">
	<label for="exampleInputEmail1">Payment Staus</label>
	<select class="form-control form-control-sm" id="payStatus" name="payStatus">
		<option value="0">Select Payment Status</option>
		<option value="1"> Paid </option>
		<option value="2"> Overdue </option>
	 </select> 
 </div>
</li>

<li>
 <div class="from-group">
 <label>Upload Receipt:</label><br>
	<div class="appending_div row">
	 <div class="col-md-6">
		 <input type="text" id="fileName" name="fileName" class="form-control form-control-sm" placeholder="Enter File Name">     
	</div>
	 <div class="col-md-6">
		<input type="file" id="fileToUpload" name="fileToUpload" class="form-control form-control-sm">    
	 </div>
 </div>
</div>
</li>
</form>

 <div class="card-footer" align="center">
	<button type="button" id= "rentupload" name="rentupload" class="btn btn-primary">Save & Add</button>
	<button type="button" id= "cancel" name="cancel" onclick="window.location='manage.php'" class="btn btn-primary">Cancel</button>
 </div>

 <div class="content-wrapper" style="margin: 0px!important;">
 <section class="content">
 <div class="container-fluid">
	<div class="row">
	 <div class="col-md-12">
		<div class="card">
		 <div class="flash-message">
<div class="card-body">
 <div class="table-responsive">
<table class="table table-bordered">
 <thead class="ntable-header">
	<tr>
		<th>Total Rent</th>
		<th>Paid Rent</th>
		<th>Mode</th>
		<th>Type</th>
		<th>Outstanding Rent</th>
		<th>Receipt</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	</thead>
<tbody>
 <?php 
 $v_status='Active';  
	$result = $dbConn->query("SELECT rent_id, total_rent, amount_paid, payment_mode, type, file_path, uploaded_on FROM det_rent_details 
		WHERE agreement_id = '$v_agreement_id' and status='1'");
	$result->execute();
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
		echo "<tr>";
		echo "<td>".$row['rent_id']."</td>"; 
		echo "<td>".$row['total_rent']."</td>"; 
		echo "<td>".$row['amount_paid']."</td>"; 
		echo "<td>".$row['payment_mode']."</td>";
		echo "<td>".$row['type']."</td>";

		echo "<td>";
		if (!empty($row['file_path'])) {
		?>

	 	<a href="download.php?path=<?php echo $row['file_path']; ?>" >
			download
	 </a> 
	<?php } else {
		echo "Not Available";
	} 
	 echo"</td>";

		echo "<td>".$row['uploaded_on']."</td>";
		echo "<td>"; ?>
		<button type="button"  
		onclick="docDelete(<?php echo $row['rent_id']; ?>)" class="btn btn-danger">Delete</button>
<?php echo"</td>";

}
?>
</tbody>
</table> 
 </div>
</form>
</section>

		</div>
	 </div>
	</div>

 </section>
</div>

                      <!----------Footer------------->


<?php include '../footer.php';?> 

<script type="text/javascript">
	
$(document).ready(function(){
$('#fileToUpload').change(function(e){
var fileName = e.target.files[0].name;
if(fileName!=null || fileName!=''){
	$('#fileName').val(fileName.split('.').shift());
     }
   });
});
	 
</script>

<script type="text/javascript">

function docDelete(id) {

		var form_data = new FormData();                  
		form_data.append('id', id);
												 
		$.ajax({
				url: 'delete-rent.php', // <-- point to server-side PHP script 
				dataType: 'text',  // <-- what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(php_script_response){
						alert(php_script_response); // <-- display response from the PHP script, if any
						setTimeout(function(){// wait for 5 secs(2)
						location.reload(); // then reload the page.(3)
						}, 3000); 
				}
		 });
		
	}

	$(document).ready(function() {
	 var i = ''
	$('.add').on('click', function() {
		var field = '<br><div class="col-md-6"> '+i+' <input type="text" name="fileName" id="fileName" class="form-control form-control-sm" placeholder="Enter File Name" disable></div> <div class="col-md-6"> '+i+' <input type="file" id="fileToUpload" name="fileToUpload" class="form-control form-control-sm" disable></div>';
		$('.appending_div').append(field);
		i = i;
	})

	
	$('#rentupload').on('click', function() {

			var amountPaidError = 1;
			var modeError = 1;

			var file_data = $('#fileToUpload').prop('files')[0];  
			var agreement_id = document.getElementById("agreement_id").value;	

			var type= document.getElementById("type");
			var type_id = type.options[type.selectedIndex].value;
			var amount = document.getElementById("amount").value;			
			var overdueAmount = document.getElementById("overdueAmount").value;
			var amountToBePaid = document.getElementById("amountToBePaid").value;
			var amountPaid = document.getElementById("amountPaid").value;
			var nextDue = document.getElementById("nextDue").value;
			var nextDueDate = document.getElementById("nextDueDate").value;			

			var mode= document.getElementById("mode");
			var payment_mode = mode.options[mode.selectedIndex].value;

			var payStatus = document.getElementById("payStatus");
			var pay_Status = payStatus.options[payStatus.selectedIndex].value;

			var fileName = document.getElementById("fileName").value;

			if (!$('#amountPaid').val()) {
				$(".amountPaidError").text("Please Enter Amount");
				amountPaidError = 0;
        	} else {
				$(".amountPaidError").text("");
				amountPaidError = 1;
			}
			
			if (!$('#mode').val()) {
				$(".modeError").text("Please Select Mode");
				modeError = 0;
			} else {
				$(".modeError").text("");
				modeError = 1;
			}
			
			if (amountPaidError === 1 && modeError === 1) {
			

				var form_data = new FormData();                  
				form_data.append('file', file_data);
				form_data.append('agreement_id', agreement_id);
				form_data.append('amount', amount);
				form_data.append('overdueAmount', overdueAmount);
				form_data.append('amountToBePaid', amountToBePaid);
				form_data.append('amountPaid', amountPaid);
				form_data.append('nextDue', nextDue);
				form_data.append('nextDueDate', nextDueDate);
				form_data.append('payment_mode', payment_mode);
				form_data.append('type_id', type_id);
				form_data.append('pay_Status', pay_Status);
				form_data.append('fileName', fileName);
														
				$.ajax({
						url: 'rent-upload.php', // <-- point to server-side PHP script 
						dataType: 'text',  // <-- what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(php_script_response){
								alert(php_script_response); // <-- display response from the PHP script, if any
								setTimeout(function(){// wait for 5 secs(2)
								location.reload(); // then reload the page.(3)
								}, 3000); 
						}
				});
			}
	});

});


</script>


