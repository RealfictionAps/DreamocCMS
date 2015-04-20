<?php 
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) :

$file = "config.xml"; //file location 
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="'.basename($file).'"'); 
header('Content-Length: ' . filesize($file));
readfile($file);

unlink($file);

endif; ?>