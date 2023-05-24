<?php   
include_once ('path.php');

 unset($_SESSION['Email']);
 
 session_destroy();  
 header("location:/".FOLDER_NAME."/login.php");  
 ?>  