<?php 
session_start();
include_once ('conn.php');

$v_id = $_SESSION["id"];


$v_newPassword=$_POST['newPassword'];
$v_oldPassword=$_POST['confirmPassword'];


$sql = "UPDATE users SET Password='$v_newPassword' WHERE id= '$v_id' ";
$query = $dbConn->prepare($sql);
 $dbConn->exec($sql);
echo "<script>alert('Password Changed successfully!'); window.location='login.php'</script>";
 session_destroy();  
 ?> 

