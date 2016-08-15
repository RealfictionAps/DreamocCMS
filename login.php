<?php
@ob_start();
session_start();
?>
<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
	
$name = $_GET['name'];
$email = $_GET['email'];
$company = $_GET['company'];
?>
<?php
/**
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
//if($_SERVER['SERVER_NAME'] != "http://cms.dreamoc.com") { header('location: http://cms.dreamoc.com/'); }
include_once 'includes/analytics.php';

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dreamoc Media: Log In</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        <link rel="stylesheet" href="css/style.css" />
        <style type="text/css">
        body,td,th {
	color: #333333;
}
input[type="checkbox"] {
    display:none;
}
input[type="checkbox"] + label span {
    display:inline-block;
    width:30px;
    height:30px;
    margin:-1px 4px 0 0;
    vertical-align:middle;
    background:url(assets/check_radio_sheet.png) left top no-repeat;
    cursor:pointer;
}
input[type="checkbox"]:checked + label span {
    background:url(assets/check_radio_sheet.png) -30px top no-repeat;
}
        </style>
    <meta charset="UTF-8">
    
    <?php
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php } ?>
    </head>
    <body>
<?php if ( $detect->isMobile() ) { ?>
<div style="margin-left: -8px; width:125%; height: 90px; color: white; background-color:#2D3641;">
<?php } else { ?>
<div style="margin: -8px; width:102%; height: 130px; color: white; background-color:#2D3641;">
<?php }  ?>

<?php
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
echo '<div align="center" style="font-size: 20px;">
<a href="login.php"><div style="padding-top: 30px; padding-bottom: 15px;"><img src="assets/img/logo.png" width="240" />
    </div></a>
	</div>';
}
else {
?>    
    <form action="includes/process_login.php" method="post" name="login_form">
    
    <a href="login.php"><div style="float: left; padding-top: 50px; padding-left: 8%;"><img src="assets/img/logo.png" width="240" />
    </div></a>
    
    <div style="float:right; padding-top: 50px; padding-right: 8%; padding-left: 10px;">
    <table border="0">
  <tbody>
    <tr>
      <td><input style=" height:30px; border-radius: 5px;" placeholder="Email Address*" type="text" size="30" name="email" id="email" />
</td>
      <td><input style="height:30px; border-radius: 5px;" placeholder="Password*" type="password" size="30" name="password" id="password" />
</td>
      <td><input type="submit" value="Login" class="btn_green" onclick="formhash(this.form, this.form.password);" /></td>
    </tr>
  </tbody>
</table>

    </div>
    </form>
<?php } ?>
</div>  
    

<?php if ( $detect->isMobile() ) { ?>
<div align="center" style=" margin-left:23%; padding-top: 10px;">
<? } else { ?>
<div align="center" style="padding-top: 50px;">
<?php } ?>

<?php
if($_GET['try'] == 'y') { ?>
<div style="font-size: 24px; color:green; margin-bottom: 10px;">
Congratulation! 
</div>
<div>
Your request has been send. We'll get back to you shortly with your login informations.
</div>
<?php if ( $detect->isMobile() ) { ?>
<br>
OBS: At the moment you cannot use the CMS on a mobile device. Please login from your computer.
<?php } ?>
</div>
<?php } else { ?>
<div style="font-size: 24px; margin-bottom: 10px;">
Don't have an account? Register for FREE 
</div>
<div>
We will send your Dreamoc CMS login details to your submitted email as soon as we've created your account. 
</div>
<?php } ?>
</div>

<table align="center" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top">

<?php if ( $detect->isMobile() ) { ?>
<div style="margin-top: 10px; margin-bottom: 20px; padding: 15px; border-radius: 5px; background-color:#EEEEEE;">
<? } else { ?>
<div style="margin-top: 40px; padding: 20px; border-radius: 5px; background-color:#EEEEEE;">
<?php } ?>
<form action="includes/try.php" method="post" name="login_form">
<table width="0" height="320" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>
      <?php
		  if($_GET['try'] == 'n') {
		  ?>
          <div style="padding-top: 20px; color: red; margin-bottom: 20px;">
          *Something went wrong...<br>You would have to agree with the legal rights and use.
          </div>
          <? } ?>
      Enter your name:<br>
      <input name="name" type="text" id="name" placeholder="Name*" value="<?php echo "$name"; ?>" style="height:40px; border-radius:4px;" size="53" />
      </td>
    </tr>
    <tr>
      <td>
      Enter your email:<br>
      <input name="email" type="text" id="email" placeholder="email*" value="<?php echo "$email"; ?>" style="height:40px; border-radius:4px;" size="53" />
      </td>
    </tr>
    <tr>
      <td>
      Enter your company:<br>
      <input name="company" type="text" id="company" placeholder="Company" value="<?php echo "$company"; ?>" style="height:40px; border-radius:4px;" size="53" />
      </td>
    </tr>
    <tr>
      <td>
    <input type="checkbox" id="c1" name="c1" />
<label for="c1"><span></span>I agree upon <a href="legal.php" target="_blank">legal rights and general use</a>*</label>  
      </td>
    </tr>
  </tbody>
</table>
            <div align="center">
           	  <input type="submit" value="Submit" class="btn_green" onclick="formhash(this.form, this.form.password);" /> 
            </div>
          </form>
                  
                <p>
<?php if (isset($_GET['error'])) { echo '<span class="error">Error Logging In!</span>';	} ?>
				You are currently logged <?php echo $logged ?>. <?php if($logged == 'in') { ?> <a href="includes/logout.php">logout</a> <? } ?>
				</p>
        </div>
               
      </td>
    </tr>
  </tbody>
</table>
    </body>
</html>
