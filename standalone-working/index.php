<?php
$p = $_GET['p'];
if($p == '') { $p = "upload"; }

include('header.php');

?>

<body>
   
    <div class="topbar">
        <div style="float: left; margin-left: 100px;"><img width="400" src="assets/img/logo.png"></div>
        <div style="float: right;">Logged in as: Emil</div>
    </div>
    
    <div class="side bar">
      <ul>
        <li><a href="?p=upload" <?php if($p == 'upload') { echo 'id="document"'; } ?> title="Upload & manage content"><span class="fontawesome-cloud-upload"></span></a></li>
        <li><a href="?p=servercontrol" <?php if($p == 'servercontrol') { echo 'id="document"'; } ?> title="Settings"><span class="fontawesome-tasks"></span></a></li>
        <li><a href="?p=hd3conf" <?php if($p == 'hd3conf') { echo 'id="document"'; } ?> title="Download configuration file"><span class="fontawesome-magnet"></span></a></li>
      </ul>
    </div>
            <div style="position:absolute; margin-bottom: 10px;	bottom:0; margin-left: 0px; margin-right: 5px; color:#fff; font-size:10px;";>
            GNU Licenses
            <br>
            <a href="http://www.uploadify.com" target="_blank">Uplodify</a>
            <br>
            <a href="https://github.com/peredurabefrog/phpSecureLogin.git" target="_blank">phpSecureLogin</a>
          </div>
    <div class="newPostContent">
      <!-- <h1>Add New Post</h1>
      <a href="#12" class="btn disabled">save draft</a><a href="#14" class="btn">publish</a> -->
      <?php include($p . ".php"); ?>
  </div>

</body>
</html>

</body>

</html>