<?php
$server = "localhost";
$user = "emdn_senbei";
$clave = "Mazinger_2017$";
$dbname = "emdn_store";

$local_file_development = $_SERVER['DOCUMENT_ROOT'].'/admin/local_development.php';
if(file_exists($local_file_development)){
    include $local_file_development;
}