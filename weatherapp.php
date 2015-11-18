<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : 
$userL = htmlentities($_SESSION['username']);
?>
<div align="center" style="width: 500px;">
<h1>Include Weather App</h1>
<div style="position:absolute; margin-top: -35px; margin-left: 400px;">
<a style="margin-left: 10px;" class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=weatherapp">?</a>
<script type="text/javascript">
		$(document).ready(function() {
		$("#help").fancybox({
			maxWidth	: 700,
			maxHeight	: 900,
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

<script type="text/javascript">
$(document).ready(function(){
    var form = $('#weatherapp'),
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
<br><br>
<?php
// #### Connect to MySql
include_once 'includes/psl-config.php';
mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

$result = mysql_query("SELECT * FROM members WHERE username = '$userL' LIMIT 1");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$user_id1 = "{$row['id']}"; // User ID fra members
}
	$result2 = mysql_query("SELECT * FROM user_meta WHERE user_id = '$user_id1' LIMIT 1");
	while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
	{
	$user_id = "{$row2['id']}"; // User ID fra user_meta
	$WaSet = "{$row2['weatherapp']}";
	$DBusername = "{$row2['username']}";
	$DBpassword = "{$row2['password']}";
	$DBfilename = "{$row2['filename']}"; 
	}
?>
<?php
if(!empty($_POST) && !isset($_POST['desc']) ) { // Hvis der er indsendt weather app
	$username = $_POST['username'];
	$password = $_POST['password'];
	$POST_toggleWA = $_POST['toggleWA'];
	$filename = $_POST['filename'];

// ######## TJEKKER OM DER ER FORBINDELSE - KOPIERER FILEN, HVIS DER ER. ##########
$ftp_server="data.seenspire.com";
$rand = substr(md5($userL), 0, 8); // Skriver de første 8 tegn af users hash til filen, som kryptering
$local_file = "users/$userL/$rand$filename";
$conn_id = ftp_connect($ftp_server);
// login with username and password
$login_result = ftp_login($conn_id, $username, $password);
// try to download $server_file and save to $local_file

if($POST_toggleWA == 'on') {
if (ftp_get($conn_id, $local_file, $filename, FTP_BINARY)) {
    //echo "Successfully written to $local_file\n";
	$toggleWA = "on";
	$msg = "msg1"; // OK + ON
}
else {
    $toggleWA = "off";
	$msg .= "msg2"; // Wrong
}
}
else {
	if(ftp_login(ftp_connect($ftp_server), $username, $password)) {
	$toggleWA = "off";
	$msg = "msg3"; // Correct, but off
}
	else {
	$toggleWA = "off";
	$msg = "msg4"; // Wrong + OFF
}
}
// close the connection
ftp_close($conn_id);
		
		
if($user_id == '') {
	mysql_query("INSERT INTO user_meta (user_id, weatherapp, filename, username, password) VALUES('$user_id1', '$toggleWA', '$filename', '$username', '$password' ) ") 
	or die(mysql_error());
	}
else {
	mysql_query("UPDATE user_meta SET weatherapp = '$toggleWA', filename = '$filename', username = '$username', password = '$password' WHERE user_id = '$user_id1' ") 
	or die(mysql_error());
}
		echo '<meta http-equiv="refresh" content="0; url=index.php?p=weatherapp&updated=1&msg=' . $msg . '">';
	}
?>

<?php if(isset($_GET['pre']) && $_GET['wahide'] != 1 || $DBfilename == '' && $_GET['wahide'] != 1) { ?>
<iframe src="https://player.vimeo.com/video/111204051?autoplay=1&color=ffffff&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="https://vimeo.com/111204051">Weather App - 3D weather forecast for Dreamoc</a> from <a href="https://vimeo.com/user7628333">RealFiction.com</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
<div style=" position:absolute; margin-top: -330px; margin-left: 470px;"><a href="?p=weatherapp&wahide=1" class="btn_red">X</a></div>
<br>
<a href="http://shop.realfiction.com/index.php/weather-app-1.html" target="_blank" class="btn_blue">Get your weather App integration here</a>
<br><br><hr><br>
<?php } ?>
<form id="weatherapp" name="weatherapp" method="post" action="index.php?p=weatherapp">

              Enable WeatherApp&nbsp;&nbsp;&nbsp;<span title2="This enables / disables Weather App from Scenespire to run on your Dreamocs together with your other content." id="tooltip" class="tooltip">?</span><br><br>
              
              <input type="checkbox" class="slider-v3" id="toggleWA" name="toggleWA" <?php if($WaSet == 'on') { echo 'checked'; } ?> />
              <label for="toggleWA"></label>
              <div style=" margin-left: 155px; margin-top: -27px; position:absolute; color:#9E9E9E;">OFF</div>
              <div style=" margin-left: 315px; margin-top: -27px; position:absolute; color:#9E9E9E;">ON</div>
              <p><br>
              <label for="login">Login details for Weather App</label>
              </p>
    <table width="0" border="0">
                <tbody>
                  <tr>
                    <td width="95">Username:</td>
                    <td width="243"><input type="text" name="username" placeholder="username" size="30" value="<?php echo "$DBusername"; ?>" ></td>
                  </tr>
                  <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="password" size="30" value="<?php echo "$DBpassword"; ?>" ></td>
                  </tr>
                  <tr>
                    <td>Filename:</td>
                    <td><input name="filename" type="text" placeholder="Fx HD3_Villa Hills.mp4" value="<?php echo "$DBfilename"; ?>" size="30" ></td>
                  </tr>
                </tbody>
              </table>
    <p>
      <input name="conf" type="submit" class="btn_green" value="Update">
      <?php if(isset($_GET['updated'])) { ?>
    </p>
    
    <div align='center' style="color:green; padding-top: 10px; font-weight: bold;">
    <?php
	if($_GET['msg'] == 'msg1') {
		echo "Great! You are connected and WeatherApp is Running.<br>It can take up to 10 minutes before the server have downloaded the file."; }
	if($_GET['msg'] == 'msg2') {
		echo "Your login is not matching or your filename is wrong. Try another login / filename."; }
	if($_GET['msg'] == 'msg3') {
		echo "Your login is correct, but WeatherApp is set to off."; }
	if($_GET['msg'] == 'msg4') {
		echo "Your login is not matching. WeatherApp is therefore off."; }
		?>
	</div>
	<?php } ?>
</form>
</div>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>