
<?php 
$folder_name_array = explode("/",$_SERVER['REQUEST_URI']);

$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.$folder_name_array[1].'/';

define('URL', $url);
?>