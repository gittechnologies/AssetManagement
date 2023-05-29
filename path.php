<?php 
$folder_path_array = explode("/",$_SERVER['REQUEST_URI']);
$folder_name = $folder_path_array[1];

$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/'.$folder_name.'/';
$doc_folder_name = '/uploadedDocTest/';

if ($folder_name == 'pms') {
    $doc_folder_name = '/uploadedDoc/';
} 

$upload_file_name = $_SERVER['CONTEXT_DOCUMENT_ROOT'] .$doc_folder_name;

define('URL', $url);
define('FOLDER_NAME', $folder_name);
define('UPLOADED_DOC', $upload_file_name);
define('AGREEMENT', 'agreement');
define('TENANT', 'tenant');
define('RENT', 'rent');
?>