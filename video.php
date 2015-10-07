<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Video Player</title>

<!--
<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.12/video.js"></script>
-->
	<script src="jmeVideo/build/jquery.js"></script>	
	<script src="jmeVideo/build/mediaelement-and-player.min.js"></script>
	<script src="testforfiles.js"></script>	
	<link rel="stylesheet" href="jmeVideo/build/mediaelementplayer.min.css" />
	<style type="text/css">
	body {
	background-color: #000000;
}
    </style>
</head>

<body>

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
if (login_check($mysqli) == true) :

$name=$_GET['video'];
$ext=$_GET['ext'];
$server = $_SERVER['DOCUMENT_ROOT'];
?>

<div align="center" style="">
<video width="640" height="360" src="<?php echo "$name"; ?>" type="video/<?php echo $ext; ?>" 
	id="player1"  
	controls="controls" preload="none"></video>
	<!-- fjernet inde fra video: poster="jmeVideo/media/echo-hereweare.jpg" -->
<script>
$('audio,video').mediaelementplayer({
	//mode: 'shim',
	success: function(player, node) {
		$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
	}
});
</script>
</div>

<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
</body>
</html>