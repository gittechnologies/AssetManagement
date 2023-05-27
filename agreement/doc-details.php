
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
    $v_party_id=$row['tenant_id'];
    $v_property_name=$row['property_name'];
    $v_party_name=$row['tenant_name'];
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
			 <h3 class="card-title">Agreement Upload</h3>
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Agreement Upload</li>
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

	 <form action="doc-upload.php" method="post" enctype="multipart/form-data">   

		       <!----------Agreement Details------------->

<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<input type="hidden" id="agreement_id" name="agreement_id" value="<?php echo $v_agreement_id;?>"> 
<input type="hidden" id="doc_id" name="doc_id" value=""> 
<input type="hidden" id="form_type" name="form_type" value="add"> 
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
	<label for="exampleInputEmail1">Party Name</label>
	<select class="form-control form-control-sm" id = "partyName" name="partyName" 
	disabled>
		<option value="<?php echo $v_party_id; ?>"><?php echo $v_party_name;?></option>
	 </select> 
 </div>
</li>


<li>
 <div class="form-group">
  <label>Stamp Duty Charges</label>
   <input type="text" class="form-control form-control-sm" id ="stampdutyCharges" placeholder="Stamp Duty Charges" name="stampdutyCharges" onkeypress="return /[0-9]/i.test(event.key)" >
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Registration Fee</label>
   <input type="text" class="form-control form-control-sm" placeholder="Registration Fee"  id="registrationFee" name="registrationFee" onkeypress="return /[0-9]/i.test(event.key)" >
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Legal Fee </label>
   <input type="text" class="form-control form-control-sm" placeholder="Legal Fee" id="legalFee" name="legalFee" onkeypress="return /[0-9]/i.test(event.key)" >
    <span class="text-danger"></span>
 </div>
</li>

<br>

<li>
 <div class="from-group">
 <label>Agreement Upload:<span>*</span></label>
 <span class=" fileError" style="display:none;"></span>
 <br>
	<div class="appending_div row">
	 <div class="col-md-6">
		 <input type="text" id="fileDesc" name="fileName" class="form-control form-control-sm" placeholder="Enter File Name" required>     
	</div>
	 <div class="col-md-6">
		<input type="file" id= "fileToUpload" name="files" class="form-control form-control-sm" required>   
		
	 </div>
 </div>
</div>
</li>

</form>

 <div class="card-footer" align="center">
	<button type="button"  name="docupload" onclick="uploadDoc()" class="btn btn-primary">Save</button>
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
		<th>Id</th>
		<th>File Description</th>
		<th>File Name</th>
		<th>File Path</th>
		<th>Uploaded On</th>
		<th>Stamp Duty Charges</th>
		<th>Registration Fee</th>
		<th>Legal Fee</th>
		<th>Action</th>
	</tr>
	</thead>
