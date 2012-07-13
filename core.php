<?php
ob_start();
session_start();

// Title mysql alapon
function gettitle() {
$get = "SELECT pagetitle FROM titles WHERE file='$file'";
$file = $_POST['file'];
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
$current_file = $_SERVER['SCRIPT_NAME'];
$http_referer = $_SERVER['HTTP_REFERER'];

// Beléptetett user benttartása
function loggedin() {
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
return true;
} else {
return false;
}
}

/* function ranks() {
$query = "SELECT id FROM users WHERE username='".mysql_real_escape_string($username)."' AND password='".mysql_real_escape_string($password_hash)."'";
if(mysql_num_rows($query)>0) {
$ranks = mysql_fetch_assoc($query);
print_r($_ranks);
if ($ranks['rank'] == 0) {
// User rész
} else if($ranks['rank'] == 1) {
// Csapattag rész
} else if($ranks['rank'] == 2) {
// Admin rész
}
}
} */
?>