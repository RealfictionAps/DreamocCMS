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
 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true && htmlentities($_SESSION['username']) == "$adminUL") :

include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register a new user</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
		if(empty($error_msg) && isset($_GET['success'])) {
			echo "<div style='color: red; margin: 10px;'>A new user has been created.</div>";
		}
        ?>
        <ul class="ul">
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul class="ul2">
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul> 
<br>
<?php
include('strong-passwords.php');
?>
<br><br>
        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']) . "?success=1&p=" . $_GET['p']; ?>">
            <table width="0" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td height="29" align="left" valign="top">Username:</td>
                  <td align="left" valign="top"><input type='text' name='username' id='username' /></td>
                </tr>
                <tr>
                  <td height="29" align="left" valign="top">Email:</td>
                  <td align="left" valign="top"><input type="text" name="email" id="email" /></td>
                </tr>
                <tr>
                  <td height="45" align="left" valign="top">Server:</td>
                  <td align="left" valign="top"><input type="text" name="serverpass" id="serverpass" /></td>
                </tr>
                <tr>
                  <td height="27" align="left" valign="top">Password:</td>
                  <td align="left" valign="top"><input type="password"
                             name="password" 
                             id="password"/></td>
                </tr>
                <tr>
                  <td height="45" align="left" valign="top">Confirm password:</td>
                  <td align="left" valign="top"><input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /></td>
                </tr>
                <tr>
                  <td align="left" valign="top">&nbsp;</td>
                  <td align="left" valign="top"><input type="button" 
                   value="Register" 
                   onClick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /></td>
                </tr>
              </tbody>
            </table>
    </form>
<hr>
<br>
Tools
        <p><a href="./cron.php" target="_blank">Run cronjob</a></p>
    </body>
</html>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>