
<?php
 session_start();
 if(!isset($_SESSION['Email']))
        {
                header("location: login.php");
        }
        $name=$_SESSION['Email'];
 include_once ('../conn.php');

 $id=$_GET['id'];

 //echo "<script>alert(' $id')</script>";
$result = $dbConn->query("SELECT distinct r.rent_id, r.agreement_id, r.invoice_no, date(r.creation_date) as invoice_date, 
	r.rent_amount, r.other_charges_desc, r.other_charges_amount, r.total_amount, sum(r.total_amount) as grand_total_amount, 
(select t.tenant_name from det_tenant t where t.tenant_id = (select a.tenant_id from det_agreement a where a.agreement_id = 
	r.agreement_id)) as tenant_name,
(select p.property_name from det_property p where p.property_id = (select a.property_id from det_agreement a where a.agreement_id = 
	r.agreement_id)) as property_name,
(select rd.amount_paid from det_rent_details rd where rd.rent_id = r.rent_id group by rd.rent_id) as amount_paid,
(select sum(rd.amount_paid) from det_rent_details rd where rd.rent_id = r.rent_id group by rd.rent_id) as total_amount_paid
from det_rent r where r.rent_id='$id'");

$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $v_rent_id=$row['rent_id'];
    $v_agreement_id=$row['agreement_id'];	
    $v_invoice_no=$row['invoice_no'];
    $v_invoice_date=$row['invoice_date'];
    //echo "<script>alert(' $v_invoice_date')</script>";
    $v_total_amount = $row['total_amount'];  
    $v_grand_total_amount = $row['grand_total_amount'];    
    $v_property_name=$row['property_name'];
    $v_tenant_name=$row['tenant_name'];
    $v_amount_paid=$row['amount_paid'];
    $v_total_amount_paid=$row['total_amount_paid'];
    
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
<input type="hidden" id="rent_id" name="rent_id" value="<?php echo $v_rent_id;?>"> 
<div class="card-primary2">

<ul class="add-lead-ul">

<li>
 <div class="form-group">
	<label for="exampleInputEmail1">Invoice Date</label>
	<input type="date" class="form-control form-control-sm" placeholder="Invoice Date" name="invoiceDate" id="invoiceDate"  value="<?php echo $v_invoice_date;?>">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
	<label >Invoice No.</label>
	 <input type="text" class="form-control form-control-sm" placeholder="Invoice No." name="invoiceNo" id="invoiceNo" 
	 value="<?php echo $v_invoice_no;?>">
    <span class="text-danger"></span>  
 </div>
</li>

<li>
 <div class="form-group">
  <label>Invoice Amount (Rs.)</label>
   <input type="text" class="form-control form-control-sm" placeholder="Invoice Amount" name="invoiceAmount" id="invoiceAmount" 
   value="<?php echo $v_total_amount;?>">
    <span class="text-danger"></span>
</li>

<li>
 <div class="form-group">
  <label>Amount Paid</label><span>* </span> <span class="amountPaidError"></span>
   <input type="text" class="form-control form-control-sm" placeholder="Amount paid" name="amountPaid" id="amountPaid" value="">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Payment Date</label>
   <input type="date" class="form-control form-control-sm" placeholder="Payment Date" name="paymentDate" id="paymentDate"  value="">
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

<li>
 <div class="form-group">
  <label>Tenant Name: <?php echo $v_tenant_name;?></label><br/>
   <label>Tenant of <?php echo $v_property_name;?></label>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Total Due Amount</label><br/>
   <label  style="font-size: 30; color: red; font-weight: bold;">
   	<?php echo $v_grand_total_amount-$v_total_amount_paid;?></label>
   	<input type="hidden" id="totalDue" name="totalDue" value="<?php echo $v_grand_total_amount-$v_total_amount_paid;?>">
 </div>
</li>

</form>

 <div class="card-footer" align="center">
	<button type="button" id= "rentupload" name="rentupload" 
	class="btn btn-primary">Save & Add</button>
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
<table class="table table-bordered table-hover small">
 <thead class="ntable-header">
	<tr>
		<th>Invoice No.</th>
		<th>Invioce Date</th>
		<th>Invoice Amount</th>
		<th>Amount Paid</th>
		<th>Outstanding</th>
		<th>Mode</th>
		<th>Receipt</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	</thead>
<tbody>
 <?php 
 $v_status='Active';  
	$result = $dbConn->query("SELECT rd.rent_details_id  , rd.rent_id, rd.amount_paid, rd.payment_mode, rd.payment_date, rd.file_path, rd.uploaded_on,
		(select r.invoice_no from det_rent r where r.rent_id = rd.rent_id) as invoice_no,
		date((select r.creation_date from det_rent r where r.rent_id = rd.rent_id)) as invoice_date,
		(select r.total_amount from det_rent r where r.rent_id = rd.rent_id) as invoice_amount
		FROM det_rent_details rd WHERE rd.rent_id = '$v_rent_id' and status='1'
		order by uploaded_on");
	$result->execute();
	$outstanding = 0;
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {

		
$outstanding =$outstanding+$row['amount_paid'];
		echo "<tr>";
		echo "<td>".$row['invoice_no']."</td>"; 
		echo "<td>".$row['invoice_date']."</td>"; 
		echo "<td>".$row['invoice_amount']."</td>"; 
		echo "<td>".$row['amount_paid']."</td>"; 
		echo "<td>".$row['invoice_amount'] - $outstanding."</td>"; 
		echo "<td>".$row['payment_mode']."</td>";

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
		
		<button type="button" onclick="" class="l-1 btn-ext-small btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		<button type="button" onclick="docDelete(<?php echo $row['rent_details_id']; ?>)" class="ml-1 btn-ext-small btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
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
	//  var i = ''
	// $('.add').on('click', function() {
	// 	var field = '<br><div class="col-md-6"> '+i+' <input type="text" name="fileName" id="fileName" class="form-control form-control-sm" placeholder="Enter File Name" disable></div> <div class="col-md-6"> '+i+' <input type="file" id="fileToUpload" name="fileToUpload" class="form-control form-control-sm" disable></div>';
	// 	$('.appending_div').append(field);
	// 	i = i;
	// })

	
	$('#rentupload').on('click', function() {

			var amountPaidError = 1;
			var modeError = 1;
			var file_data = $('#fileToUpload').prop('files')[0];  
			var agreement_id = document.getElementById("agreement_id").value;	
			var rent_id = document.getElementById("rent_id").value;
			var amountPaid = document.getElementById("amountPaid").value;
			var paymentDate = document.getElementById("paymentDate").value;
			var invoiceAmount= document.getElementById("invoiceAmount").value;
			var totalDue= document.getElementById("totalDue").value;
			var mode= document.getElementById("mode");
			var payment_mode = mode.options[mode.selectedIndex].value;

			var fileName = document.getElementById("fileName").value;

			if (!$('#amountPaid').val()) {
				$(".amountPaidError").text("Please Enter Amount");
				amountPaidError = 0;
        	} else {
				$(".amountPaidError").text("");
				amountPaidError = 1;
			}
			
			if (!$('#mode').val() || $('#mode').val()==0) {
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
				form_data.append('rent_id', rent_id);
				form_data.append('amountPaid', amountPaid);
				form_data.append('paymentDate', paymentDate);
				form_data.append('invoiceAmount', invoiceAmount);
				form_data.append('totalDue', totalDue);
				form_data.append('payment_mode', payment_mode);
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


<?php include '../footer.php';?> 