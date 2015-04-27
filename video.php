<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$name=$_GET['video'];
$ext=$_GET['ext'];
?>

<div align="center" style="">
<OBJECT id="Video5" DATA="<?php echo "$name"; ?>" TYPE="video/<?php echo "$ext"; ?>"  width="700" height="450" >

      
	<param name="AutoStart" value="true">    
   	       <param name="src" value="<?php echo "$name"; ?>">
	<param name="ShowControls" value="0">
       <param name="uiMode" value="mini">

      <EMBED type="video/<?php echo "$ext"; ?>"   
	name="video6"
        width="700"
        height="450"
	src="<?php echo "$name"; ?>"


        AutoStart="true"


>

       </EMBED>
	   	   <a href ="<?php echo "$name"; ?>">File cannot be played. Download and play here.</a>
	
</OBJECT>

</div>
<!--
<video width="700" height="450" controls>
  <source src="<?php echo "$name"; ?>" type="video/<?php echo $ext; ?>">
Your browser does not support the video tag.
</video>
-->

</body>
</html>