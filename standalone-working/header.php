<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<!-- JQuery -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

    <script type="text/javascript" src="jquery.uploadify.min.js"></script>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
					'successTimeout' : 7,
					'buttonText' : 'Upload files',
					'formData'  : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
								  },
					'swf'      : 'uploadify.swf',
					'uploader' : 'uploadify.php',
					'onUploadSuccess' : function(file, data, response) { 
					setTimeout(function(){
					window.location.reload(1);
					}, 1500); 
					}
			});
		});
	</script>

<!-- Main CSS -->
<link rel="stylesheet" type="text/css" href="css/style.css">    

<!-- Uploadify -->
<link rel="stylesheet" type="text/css" href="css/uploadify.css">

<!-- RANGE SLIDER -->
<link rel="stylesheet" href="css/ion.rangeSlider.css" />
<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />

<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>