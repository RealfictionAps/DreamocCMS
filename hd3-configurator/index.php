<?php if (login_check($mysqli) == true) : ?>

<link rel="stylesheet" type="text/css" href="hd3-configurator/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="hd3-configurator/css/style.css">
<script src="hd3-configurator/js/function.js"></script>



<div align="left" style="padding:30px;">
<form action="hd3-configurator/callweb.php" method="post" name="formdchp" id="formdchp">

<div style="font-size: 18px; margin-left: -10px; margin-bottom: 10px; color:#606060;">1: Choose Dreamoc Location</div>
	<div class="block">
		<label>NTP Timezone Adjust  </label>
		<input name="ntp_timezone_adjust" size="30" type="radio" checked ="checked"  value="+" >+
		<input name="ntp_timezone_adjust" size="30" type="radio" value="-"  id="dhcp_set">-
		<input name="ntp_timezone_adjust" size="30" type="radio" value="0"  id="dhcp_set">0
		 <span title='ntp_timezone_adjust : 1. "+" It will plus timezone into current time that get from ntp. 2. "-" It will minus timezone into current time that get from ntp. 3. "0" It will keep current time that get from ntp.' class="masterTooltip">? </span>
	</div>
	
	<div class="block">
		<label>NTP Timezone</label>
		<input name="ntp_timezone" id="ntp_timezone" size="30" type="text" value="02:00">
		 <span title='ntp_timezone : timezone value, the range is from 00:00 to 13:00 (hh:mm)' class="masterTooltip">?</span>
	</div>

   <div style="font-size: 18px; margin-left: -10px; margin-bottom: 10px; margin-top: 40px; color:#606060;">2: Timer setting</div>
   	<div class="block">
		<label>Update content on power up:</label>
		<input name="auto_boot" size="30" type="radio"  checked="checked" value="on" ><span>On</span>
		<input name="auto_boot" size="30" type="radio" value="off"  id="dhcp_set"><span>Off</span>
		<span title='auto_boot_options : 1."on" when system boot, it will start to download 2."off" when system boot, it will not start to download ' class="masterTooltip">?</span>
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
		<input name="auto_time_value" class="" id="auto_time_value1" size="30" value="12:30:00" type="text"> 
		<span title='auto_time_value : For schedule download time setting, the time range is from 00:00:00 to 23:59:59(hh:mm:ss)' class="masterTooltip">?</span>
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
		<input name="autopower_options" id="autopower_options1" size="30"  type="radio"  value="on" ><span>ON</span>
		<input name="autopower_options" size="30" id="autopower_options2" checked ="checked" type="radio" value="off"  id="dhcp_set"><span>OFF</span>
		 <span title='autopower_options : 1. "on" System will be auto power on/off when power on/off time is up 2. "off" Disable the feature' class="masterTooltip">?  </span>
	
	</div>
	
	<div class="block">
		<label>Dreamoc power on time:</label>
		<input name="poweron_time" id="poweron_time" size="30" value="07:30:00" type="text"> 
		<span title='poweron_time : The time range is from 00:00:00 to 23:59:59 (hh:mm:ss)' class="masterTooltip">?</span>
	</div>	
	<div class="block">
		<label>Dreamoc power off time:</label>
		<input name="poweroff_time" id="poweroff_time" size="30" value="20:00:00" type="text"> 
		<span title='poweroff_time : The time range is from 00:00:00 to 23:59:59 (hh:mm:ss)' class="masterTooltip">?</span>
	</div>
	
	
	<div class="block" style="width:300px;margin-bottom:70px">
		<input class="btn" style="float:right;" value="Export to SD Card" type="submit" onclick="return submit_form()" name="submit" id="Send">
	</div>
</form>
<script>
function submit_form() {
    
	$.fancybox.open({
    padding : 0,
	scrolling : 'no',
    href: 'video.php',
    type: 'iframe'
});

}
</script>




</div>	  
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>