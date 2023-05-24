
<?php 
$folder_path_array = explode("/",$_SERVER['REQUEST_URI']);
$folder_name = $folder_path_array[1];

$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.$folder_name.'/';

define('URL', $url);
define('FOLDER_NAME', $folder_name);

?>