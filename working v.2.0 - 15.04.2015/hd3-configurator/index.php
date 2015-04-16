<?php if (login_check($mysqli) == true) : ?>

<link rel="stylesheet" type="text/css" href="hd3-configurator/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="hd3-configurator/css/style.css">
<script src="hd3-configurator/js/function.js"></script>

<div align="left" style="padding:30px;">
<form action="hd3-configurator/callweb.php" method="post" name="formdchp" id="formdchp">

	<div class="block">
		<label>Auto Boot </label>
		<input name="auto_boot" size="30" type="radio"  checked="checked" value="on" ><span>On</span>
		<input name="auto_boot" size="30" type="radio" value="off"  id="dhcp_set"><span>Off</span>
		<span title='auto_boot_options : 1."on" when system boot, it will start to download 2."off" when system boot, it will not start to download ' class="masterTooltip">?</span>
	</div>

	<div class="block">
		<label>Auto Time  </label>
		<input name="auto_time" id="auto_time1" size="30" type="radio"  value="on" ><span>On</span>
		<input name="auto_time" id="auto_time2" size="30" type="radio" checked="checked" value="off" id="dhcp_set"><span>Off</span>
			<span title='auto_time_options : 1."on" when time is up, it will start to download 2."off" when time is up, it will not start to download' class="masterTooltip">?</span>
	</div>

	<div class="block">
		<label>Auto Time Value </label>
		<input name="auto_time_value" class="" id="auto_time_value" size="30" value="12:30:00" type="text"> 
		<span title='auto_time_value : For schedule download time setting, the time range is from 00:00:00 to 23:59:59(hh:mm:ss)' class="masterTooltip">?</span>
	</div>	
	
	
	<input name="protocol_url" value="client.dreamoc.com" type="hidden" />
    <input name="protocol_port" value="21" type="hidden" />
	<input name="protocol_id"  value="admin" type="hidden" />
    <input name="protocol_pw" value="password" type="hidden" />
        <input type="hidden" name="protocol_path" value="/clientname/region/" /> 
	
	<div class="block">
		<label>NTP  </label>
		<input name="ntp_options"  id="ntp_options1" size="30" type="radio"  value="on" checked ="checked" ><span>ON</span>
		<input name="ntp_options" size="30" type="radio" value="off"  id="ntp_options2"><span>OFF</span>
		<span title='ntp_options Network Time Protocol : 1. "on" Get current time information from ntp 2. "off" Disable the feature' class="masterTooltip">?</span>
	</div>
	
	<div class="block">
		<label>NTP IP</label>
		<input name="ntp_ip" id="ntp_ip" size="30" type="text" value="204.152.184.72">
	   <span title='ntp_ip : ntp ip address' class="masterTooltip">?</span>
		
	</div>	
	
	
	
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
	
	
	
	<div class="block">
		<label>Auto Power </label>
		<input name="autopower_options" id="autopower_options1" size="30"  type="radio"  value="on" ><span>ON</span>
		<input name="autopower_options" size="30" id="autopower_options2" checked ="checked" type="radio" value="off"  id="dhcp_set"><span>OFF</span>
		 <span title='autopower_options : 1. "on" System will be auto power on/off when power on/off time is up 2. "off" Disable the feature' class="masterTooltip">?  </span>
	
	</div>
	
	<div class="block">
		<label>Power On Time</label>
		<input name="poweron_time" id="poweron_time" size="30" value="07:30:00" type="text"> 
		<span title='poweron_time : The time range is from 00:00:00 to 23:59:59 (hh:mm:ss)' class="masterTooltip">?</span>
	</div>	
	<div class="block">
		<label>Power Off Time</label>
		<input name="poweroff_time" id="poweroff_time" size="30" value="20:00:00" type="text"> 
		<span title='poweroff_time : The time range is from 00:00:00 to 23:59:59 (hh:mm:ss)' class="masterTooltip">?</span>
	</div>
	
	<div class="block">
		<label>Spotlight Options</label>
		<input name="spotlight_options" id="spotlight_options1" size="30"  type="radio"  value="manual" checked ="checked" ><span>Manual</span>
		<input name="spotlight_options" id="spotlight_options2" size="30" type="radio" value="auto"  id="dhcp_set"><span>Auto</span>	
		 <span title='spotlight_options : 1. "manual" User control the spotlight setting 2. "auto" The spotlight mode will enter audio mode' class="masterTooltip">?  </span>
	</div>	
	<div class="block">
		<label>Spotlight Manual Step</label>
		<input name="manual_step"  size="30" id="manual_step" value="75" type="text">
		<span title='manual_step : The value range is from 0 to 100' class="masterTooltip">?</span>
	</div>
	
	<div class="block">
		<label>Volume Setting</label>
		<input id="volume_setting" name="volume_setting" size="30" value="20"  type="text"> 
		 <span title='volume_setting : The value range is from 0 to 100' class="masterTooltip">?</span>
	</div>	
	<div class="block" style="width:300px;margin-bottom:70px">
		<input class="btn" style="float:right;" value="Export" type="submit" onclick="return submit_form()" name="submit" id="Send">
	</div>
</form>
</div>	  
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>