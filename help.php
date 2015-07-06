<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<style>
body {
	margin: 0px;
}
</style>
</head>

<body>
<?php
$helppage = $_GET['p'];
?>
<?php if($helppage == 'test' || $helppage == "upload") { ?>
<h1 style="text-align: center">Get started </h1>
<ol>
  <li>The first step is the chose the videos, you want to upload to your Dreamoc(s).</li>
  <li>Hit the &ldquo;UPLOAD FILES&rdquo; button to choose a file from your local computer, that you want to upload to the Dreamoc.<br>
    You can chose between these formats: WMV, MOV, AVI, MP4, with codecs: WMV, MP4, AVI, MPEG1/2/4, H.264 and VC-1. (Macimum of 100 mb pr. uploaded file)</li>
  <li>When &ldquo;Open&rdquo; is selected in the dialougebox,, your selected files are being uploaded. If your upload speed, in relation to the size of the uploading file, is slower than the servers responsetime of approximately 5 minutes, the file can not be uploaded.</li>
  <li>After the upload is done, you&rsquo;ll see a green message underneath the &ldquo;UPLOAD FILES&rdquo; button, that says: &ldquo;Your Dreamocs are updated&rdquo; – then you are done. And you can click &ldquo;Next&rdquo;.</li>
</ol>
<div align="center">
<iframe src="https://player.vimeo.com/video/132076224" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<br><br>
<div align="center">If you still are in doubt, please <a href="mailto:support@realfiction.com">contact us here</a>.</div>
<?php } ?>

<?php if($helppage == 'test' || $helppage == "servercontrol") { ?>
<h1 style="text-align: center">Sound- and light settings</h1>
The sound- and light settings gives you the opportunities to control how loud the dreamoc speakers should play and how much artificial light the LED in the Dreamoc should apply.
<ol>
  <li>You can control it, the setting is enabled (On). If it’s disabled (Off), the Dreamoc is set to the default settings (20% sound and 75% light).</li>
  <li>To change the sound volume, drag the first horizontal slider up or down, to increase or decrease the speaker volume.</li>
  <li>To change the light level, drag the second horizontal slider up or down, to increase or decrease the light level. </li>
  <li>The Dreamocs has an option to make the right speaker control the LED light level with the volume of a 1kHz tone. This option can be chosen if you set the “Light control” switch to “Auto”. Learn <a href="http://www.realfiction.com/features/light-control/" target="_blank">how to use the light control here</a>.</li>
</ol>
<div align="center">
<iframe src="https://player.vimeo.com/video/132078506" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<br><br>
<div align="center">If you still are in doubt, please <a href="mailto:support@realfiction.com">contact us here</a>.</div>
<?php } ?>

<?php if($helppage == 'test' || $helppage == "hd3conf") { ?>
<h1 style="text-align: center">Dreamoc SD-key Configurator</h1>
The Dreamoc SD Configurator, lets you easily create the config-file, that connects your Dreamoc(s) to your Dreamoc CMS server. Without this file, your Dreamoc can’t read the content, that you have uploaded here.<br>
<ol>
  <li>The first very important step is to tell your Dreamoc(s) where they are located, so the time is correct. You do that by choosing the City in the select menu under “1. Choose Dreamoc Location”.</li>
  <li>You can ignore step 2, if you just want your Dreamoc to run 24/7 and update at midnight. This is default.<br>
  </li>
</ol>
<p>Now, under step 2 “Timer setting”, you have the opportunities to plan when your content are being downloaded to your “Dreamoc(s) and when to put your Dreamoc(s) on sleep mode.</p>
<ol>
  <li>You can choose if your Dreamoc(s) should update content on power up or not</li>
  <li>You can choose the exact hour and minute, relative to your Dreamoc’s Location.</li>
  <li>If “Daily Dreamoc power schedule” is set to “ON”, you can choose when the Dreamoc should go to sleep and when to power up again.</li>
</ol>
<p>When you are done, you click on “Compose for SD card”, and a dialogue box will disappear, explaining you how to copy the downloaded file to your SD card.</p>
<div align="center">
  <iframe src="https://player.vimeo.com/video/132087462" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<h3>Different locations</h3>
<p>If you have Dreamocs located in different timezones, you can create an individual config-file for every different location. Just make sure that on the SD card, they are all named exactly “config.xml”.</p>
<h3>Working on a Mac</h3>
<p>It can be a good idea to erase your SD card before copying  the config-file onto it.  Macintosh systems sometimes seems to create hidden trash files on inserted Volumes, that conflicts with the Dreamoc. Do complete delete, chosing filesystem FAT32, and copy the config-file afterwoods. Remember to eject the SD card correctly.</p>
<p><br>
</p>
<div align="center">If you still are in doubt, please <a href="mailto:support@realfiction.com">contact us here</a>.</div>
<?php } ?>

<?php if($helppage == 'test' || $helppage == "weatherapp") { ?>
<h1 style="text-align: center">WeatherApp integration</h1>
<p>The WeatherApp is a great way to make your Dreamoc(s) come to life. By presenting local up-to-date weather forecasts, your Dreamoc content is always relevant. In order to make it work with the Dreamoc CMS, you need to create an account here (http://shop.realfiction.com/index.php/weather-app-1.html). </p>
<ol>
  <li>Then you only need to copy tour username, password and forecast-filename into the tree fields.</li>
  <li>You can store your login informations while you decide not to use the WeatherApp on this Dreamoc CMS, by setting the “Enable WeatherApp” to “OFF”</li>
  <li>If you want the WeatherApp to be integrated on your Dreamoc CMS, set the “Enable WeatherApp” to “ON”.</li>
</ol>
<p>NB: It might take up to 10 minutes, before changes will take effect.</p>
<div align="center">
  <iframe src="https://player.vimeo.com/video/111204051" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  <br>
<br>
</div>
<div align="center">If you still are in doubt, please <a href="mailto:support@realfiction.com">contact us here</a>.</div>
<?php } ?>
</body>
</html>