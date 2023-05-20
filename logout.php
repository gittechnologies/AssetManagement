<?php   
 unset($_SESSION['Email']);
 
 session_destroy();  
 header("location:/pms/login.php");  
 ?>  