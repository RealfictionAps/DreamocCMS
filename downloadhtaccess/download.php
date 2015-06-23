<?php

include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();
$userL = $_SESSION['username'];

//put connection to database here
include_once '../includes/psl-config.php';	
mysql_connect(HOST, USER, PASSWORD)
or die ("Sorry, can't connect to database.");
mysql_select_db(DATABASE);	

$filename = $_GET['file'];
$path = $_SERVER['DOCUMENT_ROOT']."/users/$userL/"; //path of this file
$fullPath = $path.$filename; //path to download file

$filetypes = array("mov","mp4","MOV","MP4");

if (!in_array(substr($filename, -3), $filetypes)) {
	echo "Invalid download type.";
	exit;
}

if ($fd = fopen ($fullPath, "r")) {
	//add download stat
	$result = mysql_query("SELECT COUNT(*) AS countfile FROM download
	WHERE filename='" . $filename . "'");
	$data = mysql_fetch_array($result);
	$q = "";
	
	if ($data['countfile'] > 0) {
		$q = "UPDATE download SET stats = stats + 1 WHERE
		filename = '" . $filename . "'";
	} else {
		$q = "INSERT INTO download (filename, user, stats) VALUES
		('" . $filename . "', '" . $userL . "', 1)";
	}
	$statresult = mysql_query($q);
	
	//the next part outputs the file
	$fsize = filesize($fullPath);
	$path_parts = pathinfo($fullPath);

	header("Content-type: application/octet-stream");
	header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
	header("Content-length: $fsize");
	header("Cache-control: private"); //use this to open files directly
	while(!feof($fd)) {
		$buffer = fread($fd, 2048);
		echo $buffer;
	}
}
fclose ($fd);
exit;

?>