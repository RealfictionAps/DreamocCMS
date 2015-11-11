<?php if (login_check($mysqli) == true) : ?>

<link rel="stylesheet" type="text/css" href="hd3-configurator/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="hd3-configurator/css/style.css">
<script src="hd3-configurator/js/function.js"></script>



<div align="left" style="padding:30px;">
<form action="hd3-configurator/callweb.php" method="post" name="formdchp" id="formdchp">

<div style="margin-left: -10px; margin-bottom: 10px; color:#606060;">1: Choose Dreamoc Location</div>
<?php
/**
 * Timezones list with GMT offset
 *
 * @return array
 * @link http://stackoverflow.com/a/9328760
 */
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
?>	
	<div class="block">        
  <select name="ntp_timezone" id="ntp_timezone" style="font-family: 'Courier New', Courier, monospace; width: 430px;">
    <option value="0">Please, select timezone</option>
    <?php foreach(tz_list() as $t) { ?>
      <?php
    if($AutofindLocation == 'on') {
		require_once('geoplugin.class/geoplugin.class.php');
		$geoplugin = new geoPlugin();
		$geoplugin->locate();
	
		$continent_short = "{$geoplugin->continentCode}";
		$healthy = array("EU", "AU", "US");
		$yummy   = array("Europe", "Australia", "America");
		$continent = str_replace($healthy, $yummy, $continent_short);
		$place = "$continent/{$geoplugin->city}";
	}
	if($AutofindLocation == 'off' || 0 === strpos($place, '/')) {
		$place = $defaultLocation;
	}
?>
      <option <?php if("$place" == $t['zone']) { echo "selected"; } ?> value="<?php $val = str_replace("UTC/GMT ", "", $t['diff_from_GMT']); echo $val;  ?>">
        <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
      </option>
    <?php } ?>
  </select>
		 <span title='Choose the timezone of where your Dreamoc is placed physically.' class="masterTooltip">?</span>
	</div>

   <div style="margin-left: -10px; margin-bottom: 10px; margin-top: 40px; color:#606060;">2: Timer setting</div>
   	<div class="block">
		<label>Update content on power up:</label>
		<input name="auto_boot" size="30" type="radio"  checked="checked" value="on" ><span>ON</span>
		<input name="auto_boot" size="30" type="radio" value="off"  id="dhcp_set"><span>OFF</span>
		<span title='Auto Boot lets you decide if the content should be updated when you turn on your Dreamoc (ON), or if it should only update content on a specific time (OFF).' class="masterTooltip">?</span>
	</div>

<br>
	<!-- <div class="block">
		<label>Daily content update time:</label>
		<input name="auto_time" id="auto_time1" size="30" type="radio" value="on" ><span>On</span>
		<input name="auto_time" id="auto_time2" size="30" type="radio" checked="checked" value="off" id="dhcp_set"><span>Off</span>
			<span title='auto_time_options : 1."on" when time is up, it will start to download 2."off" when time is up, it will not start to download' class="masterTooltip">?</span>
	</div> -->

	<div class="block">
		<input type="hidden" name="auto_time" value="on">
        <label>Daily content update time:</label>
		hh: <select name="auto_time_value_hh">
        <?php
			for ($i = 0; $i <= 23; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
        mm: <select name="auto_time_value_mm">
        <?php
			for ($i = 0; $i <= 59; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
		<span title='The one time a day, where your dreamoc seeks if there should be new content on the server - and then download it. Range can be set from 00:00:00 to 23:59:59 (hh:mm:ss).' class="masterTooltip">?</span>
	</div>	
	
	
	<input name="protocol_type" value="ftp" type="hidden" />
    <input name="protocol_url" value="client.dreamoc.com" type="hidden" />
    <input name="protocol_port" value="21" type="hidden" />
	<input name="protocol_id"  value="admin" type="hidden" />
    <input name="protocol_pw" value="password" type="hidden" />
        <input type="hidden" name="protocol_path" value="/clientname/region/" /> 

<br>
	<div class="block">
		<label>Daily Dreamoc power schedule:</label>
		<script type="text/javascript">
      function enable()
      {
		 $("#poweron_time1").removeAttr('disabled');
		 $("#poweron_time2").removeAttr('disabled');
		 $("#poweroff_time1").removeAttr('disabled');
		 $("#poweroff_time2").removeAttr('disabled'); //removes the disabled attribut from the  
                                                //element whose id is 'date_end'
      }
	  function disable()
      {
         $("#poweron_time1").attr('disabled', 'false');
		 $("#poweron_time2").attr('disabled', 'false');
		 $("#poweroff_time1").attr('disabled', 'false');
		 $("#poweroff_time2").attr('disabled', 'false');
      }
	</script>
        <input onClick="enable()" name="autopower_options" id="autopower_options1" size="30"  type="radio"  value="on" ><span>ON</span>
		<input onClick="disable()" name="autopower_options" size="30" id="autopower_options2" checked ="checked" type="radio" value="off" id="dhcp_set"><span>OFF</span>
		 <span title="Should be switched to ON if you want your Dreamoc to automatically power on and off at a specific time a day. It it's OFF, the feature is disabled." class="masterTooltip">?  </span>
	
	</div>
	
	<div class="block">
		<label>Dreamoc power on time:</label>
        hh: <select name="poweron_time_hh" id="poweron_time1" disabled>
        <?php
			for ($i = 0; $i <= 23; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
        mm: <select name="poweron_time_mm" id="poweron_time2" disabled>
        <?php
			for ($i = 0; $i <= 59; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
		<span title='The specific time a day, where the Dreamoc should power ON. Range can be set from 00:00:00 to 23:59:59 (hh:mm:ss).' class="masterTooltip">?</span>
	</div>	
	<div class="block">
		<label>Dreamoc power off time:</label>
         hh: <select name="poweroff_time_hh" id="poweroff_time1" disabled>
        <?php
			for ($i = 0; $i <= 23; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
        mm: <select name="poweroff_time_mm" id="poweroff_time2" disabled>
        <?php
			for ($i = 0; $i <= 59; $i++) {
    		if($i < 10) { $i = "0" . $i; }
			echo "<option value='$i'>$i</option>";
			}
			?>
        </select> 
		<span title='The specific time a day, where the Dreamoc should power OFF. Range can be set from 00:00:00 to 23:59:59 (hh:mm:ss).' class="masterTooltip">?</span>
	</div>
	
	
	<div class="block" style="width:300px; margin-bottom:70px;">
		<input class="btn_green" style="float:right;" value="Compose key for SD Card" type="submit" name="submit" id="Send">
	</div>
</form>


<?php if(isset($_GET['mode'])) { ?>
<script>
	$.fancybox({
    padding : 0,
	scrolling : 'no',
    href: 'hd3-configurator/infodownload.php',	
    type: 'iframe'
});
</script>
<?php } ?>

  
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>