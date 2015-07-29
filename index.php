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
					'fileSizeLimit' : '200MB',
					'buttonText' : 'UPLOAD FILES',
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
        <div style=" position:absolute; float: left; margin-left: 100px; margin-top: -3px;"><a href="index.php"><img width="280" src="assets/img/logo.png" border="0"></a></div>
		<?php
        $whitelist = array(
		'localhost:8888',
		'::1'
		);
		
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		echo "<div style='margin-left: 400px; font-size: 28px; color:#3EE83E; position: absolute;'>TEST SERVER <a href='http://customercontent.dreamoc.com/?p=$p' target='_blank'>-></a></div>";
		}
		?>
        <div style="float: right; text-align:right;">Logged in as: <?php echo $userL; ?><br><a href="includes/logout.php">log out</a></div>
        <script type="text/javascript">
$(document).ready(function(){
    var form = $('#desc1'),
        original = form.serialize()

    form.submit(function(){
        window.onbeforeunload = null
    })

    window.onbeforeunload = function(){
        if (form.serialize() != original)
            return 'You have made changes to your settings. Are you sure you want to leave? If you leave, your settings will not be stored and your Dreamoc(s) will not be updated.'
    }
})
</script>
<div style="float:right;  padding-top: 0px; margin-right: 20px;">
<?php if(isset($_GET['upd'])) { ?>
<div style=" position:absolute; border: solid 1px #fff; border-radius: 10px; margin-left: -400px; margin-top: -10px; padding: 3px;">
<form method="post" action="#" name="desc1" id="desc1">
<label>Name your Group:</label>
<input style="width: 210px;" name="desc" type="text" autofocus placeholder="My Dreamoc" value="<?php $descIn = file_get_contents("$dir/$userL/description.txt"); echo strip_tags($descIn); ?>">
<input type="hidden" name="p" value="<?php echo $_GET['p']; ?>">
<input class="btn_green" type="submit" value="Ok">
</form>
</div>
<?php } else { ?>
Name your Group:
<a class="btn_blue" href="?p=<?php echo $_GET['p']; ?>&upd=1"><?php $descIn = file_get_contents("$dir/$userL/description.txt"); if($descIn != '') { echo strip_tags($descIn); } else { echo "My Dreamoc"; } ?></a>
<?php } 
if(isset($_POST['desc'])) {
	$desc = $_POST['desc'];
	$pReturn = $_POST['p'];
	$fil = fopen("$dir/$userL/description.txt", "w"); //Åben tekstfilen 
	fwrite($fil, "$desc");
	fclose($fil); //Luk filen
	echo '<meta http-equiv="refresh" content="0; url=index.php?p=' .$pReturn . '">';
}
?>
    </div>
    </div>
    
<div style="clear:both;"></div>
    <div style="float:left; width:100%;">
    <div class="side bar">
      <ul>
        <li><a href="?p=upload" <?php if($p == 'upload') { echo 'id="document"'; } ?> title="Upload & manage content"><span class="fontawesome-cloud-upload"></span></a></li>
        <li><a href="?p=servercontrol" <?php if($p == 'servercontrol') { echo 'id="document"'; } ?> title="Server Control"><span class="fontawesome-tasks"></span></a></li>
        <li><a href="?p=hd3conf" <?php if($p == 'hd3conf') { echo 'id="document"'; } ?> title="Download configuration file"><span class="fontawesome-magnet"></span></a></li>
        <li><a href="?p=weatherapp" <?php if($p == 'weatherapp') { echo 'id="document"'; } ?> title="Weather App"><span class="fontawesome-cloud"></span></a></li>
        <li><a href="?p=legal" <?php if($p == 'legal') { echo 'id="document"'; } ?> title="Legal info"><span class="fontawesome-legal"></span></a></li>
      <?php if($userL == $adminUL) { ?><li><a href="?p=register" <?php if($p == 'register') { echo 'id="document"'; } ?> title="Info"><span class="fontawesome-user"></span></a></li><?php } ?>
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