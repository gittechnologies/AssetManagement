
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
			 <h3 class="card-title">Add Director Details</h3>
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Add Director Details</li>
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

<form action="add-director-details.php" method="post" enctype="multipart/form-data">   
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<input type="hidden" id="tenant_id" name="tenant_id" value="<?php echo $id;?>"> 
<div class="card-primary2">

<ul class="add-lead-ul">

<li>
 <div class="form-group">
  <label>Director Name <span>* </span><span class="nameError" ></span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Build-Up Area" name="directorName" id="directorName" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
  <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>Address</label>
   <input type="text" class="form-control form-control-sm" id="address" placeholder="Address" name="address" >
    <span class="text-danger"></span>
 </div>
</li>


<li>
 <div class="form-group">
  <label>Pan No.<span>* </span><span class="panError" ></span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Pan No" id="panNo" name="panNo" onkeyup="this.value= this.value.replace(/[^'a-zA-Z0-9]+$/, '')" required>
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
  <label>CIN/LLP</label>
   <input type="text" class="form-control form-control-sm" placeholder="CIN/LLP" name="cin-llp" id="cinLlp">
    <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="from-group">
 <label>Resolution Of Letter Head:</label><br>
	<div class="appending_div row">
	 <div class="col-md-6">
		 <input type="text" id="fileDesc" name="fileName" class="form-control form-control-sm" placeholder="Enter File Name" required>     
	</div>
	 <div class="col-md-6">
		<input type="file" id="fileToUpload" name="files" class="form-control form-control-sm">    
	 </div>
 </div>
</div>
</li>
</form>

 <div class="card-footer" align="center">
	<button type="button"  name="addDirectors" 
	class="btn btn-primary" id="addDirectors" >Save & Add</button>
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
		<th>Director Name</th>
		<th>Address</th>
		<th>Pan No.</th>
		<th>CIN/LLP</th>
		<th>File Description</th>
		<th>File Name</th>
		<th>File Path</th>
		<th>Uploaded On</th>
		<th>Action</th>
	</tr>
	</thead>
<tbody>
 <?php 
 $result = $dbConn->query("SELECT d.id,d.name , d.address,d.pan_no , d.cin_llp , d.file_desc , d.file_name , d.uploaded_on , d.file_path from det_director d join det_tenant t on d.tenant_id = t.tenant_id  where d.tenant_id ='$id' and t.status ='Active' and d.status=1");
 $result->execute();

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {

		
		echo "<tr>";
		echo "<td>".$row['name']."</td>"; 
		echo "<td>".$row['address']."</td>"; 
		echo "<td>".$row['pan_no']."</td>"; 
		echo "<td>".$row['cin_llp']."</td>"; 
		echo "<td>".$row['file_desc']."</td>"; 
		echo "<td>".$row['file_name']."</td>";
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
		<!-- <button type="button" onclick="docDelete(<?php echo $row['id']; ?>)" class="btn btn-danger">Delete</button> -->
		<button type="button" onclick="" class="l-1 btn-ext-small btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
		<button type="button" onclick="docDelete(<?php echo $row['id']; ?>)" class="ml-1 btn-ext-small btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
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
			url: 'delete-director-details.php', // <-- point to server-side PHP script 
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

	
	$('#addDirectors').on('click', function() {
			nameError = 1;
			panError = 1;

			var file_data = $('#fileToUpload').prop('files')[0];  
			var fileDesc = document.getElementById("fileDesc").value;
			var directorName = document.getElementById("directorName").value;	
			var address = document.getElementById("address").value;
			var panNo = document.getElementById("panNo").value;
			var cinLlp = document.getElementById("cinLlp").value;
			var tenant_id = document.getElementById("tenant_id").value;
			
				
			if (!$('#directorName').val()) {
				$(".nameError").text("Please Enter Direct Name");
				checkError = 0;
        	} else {
				$(".nameError").text("");
				checkError = 1;
			}
			
			if (!$('#panNo').val()) {
				$(".panError").text("Please Enter Pan No.");
				panError = 0;
			} else {
				$(".panError").text("");
				panError = 1;
			}
			
			if (nameError === 1 && panError === 1) {
			
				var form_data = new FormData();           
				form_data.append('file', file_data);
				form_data.append('fileDesc', fileDesc);
				form_data.append('directorName', directorName);
				form_data.append('address', address);
				form_data.append('panNo', panNo);
				form_data.append('cinLlp', cinLlp);
				form_data.append('tenant_id', tenant_id);


				$.ajax({
						url: 'add-director-details.php', // <-- point to server-side PHP script 
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