<?php if (login_check($mysqli) == true) : ?>

<link rel="stylesheet" type="text/css" href="hd3-configurator/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="hd3-configurator/css/style.css">
<script src="hd3-configurator/js/function.js"></script>



<div align="left" style="padding:30px;">
<form action="hd3-configurator/callweb.php" method="post" name="formdchp" id="formdchp">

<div style="font-size: 18px; margin-left: -10px; margin-bottom: 10px; color:#606060;">1: Choose Dreamoc Location</div>
	
	<div class="block">        
      <select style="font-size: 24px; width:88%;" name="ntp_timezone" id="ntp_timezone">
      <option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
      <option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
      <option value="-10:00">(GMT -10:00) Hawaii</option>
      <option value="-09:00">(GMT -9:00) Alaska</option>
      <option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
      <option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
      <option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
      <option value="-05:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
      <option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
      <option value="-03:50">(GMT -3:30) Newfoundland</option>
      <option value="-03:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
      <option value="-02:00">(GMT -2:00) Mid-Atlantic</option>
      <option value="-01:00">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
      <option value="00:00">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
      <option selected value="+01:00">(GMT +1:00 hour) Berlin, Brussels, Copenhagen, Madrid, Paris</option>
      <option value="+02:00">(GMT +2:00) Kaliningrad, South Africa</option>
      <option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St: Petersburg</option>
      <option value="+03:50">(GMT +3:30) Tehran</option>
      <option value="+04:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
      <option value="+04:50">(GMT +4:30) Kabul</option>
      <option value="+05:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
      <option value="+05:50">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
      <option value="+05:75">(GMT +5:45) Kathmandu</option>
      <option value="+06:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
      <option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
      <option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
      <option value="+09:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
      <option value="+09:50">(GMT +9:30) Adelaide, Darwin</option>
      <option value="+10:00">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
      <option value="+11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
      <option value="+12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
</select>
		 <span title='ntp_timezone : timezone value, the range is from 00:00 to 13:00 (hh:mm)' class="masterTooltip">?</span>
	</div>

   <div style="font-size: 18px; margin-left: -10px; margin-bottom: 10px; margin-top: 40px; color:#606060;">2: Timer setting</div>
   	<div class="block">
		<label>Update content on power up:</label>
		<input name="auto_boot" size="30" type="radio"  checked="checked" value="on" ><span>ON</span>
		<input name="auto_boot" size="30" type="radio" value="off"  id="dhcp_set"><span>OFF</span>
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
		<input class="btn" style="float:right;" value="Compose for SD Card" type="submit" name="submit" id="Send">
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



</div>	  
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>