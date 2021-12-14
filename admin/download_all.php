<?php

$zip = new ZipArchive;
$curdate = date("Ymdis");
$path = $_SERVER['DOCUMENT_ROOT'].'/admin/pdfs';
$tmp_file = "$path/$curdate.zip";

if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
    $files = array_diff(scandir($path), array('.', '..'));
    foreach ($files as $file) { 
        $file = pathinfo($file);
        if ($file['extension'] == 'pdf') {
            $filename = $file['filename'] . "." . $file['extension'];
            $zip->addFile("$path/$filename", $filename);
        }
    }
    
    $zip->close();    
    echo 'Descarregant!';

    header("Content-disposition: attachment; filename=$curdate.zip");
    header("Content-type: application/zip");

    readfile($tmp_file);
} else {
    echo 'Error en crear fitxer';
}