<tbody>
 <?php 
 $v_status='Active';  
 $count = 0;
	$result = $dbConn->query("SELECT doc_id, file_desc, file_name, file_path, uploaded_on ,stamp_duty_charges,registration_charges,legal_charges FROM det_file_upload 
		WHERE agreement_id = '$v_agreement_id' and doc_type='A' and status='1'");
	$result->execute();
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
		$count++;
		echo "<tr>";
		echo "<td>".$count."</td>"; 
		echo "<td>".$row['file_desc']."</td>"; 
		echo "<td>".$row['file_name']."</td>";
		echo "<td>"; ?>
	 <a href="download.php?path=<?php echo $row['file_path']; ?>" >
			download
	 </a> 
	<?php echo"</td>";
		echo "<td>".$row['uploaded_on']."</td>";
		echo "<td>".$row['stamp_duty_charges']."</td>"; 
		echo "<td>".$row['registration_charges']."</td>"; 
		echo "<td>".$row['legal_charges']."</td>"; 
		echo "<td>"; ?>
		<button type="button" onclick="docUpdate(<?php echo $row['doc_id']; ?>)" class="l-1 btn-ext-small btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		<button type="button" onclick="docDelete(<?php echo $row['doc_id']; ?>)" class="ml-1 btn-ext-small btn btn-sm btn-danger"><i class="fas fa-times"></i></button>

<?php echo"</td>";

// <--------Delete-------->

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

function uploadDoc() {
	var file_data = $('#fileToUpload').prop('files')[0];  
	var agreement_id = document.getElementById("agreement_id").value;
	var fileDesc = document.getElementById("fileDesc").value;
	var stampdutyCharges = document.getElementById("stampdutyCharges").value;
	var registrationFee = document.getElementById("registrationFee").value;
	var legalFee = document.getElementById("legalFee").value;
	var doc_id = document.getElementById("doc_id").value;
	var form_type = document.getElementById("form_type").value;
	var checkFile = 1;

	var form_data = new FormData();                  
	form_data.append('file', file_data);
	form_data.append('agreement_id', agreement_id);
	form_data.append('stampdutyCharges', stampdutyCharges);
	form_data.append('registrationFee', registrationFee);
	form_data.append('legalFee', legalFee);
	form_data.append('fileDesc', fileDesc);
	form_data.append('doc_id', doc_id);
	form_data.append('form_type', form_type);

	if( document.getElementById("fileToUpload").files.length == 0 && form_type =='add'){
		console.log("no files selected");
		$(".fileError").text("Please Upload file");
		$(".fileError").css({'display' : 'inline-block'});		
		checkFile = 0;
	}

	if (form_type == 'update') {
		checkFile = 1;
	}
		
	if (checkFile === 1) {
		$.ajax({
			url: 'doc-upload.php', // <-- point to server-side PHP script 
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
}

function docDelete(id) {

	var form_data = new FormData();                  
	form_data.append('id', id);
												
	$.ajax({
			url: 'delete-doc.php', // <-- point to server-side PHP script 
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

function docUpdate(id) {
	let doc_id = id										

	$.ajax({
		type:'POST',
		url:'../ajaxData.php',
		dataType: "json",
		data:'doc_id='+doc_id,
		success:function(response){
		if (response.success) {
			data = response.data;

			$("#agreement_id").val(data.agreement_id);
			$("#stampdutyCharges").val(data.stamp_duty_charges); 
			$("#fileDesc").val(data.file_desc);
			$("#registrationFee").val(data.registration_charges);
			$("#legalFee").val(data.legal_charges);
			$("#doc_id").val(data.doc_id);
			$("#form_type").val('update');

		}	else {
			alert("Something went wrong, please try again.")
		}
		}
	});
}

	$(document).ready(function() {

	$('#docupload').on('click', function() {
			var file_data = $('#fileToUpload').prop('files')[0];  
			var agreement_id = document.getElementById("agreement_id").value;
			var fileDesc = document.getElementById("fileDesc").value;
			var stampdutyCharges = document.getElementById("stampdutyCharges").value;
			var registrationFee = document.getElementById("registrationFee").value;
			var legalFee = document.getElementById("legalFee").value;
			var doc_id = document.getElementById("doc_id").value;
			var form_type = document.getElementById("form_type").value;
			
			var form_data = new FormData();                  
			form_data.append('file', file_data);
			form_data.append('agreement_id', agreement_id);
			form_data.append('stampdutyCharges', stampdutyCharges);
			form_data.append('registrationFee', registrationFee);
			form_data.append('legalFee', legalFee);
			form_data.append('fileDesc', fileDesc);
			form_data.append('doc_id', doc_id);
			form_data.append('form_type', form_type);
									 
			$.ajax({
					url: 'doc-upload.php', // <-- point to server-side PHP script 
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
	});


})
</script>
<script type="text/javascript">
	
	$(document).ready(function(){
	$('#fileToUpload').change(function(e){
	var fileName = e.target.files[0].name;
	if(fileName!=null || fileName!=''){
		$('#fileDesc').val(fileName.split('.').shift());
		}
	});
});
</script>