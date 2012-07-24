<?php
ob_start();
session_start();
error_reporting(E_ALL);
//added by galactica132
function mysqlesc($x) {
     return "'".mysql_real_escape_string($x)."'";
}

//added by galactica132
//Változók ellenõrzése esetleges html karakterekre vagy xss-re
function htmlsafechars($txt='') {
  $txt = preg_replace("/&(?!#[0-9]+;)(?:amp;)?/s", '&amp;', $txt );
  $txt = str_replace( array("<",">",'"',"'"), array("&lt;", "&gt;", "&quot;", '&#039;'), $txt );
  return $txt;
}

// Title mysql alapon
function gettitle() {
$get = "SELECT pagetitle FROM titles WHERE file=".mysqlesc($file);
$file = htmlsafechars($_POST['file']);
$query = mysql_query($get) or die(mysql_error());
$title = mysql_fetch_array($query);
}

// Title-k beállítása
$title00 = 'AniSekai -';
$title_default = ' Nem létezõ oldal';
$title01 = ' Hírek';
$title02 = ' Regisztráció';
$title03 = ' Elfelejtett jelszó';
$title04 = ' Profil';

// Server változók
$current_file = htmlsafechars($_SERVER['SCRIPT_NAME']);
$http_referer = htmlsafechars($_SERVER['HTTP_HOST']);

// Beléptetett user benttartása
function loggedin() {
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
return true;
} else {
return false;
}
}

//header és footer egyszerûsítve.... by galactica132
function head($title) {
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="hu">
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>'.$title.'</title>
</head>
<body>
<div id="content">
<div id="header"></div>

';
}

function foot() {
echo "</body>
<div class='footer'>
&nbsp; 2012 || Coded by: gala & Kazushi93
</div>
</html>";
}

function reg_hiba($text) {
echo "<hr /><div class='error'>".htmlsafechars($text)."</div><br />
<div align='center'><a href='register.php?user'>Vissza</a></div>";
foot();
exit;
}
?>
