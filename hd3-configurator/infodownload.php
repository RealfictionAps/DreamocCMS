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
    <div style="font-size: 18px; margin-bottom: 40px;">Now you just need to download the SD-key file, named: &quot;config.xml&quot; and copy it from your Downloads folder to your SD Card and insert it into your Dreamoc(s).<br><br>This file is an unique key file, that connects your Dreamoc(s) to your Dreamoc CMS account. After inserting the SD-key into all the Dreamocs you want, you can always upload new files to your CMS service, and they will automaticly be downloaded to your Dreamoc(s) at your decided time a day (default at midnight).<br>
      <br>
      <img src="sdToDreamoc.png" alt=""/> <br><br>
    NB! Make sure the SD-key file name is exactly &quot;config.xml&quot; on the SD Card - and that there are no other files on the SD card.</div>
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
  	<a href="download.php" class="btn_green" onClick="hide('mydiv'),show('mydiv2');">Finish and download SD-key</a>
  </div> 
  <div id="mydiv2">
  	<a href="../?p=hd3conf" target="_parent" class="btn_blue">DONE</a>
    <a href="../?p=weatherapp&pre=1" target="_parent" class="btn_blue">Or try Weather App</a>
  </div> 
  
</div>
</body>
</html>