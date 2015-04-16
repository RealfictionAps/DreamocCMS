<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : ?>
<div align="center" style="width: 680px;">
	<h1>Upload files to your dreamoc</h1>
<br><br>
        <form style="float:left; margin-left: 60px; width: 300px;">
          <div id="queue"></div>
          <p>
            <input type="file" name="file_upload" id="file_upload" />
          </p>
        </form>

<div style="clear:both;"></div>

      <div style="float:left;">
      <h3>Video list</h3>
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
    if ($file != "." && $file != ".." && $file != "server_check.xml" && $file != "server_control_dreamoc_config.xml" && $file != ".DS_Store") //Fjern . og ..
    {
        if (is_file($dirname.$file)) //Find ud af om det er en fil eller en mappe
        {
			// FIND HASH OF FILE
			$path = $_SERVER['DOCUMENT_ROOT'];
			$fileMD5 = $path."/$dir/$userL/$file";  // any file
			$hash = md5_file($fileMD5);
			// SHort name
			$ShortFileName = substr($file, 0, 30);
			if(strlen($file) > 30) { $end = "(...)"; }
			$count = $i++;
			echo "<div style='margin: 10px 10px 10px 0px; padding-bottom: 80px;'>
					
					<div style='float:left;'>
						<video width='150'>
							<source src='$dirname$file' type='video/mp4'>
							Your browser does not support the video tag.
						</video>
					</div>
					<div style='float:left; padding-left: 10px; padding-top: 10%;'>Fil #$count:<br>$ShortFileName $end</div>
	
					<div style='float:right; margin-top: 10px; margin-right: 15px;'><a href='index.php?del=$file' style='color:red'>Delete</a></div>";
			//echo "<br>Hash: $hash";
			echo "</div><br>";
			
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
      <td width="213" valign="top">
<div align="center" style="margin-top: 10px;"> <a href="index.php" class="btn disabled">Update files list</a></div>
<div align="center" style="padding-top: 20px">
<a href="index.php?run=y" class="btn">Update Dreamoc</a>

        <?php
if(isset($_GET['run'])) { echo "<div style='color:green; padding-top: 10px; font-weight: bold;'>-- DONE --</div>"; }

if(isset($_GET['del'])) {
	$fileDel = $_GET['del'];
	unlink("$dir/$userL/$fileDel");
	echo '<meta http-equiv="refresh" content="0; url=index.php">';
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