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
if($_SERVER['SERVER_NAME'] != "http://cms.dreamoc.com" && $_SERVER['SERVER_NAME'] != "localhost") { 
header('location: http://cms.dreamoc.com/'); 
}

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
    </head>
    <body>        
        <table align="center" width="480" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top">
                  <div id="suscribe" class="container" style="height: 280px;"> <!-- Suscribe -->
                    <div class="bar title-bar">
                        <h2>Login</h2>
                    </div>
<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
echo '<div align="center" style="font-size: 60px; margin-top: 0px;">You cannot use the DreamocCMS on a mobile device.</div>';
}
else {
?>
<div style="margin: 20px 20px 20px 20px;">
          <form action="includes/process_login.php" method="post" name="login_form">
          <table width="0" height="100" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>E-mail</td>
      <td><input style="font-size: 30px; margin-left: 20px;" type="text" size="20" name="email" id="email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input style="font-size: 30px; margin-left: 20px;" type="password" size="20" name="password" id="password" /></td>
    </tr>
  </tbody>
</table>
          <div style="clear:both;"></div>
            <div align="center">
            	<input type="submit" value="Login" class="btn_green" onclick="formhash(this.form, this.form.password);" /> 
            </div>
          </form>
        
                <p>
<?php if (isset($_GET['error'])) { echo '<span class="error">Error Logging In!</span>';	} ?>
				You are currently logged <?php echo $logged ?>. <?php if($logged == 'in') { ?> <a href="includes/logout.php">logout</a> <? } ?>
				</p>
                </div>
                </div>          
            </div>
      </td>
    </tr>
  </tbody>
</table>
<?php } ?>

    </body>
</html>
