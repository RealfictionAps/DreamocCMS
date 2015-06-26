<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) : 
$userL = htmlentities($_SESSION['username']);
?>
<div align="center" style="width: 500px;">
<h1>Update sound- and light settings</h1>
<div style="position:absolute; margin-top: -35px; margin-left: 480px; margin-right: 20px;">
<a style="margin-left: 15px;" class="btn_blue" id="help" data-fancybox-type="iframe" href="help.php?p=upload">?</a>
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
	<manual_step>75</manual_step>
</spotlight_setting>
<volume_setting>
	<volume_value>20</volume_value>
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
<script type="text/javascript">
$(document).ready(function(){
    var form = $('#soundLight'),
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
<form id="soundLight" name="soundLight" method="post" action="index.php?p=servercontrol">
<div class="wrap">
<!-- how to hide: http://jsfiddle.net/sowdri/8vbyD/5/ -->

              Enable&nbsp;&nbsp;&nbsp;<span title2="This enables / disables the system control of the dreamoc's sound - and light settings. If it is off, all settings are ruled by the physical dreamoc settings." id="tooltip" class="tooltip">?</span><br><br>
              <input type="checkbox" class="slider-v3" id="flipSC" name="flipSC" <?php echo $resetControl; ?> onclick="showMe('div1')" />
              <label for="flipSC"></label>
              <div style=" margin-left: 165px; margin-top: -27px; position:absolute; color:#9E9E9E;">Off</div>
              <div style=" margin-left: 315px; margin-top: -27px; position:absolute; color:#9E9E9E;">On</div>
<br><br>
        <div id="div1" style="display: <?php if($resetControl == 'checked') { echo "block"; } else { echo "none"; } ?>;">
        <label>Sound volume</label>
        <input type="text" id="range" value="<?php echo $volume_value; ?>" name="sliderSound" />
<br><br><br><br>
              Light control&nbsp;&nbsp;&nbsp;<span title2="Here you can set the spotligt level of your Dreamoc. If it's on manual, the slider below decides the light level. If it's on Auto, the right speaker (1kHz) volume decides the light level." class="tooltip">?</span><br><br>
              <input type="checkbox" class="slider-v3" id="flipSO" name="flipSO" <?php echo $spotlightOptions; ?> onclick="showMeLight('div2')" />
              <label for="flipSO"></label>
              <div style=" margin-left: 140px; margin-top: -27px; position:absolute; color:#9E9E9E;">Manual</div>
              <div style=" margin-left: 315px; margin-top: -27px; position:absolute; color:#9E9E9E;">Auto</div>
<br><br><br>
        <div id="div2" style="display: <?php if($spotlightOptions == '') { echo "block"; } else { echo "none"; } ?>;">
        <label>Manual light level</label>
        <input type="text" id="range2" value="<?php echo $manual_step; ?>" name="sliderLight" />
        </div>
</div>    
</div>
<div style="padding-bottom: 50px;">
<script src="js/ion.rangeSlider.js"></script>

<script>
    function showMe (box) {
        
        var chboxs = document.getElementsByName("flipSC");
        var vis = "none";
        for(var i=0;i<chboxs.length;i++) { 
            if(chboxs[i].checked){
             vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }

    function showMeLight (box) {
        
        var chboxs = document.getElementsByName("flipSO");
        var vis = "block";
        for(var i=0;i<chboxs.length;i++) { 
            if(chboxs[i].checked){
             vis = "none";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }
</script>


<script type="text/javascript">	
			
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
			disable: false,
            grid: true
        });

    });
	
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
			disable: false,
            grid: true
        });

    });
</script> 
</div>

<input name="conf" type="submit" class="btn_green" value="Update">
</form>
<?php if(isset($_GET['updated'])) { // vis DONE, hvis der er klikket update ?>
    <div align='center' style="color:green; padding-top: 10px; font-weight: bold;">-- DONE --</div>
<?php } ?>
    <div style="padding-top: 20px;"><a href="index.php?p=hd3conf" class="btn_blue">Next step</a></div>
</div>
<?php
	if(isset($_POST['conf'])) {
		$flipSC = $_POST['flipSC'];
		if($flipSC == 'on') { $flipSC = "enable"; } else { $flipSC = "disable"; }
		$flipSO = $_POST['flipSO'];
		if($flipSO == 'on') { $flipSO = "auto"; } else { $flipSO = "manual"; }

		if(!isset($_POST['sliderLight'])) { 
			$sliderLight = $manual_step;
			$sliderSound = $volume_value; } 
		else { 
			$sliderLight = $_POST['sliderLight'];
			$sliderSound = $_POST['sliderSound']; }
			
		
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