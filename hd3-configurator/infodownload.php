<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Download for SD</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">  
</head>

<body>
<div align="center" style="padding-top: 20px; padding-bottom: 50px; margin: 0px 60px 0px 60px">
  <p>
  <div style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Great! You are almost done.</div>
    <div style="font-size: 18px; margin-bottom: 40px;">Now you just need to download the &quot;config.xml&quot; and copy it from your Downloads folder to your SD Card and insert it into your Dreamoc's.<br>
      <br>
      <img src="sdToDreamoc.png" alt=""/> <br><br>
    NB! Make sure the config file name is exactly &quot;config.xml&quot; on the SD Card.
  </div>
  </p>
  <script type="text/javascript">
  	function hide(target) {
    document.getElementById(target).style.display = 'none';
	}
	function show(target) {
	document.getElementById(target).style.display = 'block';
	}
  </script>
  <style>
  #mydiv2 { display:none; }
  </style>
  <div id="mydiv">
  	<a href="download.php" class="btn_green" onClick="hide('mydiv'),show('mydiv2');">Finish and download file</a>
  </div> 
  <div id="mydiv2">
  	<a href="../?p=hd3conf" target="_parent" class="btn_blue">DONE</a>
    <a href="../?p=weatherapp" target="_parent" class="btn_blue">Or try Weather App</a>
  </div> 
  
</div>
</body>
</html>