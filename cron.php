
<?php
// #### Connect to MySql
include_once 'includes/psl-config.php';
mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

$result = mysql_query("SELECT * FROM members");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$userL = "{$row['username']}";
$user_id = "{$row['id']}";

$result2 = mysql_query("SELECT * FROM user_meta WHERE user_id = $user_id");
while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
{ 
$username = "{$row2['username']}";
$password = "{$row2['password']}";
$filename = "{$row2['filename']}";
$WaSet = "{$row2['weatherapp']}";

$rand = substr(md5($userL), 0, 8); // Skriver de første 8 tegn af users hash til filen, som kryptering

if($WaSet == 'on' && isset($username) && isset($password) && isset($filename)) {
// define some variables
$local_file = "users/$userL/$rand$filename";
$server_file = "$filename";
$ftp_server="data.seenspire.com";
$ftp_user_name = "$username";
$ftp_user_pass = "$password";

$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// try to download $server_file and save to $local_file
if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
    //echo "Successfully written to $local_file\n";
	echo "ok";
}
else {
    echo "There was a problem\n";
}
// close the connection
ftp_close($conn_id);

}

// START

if($WaSet == 'on') { $filename = ""; }


$dir = "users/$userL/"; //Hvor skal den lede efter filer?
$i = 1;
$directories = array();
$files_list  = array();
$files = scandir($dir);

    $i2 = 0; 
    if ($handle1 = opendir($dir)) {
        while (($file1 = readdir($handle1)) !== false){
            if (!in_array($file1, array('.', '..', 'server_check.xml', 'server_control_dreamoc_config.xml', '.DS_Store', '.htaccess', 'description.txt', $filename)) && !is_dir($dir.$file1)) { $i2++; }
        }
    }
	
$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS); // Tæller hvor mange filer (synlige) der er i folderen
$filesC = iterator_count($fi)-$i2; // Files in folder other than content
//$i2:  files in folder only content

foreach($files as $file){
   if(($file != '.') && ($file != '..') && ($file != '._') && ($file != 'server_check.xml') && ($file != 'server_control_dreamoc_config.xml') && ($file != '.DS_Store') && ($file != '.htaccess') && ($file != 'description.txt') && ($file != $filename)){
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
			$ShortFileName = substr($file_list, 0, 40);
			if(strlen($file_list) > 30) { $end = "(...)"; } else { $end = ""; }
			$count = $i++;
			$ext = pathinfo($file_list, PATHINFO_EXTENSION);
			?>
            <!--
            <div style='background-color:#D4D4D4; float:left; width: 500px; padding-bottom: 20px; margin-bottom: 10px;'>
			  <div style='float:left; padding-left:10px; margin-top:10px;'><span style='text-decoration:none;'>
            	<a class="video-<?php echo $count; ?>" data-fancybox-type="iframe" style="color:#1A9EEC !important;" href="video.php?video=<?php echo "$dir$file_list&ext=$ext"; ?>"><? echo "$ShortFileName $end"; ?></a></span><!--<br>Fil #<?php echo "$count"; ?>
              </div>
			<div style='float:right; margin-top: 13px; margin-right: 15px;'>
            	<a href='index.php?del=<?php echo $file_list; ?>' title='Delete this' class='btn_red'>X</a>
              </div>
			</div>
            -->

<?php
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
echo "xml - ok";
// SLUT


}
}
?>