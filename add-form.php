<?php
	 include_once ('conn.php');
	 
	$v_username=$_POST['username'];
	$v_email=$_POST['email'];
	$v_password=$_POST['password'];

	$sql = "INSERT INTO users (UserName,Email,Password) VALUES ('$v_username','$v_email','$v_password'";
    $query = $dbConn->prepare($sql);
	$dbConn->exec($sql);

	//      <------------------------Alert---------------------->

 echo "<script>alert('Data successfully added!'); window.location='property.php'</script>";

?>

