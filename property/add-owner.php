
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
			 <h3 class="card-title">Add Unit Details/ Owner</h3>
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Add Unit Details</li>
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

<form action="owner-upload.php" method="post" >   
<input type="hidden" name="_token" value="eEifbbuEEsdQtKP6KyzLrtGiJ0E7ZF8L41w0BdEr"> 
<input type="hidden" id="property_id" name="property_id" value="<?php echo $id;?>"> 
<div class="card-primary2">

<ul class="add-lead-ul">

<li>
 <div class="form-group">
  <label>Owner Name <span>*</span></label><br>

<div id="div0">
    <select class="form-control form-control-sm" id="owner_name" name="owner_name" required>
     <option value="0"> Select Owner </option>
     <?php 
      $result = $dbConn->query("SELECT owner_id, owner_name FROM det_owner where status = 'Active'");
      $result->execute();
       while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
         $owner_id=$row['owner_id'];
         $owner_name=$row['owner_name'];
      ?>
     <option value="<?php echo $owner_id;?>"><?php echo $owner_name;?></option>
      <?php  }?>
    </select>  
  </div>

 </div> 
</li>

<li>
 <div class="form-group">
  <label>Build-Up Area <span>*</span></label>
   <input type="text" class="form-control form-control-sm" placeholder="Build-Up Area" name="buildUpArea" id="buildUpArea" onkeyup="this.value= this.value.replace(/[^-'a-zA-Z0-9]+$/, '')" required>
  <span class="text-danger"></span>
 </div>
</li>

<li>
 <div class="form-group">
	<label >Unit/Shop No.</label>
	 <input type="text" class="form-control form-control-sm" placeholder="Unit/Shop No." name="unitNo" id="unitNo" 
	 >
    <span class="text-danger"></span>  
 </div>
</li>

<li>
 <div class="form-group">
  <label>Gram Panchayat No./Property Tax</label>
   <input type="text" class="form-control form-control-sm" placeholder="Gram Panchayat No./Property Tax" name="property_tax" id="property_tax" >
    <span class="text-danger"></span>
</li>

</form>

 <div class="card-footer" align="center">
	<button type="button" id= "addOwner" name="addOwner" 
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
<table class="table table-responsive table-bordered table-hover small display nowrap dataTable no-footer">
 <thead class="ntable-header">
	<tr>
		<th>Owner Name</th>
		<th>Unit/Shop No.</th>
		<th>Build-Up Area</th>
		<th>Gram Panchayat No./Property Tax</th>
		<th>Action</th>
	</tr>
	</thead>
<tbody>
 <?php 
 $result = $dbConn->query("SELECT op.id , op.unitNo , op.property_tax , o.owner_name , op.buildup_area from det_owner_property op join det_owner o on op.owner_id = o.owner_id where op.property_id='$id' and o.status ='Active' and op.status=1");
 $result->execute();

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {

		
		echo "<tr>";
		echo "<td>".$row['owner_name']."</td>"; 
		echo "<td>".$row['unitNo']."</td>"; 
		echo "<td>".$row['buildup_area']."</td>"; 
		echo "<td>".$row['property_tax']."</td>"; 
		echo "<td>"; ?>
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
				url: 'delete-owner.php', // <-- point to server-side PHP script 
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

	
	$('#addOwner').on('click', function() {

			var owner_name = document.getElementById("owner_name").value;	
			var unitNo = document.getElementById("unitNo").value;
			var property_tax = document.getElementById("property_tax").value;
			var property_id = document.getElementById("property_id").value;
			var buildUpArea = document.getElementById("buildUpArea").value;

			
			var form_data = new FormData();                  
			form_data.append('owner_name', owner_name);
			form_data.append('unitNo', unitNo);
			form_data.append('property_tax', property_tax);
			form_data.append('property_id', property_id);
			form_data.append('buildUpArea', buildUpArea);


			$.ajax({
					url: 'owner-upload.php', // <-- point to server-side PHP script 
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


});

</script>


<?php include '../footer.php';?> 