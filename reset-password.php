<?php

 session_start();
 if(!isset($_SESSION['Email']))
  {
   header("location: login.php");
  }
 $name=$_SESSION['Email'];


 include_once ('conn.php');
 ?>

<?php include 'menu.php';?>


<div class="content-wrapper">
 <section class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <div class="card card-primary mt-2">
      <div class="card-header">
       <h3 class="card-title">Reset Password</h3>
	 <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Reset Password</li>
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
 <div class="col-md-6 m-auto">
 <div class="card card-primary mt-5">

<form action="handler.php" name="forml" id="form1" method="POST">
 <div class="card-body">

<input type="hidden" class="form-control" name="id" value="<?php echo $v_id;?>">


 
 <div class="form-group">
  <label for="exampleInputEmail1">New Password</label>
   <input type="password" class="form-control" id="newpassword" placeholder="Enter New Password" name="newPassword">
 </div>

 <div class="form-group">
  <label for="exampleInputPassword1">Confirm Password</label>
   <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirmPassword">
 </div>
</div>

<div class="card-footer" align="center">
 <button type="submit" name="submit" class="btn btn-primary" onclick="validatet()">Update</button>
 <button type="button" name="add_lead" onclick="window.location='dashboard/dashboard.php'" class="btn btn-primary"> Cancel </button>
</div>

</form>
</div>
</div>
</section>
</div>


<?php include 'footer.php';?> 
