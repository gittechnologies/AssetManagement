<?php 
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
$folder_path_array = explode("/",$_SERVER['REQUEST_URI']);
$folder_name = $folder_path_array[1];

$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.$folder_name.'/';
$upload_file_name = $_SERVER['CONTEXT_DOCUMENT_ROOT'] .'/uploadedDoc/';

define('URL', $url);
define('FOLDER_NAME', $folder_name);
define('UPLOADED_DOC', $upload_file_name);
define('AGREEMENT', 'agreement');
define('TENANT', 'tenant');
define('RENT', 'rent');
?>