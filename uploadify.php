<?php
$targetFolder = $_POST['path']; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'),0,5);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$fName = $_FILES['Filedata']['name'];
	$fName = substr($fName, 0, 3);
	$targetFile = rtrim($targetPath,'/') . '/' . $fName . $rand . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('mov','MOV','mp4','mpg','MPG','MP4','AVI','WMV','wmv'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>