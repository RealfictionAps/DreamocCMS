<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : 
$userL = htmlentities($_SESSION['username']);
?>
<div align="center" style="width: 500px;">
<h1>Update light- and sound settings</h1>
<br><br>
<?php
$xmlf = "$dir/$userL/server_control_dreamoc_config.xml";

if (!file_exists($xmlf)) {
	$content = "<?xml version='1.0' encoding='utf-8' ?>
<server_setting>
<reset_setting>
	<reset_control>enable</reset_control>
</reset_setting>
<spotlight_setting>
	<spotlight_options>manual</spotlight_options>
	<manual_step>80</manual_step>
</spotlight_setting>
<volume_setting>
	<volume_value>50</volume_value>
</volume_setting>
</server_setting>";
	$fil = fopen("$dir/$userL/server_control_dreamoc_config.xml", "w"); //Åben tekstfilen hvor antallet af hits gemmes i
	fwrite($fil, $content); //Skriv content til filen.
	fclose($fil); //Luk filen
} 

$xml = simplexml_load_file("$xmlf") or die("Error: Cannot create object");

$reset_control = $xml->reset_setting[0]->reset_control;
$spotlight_options = $xml->spotlight_setting[0]->spotlight_options;
$manual_step = $xml->spotlight_setting[0]->manual_step;
$volume_value = $xml->volume_setting[0]->volume_value;

//echo "$reset_control - $spotlight_options - $manual_step - $volume_value";

	
	if($reset_control == 'enable') { $resetControl = 'checked'; }
	if($spotlight_options == 'auto') { $spotlightOptions = 'checked'; }

?>

<form id="1" name="1" method="post" action="servercontrol.php">
<div class="wrap">
              Reset control:
              <input type="checkbox" class="slider-v3" id="flipSC" name="flipSC" <?php echo $resetControl; ?> />
              <label for="flipSC"></label>
<br><br>
              Spotlight options:
              <input type="checkbox" class="slider-v3" id="flipSO" name="flipSO" <?php echo $spotlightOptions; ?> />
              <label for="flipSO"></label>
</div>
<div style="clear: both; padding-top: 50px;"></div>
<div style="padding-bottom: 50px;">
	
        <label>Sound volume</label><br><br>
        <input type="text" id="range" value="<?php echo $volume_value; ?>" name="sliderSound" />
		<br><br>
        <label>Spotlight level</label><br><br>
        <input type="text" id="range2" value="<?php echo $manual_step; ?>" name="sliderLight" />


<script src="js/ion.rangeSlider.js"></script>
<script>

    $(function () {

        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 100,
            from: 0,
            to: 100,
            type: 'single',
            step: 1,
            prefix: "",
            grid: true
        });

    });
</script>
<script>

    $(function () {

        $("#range2").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 100,
            from: 0,
            to: 100,
            type: 'single',
            step: 1,
            prefix: "",
            grid: true
        });

    });
</script>
</div>

        <input name="conf" type="submit" class="btn" value="Opdater">
<?php
	if(isset($_GET['updated'])) {
		echo "<div align='center' style='color:green; padding-top: 10px; font-weight: bold;'>-- DONE --</div>";
	}
?>
</form>
</div>
<?php
	if(isset($_POST['conf'])) { // #### Åben en brugers kort, hvis det er blevet spærret
		$flipSC = $_POST['flipSC'];
		if($flipSC == 'on') { $flipSC = "enable"; } else { $flipSC = "disable"; }
		$flipSO = $_POST['flipSO'];
		if($flipSO == 'on') { $flipSO = "auto"; } else { $flipSO = "manual"; }
		$sliderLight = $_POST['sliderLight'];
		$sliderSound = $_POST['sliderSound'];
		
		$content = "<?xml version='1.0' encoding='utf-8' ?>
<server_setting>
	<reset_setting>
		<reset_control>$flipSC</reset_control>
	</reset_setting>
	<spotlight_setting>
		<spotlight_options>$flipSO</spotlight_options>
		<manual_step>$sliderLight</manual_step>
	</spotlight_setting>
	<volume_setting>
		<volume_value>$sliderSound</volume_value>
	</volume_setting>
</server_setting>";
		$fil = fopen("$dir/$userL/server_control_dreamoc_config.xml", "w"); //Åben tekstfilen hvor antallet af hits gemmes i
		fwrite($fil, $content); //Skriv content til filen.
		fclose($fil); //Luk filen
		
		echo '<meta http-equiv="refresh" content="0; url=index.php?p=servercontrol&updated=1">';
		//echo "$flipSC - $flipSO || $sliderSound - $sliderLight";
	}
?>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>