<?php

$zip = new ZipArchive;
$curdate = date("Ymdis");
$zipname = "$curdate.zip";
$path = __DIR__.DIRECTORY_SEPARATOR.'pdfs';
$tmp_file = "$path".DIRECTORY_SEPARATOR.$zipname;

if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
    $files = array_diff(scandir($path), array('.', '..'));
    foreach ($files as $file) { 
        $file = pathinfo($file);
        if ($file['extension'] == 'pdf') {
            $filename = $file['filename'] . "." . $file['extension'];
            $zip->addFile($path.DIRECTORY_SEPARATOR.$filename, $filename);
        }
    }
    
    $zip->close();

    header("Content-type: application/zip"); 
    header("Content-Disposition: attachment; filename=$zipname");
    header("Content-length: " . filesize($zipname));
    header("Pragma: no-cache");
    header("Expires: 0");

    ob_clean();
    flush();
    
    readfile("$tmp_file");
} else {
    echo 'Error en crear fitxer';
}