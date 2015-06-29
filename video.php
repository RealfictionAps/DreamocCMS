<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Video Player</title>

<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.12/video.js"></script>

</head>

<body>
<?php
$name=$_GET['video'];
$ext=$_GET['ext'];
$server = $_SERVER['DOCUMENT_ROOT'];
?>

<div align="center" style="">

<video id="example_video_1" class="video-js vjs-default-skin"
  controls preload="auto" width="700" height="450"
  data-setup='{"example_option":true}'>
 <source src="<?php echo "/$name"; ?>" type='video/mp4<?php //echo "$ext"; ?>' />
 <!-- <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
 <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' /> -->
 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>

</div>
<!--
<video width="700" height="450" controls>
  <source src="<?php echo "$name"; ?>" type="video/<?php echo $ext; ?>">
Your browser does not support the video tag.
</video>
-->

</body>
</html>