<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

// PAGE SELECT
$p = $_GET['p'];
if($p == '') { $p = "upload"; }
$userL = htmlentities($_SESSION['username']);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Dreamoc HD3 Media Server</title>
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
					'path'	 	: '<?php echo "/$dir/$userL";?>',
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
								  },
					'swf'      : 'uploadify.swf',
					'uploader' : 'uploadify.php',
					'onUploadSuccess' : function(file, data, response) { 
					setTimeout(function(){
					window.location.href = 'index.php?run=y';
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

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>
<body>
<?php
if (login_check($mysqli) == false) { echo '<meta http-equiv="refresh" content="0; url=login.php">'; }
?> 
    <div class="topbar">
        <div style=" position:absolute; float: left; margin-left: 100px; margin-top: -3px;"><img width="280" src="assets/img/logo.png"></div>
        <div style="float: right; text-align:right;">Logged in as: <br><a href="includes/logout.php">log out</a></div>
    <span style="float: right; text-align:right;"><?php echo $userL; ?></span></div>
<div style="clear:both;"></div>
    <div style="float:left; width:100%;">
    <div class="side bar">
      <ul>
        <li><a href="?p=upload" <?php if($p == 'upload') { echo 'id="document"'; } ?> title="Upload & manage content"><span class="fontawesome-cloud-upload"></span></a></li>
        <li><a href="?p=servercontrol" <?php if($p == 'servercontrol') { echo 'id="document"'; } ?> title="Settings"><span class="fontawesome-tasks"></span></a></li>
        <li><a href="?p=hd3conf" <?php if($p == 'hd3conf') { echo 'id="document"'; } ?> title="Download configuration file"><span class="fontawesome-magnet"></span></a></li>
      </ul>
    </div>
            <div style="position:absolute; margin-bottom: 10px;	bottom:0; margin-left: 0px; margin-right: 5px; color:#fff; font-size:10px;";>
            Licenses
            <br>
            <a href="http://www.uploadify.com" target="_blank">Uplodify</a>
            <br>
            <a href="https://github.com/peredurabefrog/phpSecureLogin.git" target="_blank">phpSecureLogin</a>
            <br>
            <a href="license-freebie.txt" target="_blank">Freebie UI</a>
          </div>
    <div class="newPostContent">
      <?php include($p . ".php"); ?>
  </div>
  </div>
  
  <!--
  <div style="float:left; width: 90px; background-color:#20293D; margin-right: 20px;">T wrthft yjfy ujkg yukgkf tujftj dtyjdryth srthsrthsrty rth srth</div>
    <div style="float:left; width:200px;">gg</div>
    -->
</body>
</html>
