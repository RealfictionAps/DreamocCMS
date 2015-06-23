<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
$userL = htmlentities($_SESSION['username']);

if (login_check($mysqli) == true) : ?>
	
<?php
// Define a destination
$userL = htmlentities($_SESSION['username']);
$targetFolder = "/$dir/$userL"; // Relative to the root and should match the upload folder in the uploader script

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
?>
<?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
    </p>
<?php endif; ?>