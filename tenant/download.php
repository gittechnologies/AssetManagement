<?php
session_start();
include_once ('../path.php');

if(isset($_GET['path']))
{
    $url = parse_url($_SERVER["HTTP_REFERER"]);
    $url_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($url['path'],".php"));
    $filename = $_GET['path'];
    $file_path = UPLOADED_DOC .TENANT .'/'.$_SESSION["id"].'/'.$filename;

    if ($url_without_ext == "document-upload") {
        $file_path = UPLOADED_DOC .TENANTDOC .'/'.$_SESSION["id"].'/'.$filename;
    }   
   

    if(file_exists($file_path)) {

        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
        header('Content-Length: ' . filesize($file_path));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($file_path);

        //Terminate from the script
        die();
    }
    else{
        echo "File does not exist.";
    }
}
else
echo "Filename is not defined."
?>