<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : ?>

<div align="center" style="width: 680px;">
	<div style="margin-right: 220px;"><h1>Upload files to your dreamoc</h1></div>
<br><br>
        <form style="float:left; margin-left: 60px; width: 300px;">
          <div id="queue"></div>
          <p>
            <input type="file" name="file_upload" id="file_upload" />
          </p>
        </form>

<div style="clear:both;"></div>

      <div style="float:left;">
      <h3>Content uploads:</h3>
      </div>
<div style="clear:both;"></div>
<table width="0" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="482" valign="top" style="border-right-style: dashed; border-color:#CDCBCB;">
	  <?php
$dirname = "$dir/$userL/"; //Hvor skal den lede efter filer?
$dirhandle = opendir($dirname); //Åben mappen
$i = 1;
while($file = readdir($dirhandle)) //Loop gennem mappen
{
    if ($file != "." && $file != ".." && $file != "server_check.xml" && $file != "server_control_dreamoc_config.xml" && $file != ".DS_Store" && $file != "description.txt") //Fjern . og ..
    {
        if (is_file($dirname.$file)) //Find ud af om det er en fil eller en mappe
        {
			// FIND HASH OF FILE
			$path = $_SERVER['DOCUMENT_ROOT'];
			$fileMD5 = $path."/$dir/$userL/$file";  // any file
			$hash = md5_file($fileMD5);
			// SHort name
			$ShortFileName = substr($file, 0, 40);
			if(strlen($file) > 30) { $end = "(...)"; } else { $end = ""; }
			$count = $i++;
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			?>
            <div style='background-color:#D4D4D4; margin: 10px 10px 10px 0px; padding-bottom: 80px;'>
			  <div style='float:left; padding-left:10px; margin-top:10px;'><span style='font-size: 20px; text-decoration:none;'>
            	<a class="video-<?php echo $count; ?>" data-fancybox-type="iframe" style="color:#1A9EEC !important;" href="video.php?video=<?php echo "$dirname$file&ext=$ext"; ?>"><? echo "$ShortFileName $end"; ?></a></span><br>Fil #<?php echo "$count"; ?>
              </div>
			<div style='float:right; margin-top: 13px; margin-right: 15px;'>
            	<a href='index.php?del=<?php echo $file; ?>' title='Delete this' class='btn_red'>X</a>
              </div>
			</div>
            <script type="text/javascript">

			$(document).ready(function() {
			$(".video-<? echo $count; ?>").fancybox({
				maxWidth	: 700,
				maxHeight	: 500,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		});
					</script>
			<?php 
			//echo "<br>Hash: $hash";
			
if(isset($_GET['run'])) {

if($count < 1) { // DELETE content / start fresh
	$fil = fopen("$dir/$userL/server_check.xml", "w"); //Åben tekstfilen 
	fwrite($fil, '');
	fclose($fil); //Luk filen
}

if($count > 1) {
	$origFile = file_get_contents("$dir/$userL/server_check.xml"); //Læs indholdet af filen
}
else { $origFile = ""; }

$contentNew = "
	<file_number>$count</file_number>	
	<file>
	<file_index>$count</file_index>
	<file_name>$file</file_name>
	<file_hash>$hash</file_hash>
	</file>
";

$fi = new FilesystemIterator($dirname, FilesystemIterator::SKIP_DOTS); // Tæller hvor mange filer (synlige) der er i folderen
$filesC = iterator_count($fi)-2; // Trækker to filer fra.

if($count == $filesC) { 
				$header = "<?xml version='1.0' encoding='utf-8' ?>\n<file_status>";
				$footer = "</file_status>"; 
					} // Hvis det er sidste loop, så skal den skrive headeren i linje 1
$content = "$origFile $contentNew";

//Gem det nye tal i tekstfilen
$fil = fopen("$dir/$userL/server_check.xml", "w"); //Åben tekstfilen hvor antallet af hits gemmes i
fwrite($fil, $header); // Hvis det er sidste loop, så skal den skrive headeren i linje 1
fwrite($fil, $content); //Skriv content til filen.
fwrite($fil, $footer); //Hvis det er sidste loop, så slut med at skrive footeren til filen
fclose($fil); //Luk filen


}
        }
        else
        {
            //echo "mappe: " . $file . "<br>";
        }
    }
}
?>
      </td>
      <td width="250" valign="top">
<script type="text/javascript">
$(document).ready(function(){
    var form = $('#desc1'),
        original = form.serialize()

    form.submit(function(){
        window.onbeforeunload = null
    })

    window.onbeforeunload = function(){
        if (form.serialize() != original)
            return 'You have made changes to your settings. Are you sure you want to leave?'
    }
})
</script>
<div style="padding-top: 10px; margin-left: 10px; font-size: 20px;">
<?php if(isset($_GET['upd'])) { ?>
<div style="border: solid #989898; margin-bottom: 20px; border-radius: 10px; padding: 10px;">
<form method="post" action="#" name="desc1" id="desc1">
<label>Dreamoc group / location:</label>
<input style="font-size: 20px; width: 210px;" name="desc" type="text" autofocus placeholder="My Dreamoc" value="<?php $descIn = file_get_contents("$dir/$userL/description.txt"); echo strip_tags($descIn); ?>">
<input style="margin-top: 10px;" class="btn_green" type="submit" value="Ok">
</form>
</div>
<?php } else { ?>
<div style="margin-bottom: 5px;">Dreamoc group / location:</div>
<a class="btn_blue" href="?upd=1"><?php $descIn = file_get_contents("$dir/$userL/description.txt"); if($descIn != '') { echo strip_tags($descIn); } else { echo "My Dreamoc"; } ?></a>
<br><br><br>
<?php } ?>
<a class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=upload">HELP ME</a>

<script type="text/javascript">
		$(document).ready(function() {
		$("#help").fancybox({
			maxWidth	: 700,
			maxHeight	: 500,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
</script>
<?php
if(isset($_POST['desc'])) {
	$desc = $_POST['desc'];
	$fil = fopen("$dir/$userL/description.txt", "w"); //Åben tekstfilen 
	fwrite($fil, "$desc");
	fclose($fil); //Luk filen
	echo '<meta http-equiv="refresh" content="0; url=index.php">';
}

if(isset($_GET['run'])) { echo "<div style='color:green; padding-top: 15px; font-weight: bold;'>Your Dreamocs are updated</div>"; }

if(isset($_GET['del'])) {
	$fileDel = $_GET['del'];
	unlink("$dir/$userL/$fileDel");
	echo '<meta http-equiv="refresh" content="0; url=index.php?run=y">';
}
?>
</div>
     </td>
    </tr>
  </tbody>
</table>
</div>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>