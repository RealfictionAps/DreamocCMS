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
<video width="700" height="450" controls>
  <source src="<?php echo "$name"; ?>" type="video/<?php echo $ext; ?>">
Your browser does not support the video tag.
</video>

</body>
</html>