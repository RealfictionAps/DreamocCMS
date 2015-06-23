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
<a class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=upload">?</a>
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
            return 'You have made changes to your settings. Are you sure you want to leave?'
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
	$filename = "{$row2['filename']}"; 
	}
?>
<form id="weatherapp" name="weatherapp" method="post" action="index.php?p=weatherapp">

              Enable&nbsp;&nbsp;&nbsp;<span title2="This enables / disables Weather App from Scenespire to run on your Dreamocs together with your other content." id="tooltip" class="tooltip">?</span><br><br>
              
              <input type="checkbox" class="slider-v3" id="toggleWA" name="toggleWA" <?php if($WaSet == 'on') { echo 'checked'; } ?> />
              <label for="toggleWA"></label>
              <div style=" margin-left: 165px; margin-top: -27px; position:absolute; color:#9E9E9E;">Off</div>
              <div style=" margin-left: 315px; margin-top: -27px; position:absolute; color:#9E9E9E;">On</div>
              <br><br>
              <label for="login">Login details for Weather App</label><br>
              <input type="text" name="username" placeholder="username" size="30" value="<?php echo "$DBusername"; ?>" > - 
              <input type="password" name="password" placeholder="password" size="30" value="<?php echo "$DBpassword"; ?>" ><br><br>
              <input type="text" name="filename" placeholder="Fx HD3_Villa Hills.mp4" value="<?php echo "$filename"; ?>" >

<br><br><br>
<input name="conf" type="submit" class="btn_green" value="Update">
<?php if(isset($_GET['updated'])) { ?>
    <div align='center' style="color:green; padding-top: 10px; font-weight: bold;">-- DONE. --<br>It can cate up to 10 minutes till your Dreamoc is updated. But chill, take a cup of coffee, this is done quite automatically, no worries.</div>
	<?php } ?>
</form>
</div>

<?php
	if(!empty($_POST)) { // Hvis der er indsendt weather app

		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$toggleWA = $_POST['toggleWA'];
		$filename = $_POST['filename'];
		if($toggleWA == 'on') { $toggleWA = "on"; } else { $toggleWA = "off"; }
		
if($user_id == '') {
	mysql_query("INSERT INTO user_meta (user_id, weatherapp, filename, username, password) VALUES('$user_id1', '$toggleWA', '$filename', '$username', '$password' ) ") 
	or die(mysql_error());
	}
else {
	mysql_query("UPDATE user_meta SET weatherapp = '$toggleWA', filename = '$filename', username = '$username', password = '$password' WHERE user_id = '$user_id1' ") 
	or die(mysql_error());
}
		echo '<meta http-equiv="refresh" content="0; url=index.php?p=weatherapp&updated=1">';
	}
?>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>