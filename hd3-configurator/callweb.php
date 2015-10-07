<?php 
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) :
$userL = htmlentities($_SESSION['username']);
include_once 'includes/psl-config.php';

// #### Connect to MySql
mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

$result = mysql_query("SELECT * FROM members WHERE username = '$userL'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$serverPass = "{$row['serverpass']}";
}
if(isset($_POST['submit'])){

	/*check for dhcp */
	if($_POST['dhcp_set']=='')
		$dhcp_set = 'on';
		
	/* check for ip */
	if($_POST['ip']!='')
		$ip = $_POST['ip'];

	/* check for ip */
	if($_POST['mask']!='')
		$mask = $_POST['mask'];
	
	/* check for gateway */
	if($_POST['gateway']!='')
		$gateway = $_POST['gateway'];
	
	/* check for ip */
	if($_POST['dns']!='')
		$dns = $_POST['dns'];
		
	/* check for Dns_alt */
	if($_POST['dns_alt']!='')
		$dns_alt = $_POST['dns_alt'];

	
 /*  Auto boot option    */ 
    if($_POST['auto_boot']!=''){
	   $auto_boot =$_POST['auto_boot'];
	 }
	 
	 if($_POST['auto_time']!=''){
	   $auto_time =$_POST['auto_time'];
	 }
	 
	 if($_POST['auto_time_value_hh']!=''){
	   $auto_time_value_hh =$_POST['auto_time_value_hh'];
	   $auto_time_value_mm =$_POST['auto_time_value_mm'];
	   $auto_time_value=$auto_time_value_hh . ":" . $auto_time_value_mm . ":00";
	 }else{
	   $auto_time_value='12:30:00';
	 } 
	 
	 /*if($_POST['protocol_type']!=''){
	   $protocol_type = 'ftp';
	 }else{*/
	   $protocol_type = 'http';
	 //}
	 
	 if($_POST['protocol_url']!=''){
	   $protocol_url = 'cms.dreamoc.com';
	 }else{
	   $protocol_url='cms.dreamoc.com';
	 }
	 /*if($_POST['protocol_port']!=''){
	   $protocol_port = '21';
	 }else{*/
	   $protocol_port='80';
	 //}
	 
	 if($_POST['protocol_id']!=''){
	   $protocol_id = strtolower($userL);
	 }else{
	   $protocol_id = strtolower($userL);
	 } 
	 if($_POST['protocol_pw']!=''){
	   $protocol_pw = $serverPass;
	 }else{
	   $protocol_pw = $serverPass;
	 }
	
	/*if($_POST['protocol_path']!=''){
	   $protocol_path ="/";
	 }else{*/
	   $protocol_path="/users/$userL/";
	 //}
	 
	 if($_POST['ntp_options']!=''){
	   $ntp_options =$_POST['ntp_options'];
	 }else{
	   $ntp_options='on';
	 }
	 if($_POST['ntp_ip']!=''){
	   $ntp_ip =$_POST['ntp_ip'];
	 }else{
	   $ntp_ip='204.152.184.72';
	 } 
	 
	 $tz = $_POST['ntp_timezone'];
	 $tz10 = substr($tz, 0, 1);
	 if ($_POST['ntp_timezone']) {
	   $ntp_timezone_adjust = $tz10;
	 } else {
	   $ntp_timezone_adjust = '+';
	 } 
	 
	 if($_POST['ntp_timezone']!=''){
	   $ntp_timezone = substr($tz, 1, 5);
	 }else{
	   $ntp_timezone='xx:00';
	 }
	if($_POST['autopower_options']!=''){
	   $autopower_options =$_POST['autopower_options'];
	 }else{
	   $autopower_options='12:34:00';
	 }
	 if($_POST['poweron_time_hh']!=''){
	   $poweron_time_hh =$_POST['poweron_time_hh'];
	   $poweron_time_mm =$_POST['poweron_time_mm'];
	   $poweron_time =$poweron_time_hh . ":" . $poweron_time_mm . ":00";
	 }else{
	   $poweron_time='07:30:00';
	 }
	 if($_POST['poweroff_time_hh']!=''){
	   $poweroff_time_hh =$_POST['poweroff_time_hh'];
	   $poweroff_time_mm =$_POST['poweroff_time_mm'];
	   $poweroff_time =$poweroff_time_hh . ":" . $poweroff_time_mm . ":00";
	 }else{
	   $poweroff_time='20:00:00';
	 }
	 if($_POST['spotlight_options']!=''){
	   $spotlight_options =$_POST['spotlight_options'];
	 }else{
	   $spotlight_options='manual';
	 }
	 if($_POST['manual_step']!=''){
	   $manual_step =$_POST['manual_step'];
	 }else{
	   $manual_step='70';
	 } 
	 if($_POST['volume_setting']!=''){
	   $volume_setting =$_POST['volume_setting'];
	 }else{
	   $volume_setting='40';
	 }
		
		
 
 
$output ='<?xml version="1.0" encoding="utf-8" ?>
<setting>
	<network_setting>
		<dhcp_options>'.$dhcp_set.'</dhcp_options> 
		<ip>'.$ip.'</ip> 
		<mask>'.$mask.'</mask>
		<gateway>'.$gateway.'</gateway>
		<dns>'.$dns.'</dns>
		<dns_alt>'.$dns_alt.'</dns_alt>
	</network_setting>
	<download_setting>
	<auto>
		<auto_boot_options>'.$auto_boot.'</auto_boot_options> 
			<auto_time_options>'.$auto_time.'</auto_time_options> 
			<auto_time_value>'.$auto_time_value.'</auto_time_value> 
		</auto>
		<protocol>
			<protocol_type>'.$protocol_type.'</protocol_type>				
			<protocol_url>'.$protocol_url.'</protocol_url>
			<protocol_port>'.$protocol_port.'</protocol_port>
			<protocol_id>'.$protocol_id.'</protocol_id>
			<protocol_pw>'.$protocol_pw.'</protocol_pw> 
			<protocol_path>'.$protocol_path.'</protocol_path> 
		</protocol>
	</download_setting>
	<ntp_setting>
		<ntp_options>'.$ntp_options.'</ntp_options>

		<ntp_ip>'.$ntp_ip.'</ntp_ip>
	  <ntp_timezone_adjust>'.$ntp_timezone_adjust.'</ntp_timezone_adjust> 
		<ntp_timezone>'.$ntp_timezone.'</ntp_timezone>
	</ntp_setting>
	<autopower_setting>
		<autopower_options>'.$autopower_options.'</autopower_options> 
		<poweron_time>'.$poweron_time.'</poweron_time>
		<poweroff_time>'.$poweroff_time.'</poweroff_time> 
	</autopower_setting>
	<spotlight_setting>
		<spotlight_options>'.$spotlight_options.'</spotlight_options>
		<manual_step>'.$manual_step.'</manual_step>
	</spotlight_setting>
	<volume_setting>
		<volume_value>'.$volume_setting.'</volume_value>
	</volume_setting>
</setting>';


file_put_contents('config.xml',$output);
//header('location:index.php?mode=export');
 header('Content-Type: application/xml;');
 header('Content-Disposition: attachment; filename=config.xml;');
 
// readfile('config.xml');
header('location:../?p=hd3conf&mode=export');

}  ?>
<?php endif; ?>