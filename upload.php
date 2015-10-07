<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : ?>

<div align="center" style="width: 680px;">
	<div style="margin-right: 220px;"><h1>Upload files to your dreamoc</h1></div>
    
<div style="position:absolute; margin-top: -35px; margin-left: 440px;">
<a style="margin-left: 10px;" class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=upload">?</a>
<script type="text/javascript">
		$(document).ready(function() {
		$("#help").fancybox({
			maxWidth	: 700,
			maxHeight	: 800,
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
</div>
</div>

<div style="margin-left: 160px; margin-top: 50px; width: 300px;">
      <form>
        <div id="queue"></div>
        <p>
          <input type="file" name="file_upload" id="file_upload" />
        </p>
      </form>
</div>


<div align="center" style="width: 680px;">


<div style="clear:both;"></div>
<div style="margin-top: -10px; margin-bottom: 10px; font-weight: bold; margin-right: 200px; font-size: 10px;">Max 100 MB files.</div>
<?php 
if(isset($_GET['run'])) { 
echo "<div style='color:green; padding-top: -10px; padding-bottom: 15px; font-weight: bold; margin-right: 200px;'>Your Dreamoc playlist is updated.</div>"; 
}
if(isset($_GET['run']) && isset($_GET['rs']) && $_GET['rs'] != '1') { 
echo "<div style='color:red; padding-top: -10px; padding-bottom: 15px; font-weight: bold; margin-right: 200px;'>Sorry, you have uploaded an unvalid file.</div>"; 
} 
?>

      <div style="float:left; font-weight: bold; margin-bottom: 20px;">
      Content list:
      </div>
<div style="clear:both;"></div>

<?php
$dir = "$dir/$userL/"; //Hvor skal den lede efter filer?
$i = 1;
$directories = array();
$files_list  = array();
$files = scandir($dir);

// #### Connect to MySql
include_once 'includes/psl-config.php';
mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

$result = mysql_query("SELECT * FROM members WHERE username = '$userL' LIMIT 1");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$user_id1 = "{$row['id']}"; // User ID fra members
}
	//LAVER BESKYTTELSE AF FILER MED HASH FORAN NAVN PÅ FILER
	$result2 = mysql_query("SELECT * FROM user_meta WHERE user_id = '$user_id1' LIMIT 1");
	while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
	{
	$WaSet = "{$row2['weatherapp']}";
	$filename = "{$row2['filename']}";
	}
	$rand = substr(md5($userL), 0, 8); // Skriver de første 8 tegn af users hash til filen, som kryptering
	if($WaSet == 'on') { $filename = ""; } else { $filename = "$rand$filename"; }
	
	//DONT SHOW .nfs-FILES
	$nfs = glob("$dir" . ".nfs*");
	$nfs = str_replace($dir, '', $nfs[0]);
			
    $i2 = 0; 
    if ($handle1 = opendir($dir)) {
        while (($file1 = readdir($handle1)) !== false){
        if (!in_array($file1, array('.', '..', '._', 'server_check.xml', 'server_control_dreamoc_config.xml', '.DS_Store', '.htaccess', 'description.txt', $filename, $nfs)) && !is_dir($dir.$file1)) { $i2++; }
        }
    }
	
$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS); // Tæller hvor mange filer (synlige) der er i folderen
$filesC = iterator_count($fi)-$i2; // Files in folder other than content
//$i2:  files in folder only content

foreach($files as $file){
   if(($file != '.') && ($file != '..') && ($file != '._') && ($file != 'server_check.xml') && ($file != 'server_control_dreamoc_config.xml') && ($file != '.DS_Store') && ($file != '.htaccess') && ($file != 'description.txt') && ($file != $filename) && ($file != $nfs)){
      if(is_dir($dir.'/'.$file)){
         $directories[]  = $file;

      }else{
         $files_list[]    = $file;

      }
   }
}

foreach($directories as $directory){
   //echo '<li class="folder">'.$directory.'</li>';
}
foreach($files_list as $file_list){
//   echo "$file";

			// FIND HASH OF FILE
			$path = $_SERVER['DOCUMENT_ROOT'];
			$fileMD5 = $path."/$dir/$file_list";  // any file_list
			$hash = md5_file($fileMD5);
			// SHort name
			$ShortFileName = substr($file_list, 8, 60);
			if(strlen($file_list) > 40) { $end = "(...)"; } else { $end = ""; }
			$count = $i++;
			$ext = pathinfo($file_list, PATHINFO_EXTENSION);
			?>
            <div style='background-color:#D4D4D4; float:left; width: 500px; padding-bottom: 20px; margin-bottom: 10px;'>
			  <div style='float:left; padding-left:10px; margin-top:10px;'><span style='text-decoration:none;'>
            	<a class="video-<?php echo $count; ?>" data-fancybox-type="iframe" style="color:#1A9EEC !important;" href="video.php?video=<?php echo "$dir$file_list&ext=$ext"; ?>"><? echo "$ShortFileName $end"; ?></a></span><!--<br>Fil #<?php echo "$count"; ?>-->
              </div>
			<div style='float:right; margin-top: 13px; margin-right: 15px;'>
            	<a href='index.php?del=<?php echo $file_list; ?>' title='Delete this' class='btn_red'>X</a>
              </div>
			</div>
            <script type="text/javascript">

			$(document).ready(function() {
			$(".video-<? echo $count; ?>").fancybox({
				maxWidth	: 680,
				maxHeight	: 390,
				fitToView	: false,
				width		: '100%',
				height		: '500px',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		});
					</script>
<?php
if(isset($_GET['run'])) {

if($count < 1) { // DELETE content / start fresh
	$fil = fopen("$dir/server_check.xml", "w"); //Åben tekstfilen 
	fwrite($fil, '');
	fclose($fil); //Luk filen
}

if($count > 1) {
	$origFile = file_get_contents("$dir/server_check.xml"); //Læs indholdet af filen
}
else { $origFile = ""; }

$contentNew = "
	<file_number>$count</file_number>	
	<file>
	<file_index>$count</file_index>
	<file_name>$file_list</file_name>
	<file_hash>$hash</file_hash>
	</file>
";

if($count == $i2) { 
				$header = "<?xml version='1.0' encoding='utf-8' ?>\n<file_status>";
				$footer = "</file_status>"; 
					} // Hvis det er sidste loop, så skal den skrive headeren i linje 1
$content = "$origFile $contentNew";

//Gem det nye tal i tekstfilen
$fil = fopen("$dir/server_check.xml", "w"); //Åben tekstfilen hvor antallet af hits gemmes i
fwrite($fil, $header); // Hvis det er sidste loop, så skal den skrive headeren i linje 1
fwrite($fil, $content); //Skriv content til filen.
fwrite($fil, $footer); //Hvis det er sidste loop, så slut med at skrive footeren til filen
fclose($fil); //Luk filen
}
} ?>


<?php
	if($i2 == '0') {
	$fil = fopen("$dir/server_check.xml", "w"); //Åben tekstfilen 
	fwrite($fil, '');
	fclose($fil); //Luk filen
	}
			
	if(isset($_GET['del'])) {
	$fileDel = $_GET['del'];
	unlink("$dir/$fileDel");
	echo '<meta http-equiv="refresh" content="0; url=index.php?run=y&d=1">';
	}
?>
</div>
<?php //if(isset($_GET['run']) && !isset($_GET['d'])) { ?>
<div style="clear:both; margin-left: 190px; margin-top: 150px;"><a href="index.php?p=servercontrol" class="btn_blue">Next step</a></div>
<?php //} ?>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>