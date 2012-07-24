<?php
require_once 'mysql.php';
require_once 'core.php';

$title1 = $title00;
if (isset($_GET['user'])) $title = $title1.$title02;
if (isset($_GET['forgetpass'])) $title = $title1.$title03;
if (isset($_GET['akarmi'])) $title = $title1.$title_default;

head($title);
// Men�
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';
// Tartalom
if (!isset($_GET['user']))
{ 
echo "Nem l�tez� URL lek�r�s.";
foot();
exit;
}
if (isset($_GET['user']))
echo '
<div id="right_panel">
<div class="news_right_panel_top">Regisztr�ci�</div>
<div class="right_panel_content">
';
if (loggedin())
reg_hiba("Te m�r regisztr�lt�l, �s bel�pt�l.");
if (isset($_GET['success']))
print '<div class="success"><strong>Gratul�lunk,</strong> sikeresen regisztr�ltad magad oldalunkra!<br>
Most m�r bel�phetsz!</div>';

if ( ($_SERVER['REQUEST_METHOD'] === 'POST') AND (isset($_GET['user'])) ) {
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['email'])) {
$username = htmlsafechars($_POST['username']);
$password = htmlsafechars($_POST['password']);
$password_again = htmlsafechars($_POST['password_again']);
$password_hash = md5("De98W6R8D3W97PL".$password."10EGfTNbvNvs5sp");
$email = htmlsafechars($_POST['email']);

if ( (empty($username)) or (empty($password)) or (empty($password_again)) or (empty($email)) )
reg_hiba("Minden mez� kit�lt�se k�telez�!");

if ($password != $password_again)
reg_hiba("A jelszavak nem egyeznek.");
$query_reg = "SELECT username FROM users WHERE username=".mysqlesc($username);
$query_run_reg = mysql_query($query_reg) or die(mysql_error(__FILE__,__LINE__));
if (mysql_num_rows($query_run_reg) == 1)
reg_hiba("A felhaszn�l�n�v ".$username." m�r l�tezik.</div>");
// Adatok bevitele
if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
reg_hiba("Hib�s e-mail c�m!");

$query_reg = "INSERT INTO users (username,password,email) VALUES (".mysqlesc($username).",".mysqlesc($password_hash).",".mysqlesc($email).")";
if ($query_run_reg = mysql_query($query_reg)) {
header('Location: register.php?success');
exit();
}
}
}
if (isset($_GET['user'])) {
echo '
<form action="register.php?user" method="POST">

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td colspan="2" rowspan="1">
<li>A csillaggal (*) jel�lt mez�k kit�lt�se k�telez�!</li>
<li>A regisztr�ci� sor�n csak az alapadatok megad�sa k�telez�. Bejelentkez�s ut�n a profilodban t�bb dolgot is megadhatsz.</li>
<li><strong>A regisztr�ci�val automatikusan elfogadod a szab�lyzatunkat.</strong></li>
</td>
</tr>
<tr>
<td>valami</td>
<td>valami</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>
<hr>

<ul>
<li>A csillaggal (*) jel�lt mez�k kit�lt�se k�telez�!</li>
<li>A regisztr�ci� sor�n csak az alapadatok megad�sa k�telez�. Bejelentkez�s ut�n a profilodban t�bb dolgot is megadhatsz.</li>
<li><strong>A regisztr�ci�val automatikusan elfogadod a szab�lyzatunkat.</strong></li>
</ul>
Felhaszn�l�n�v:<br><input type="text" name="username" /><br><br>
Jelsz�:<br><input type="password" name="password" /><br><br>
Jelsz� �jra:<br><input type="password" name="password_again" /><br><br>
E-mail:<br><input type="text" name="email" /><br><br>
<input type="submit" name="register" value="Regisztr�ci�" />
</form>';
}
if (isset($_GET['forgetpass'])) {
echo '
<div id="right_panel">
<div class="news_right_panel_top">Jelsz�eml�keztet�</div>
<div class="right_panel_content">
';
echo '
<form action="register.php?forgetpass" method="POST">
Amennyiben elfelejtetted a jelenlegi jelszavadat, itt k�rhetsz �jat. Csak add meg a regisztr�ci�kor haszn�lt e-mail c�met, �s rendszer�nk k�ld egy �j jelsz�t!
Az eddig haszn�lt jelsz� el fog veszni.<p>
<center>
<input type="text" name="forgetpass"> <input type="submit" name="forgetpass" value="K�ld�s">
</form>';

if ( (isset($_GET['forgetpass'])) AND ( $_SERVER['REQUEST_METHOD'] === 'POST' ) ) {
$username = htmlsafechars($_POST['username']);
$read = mysql_query("SELECT * FROM users WHERE username=".mysqlesc($username));
$sor = mysql_num_rows($read);
$rows = mysql_fetch_array($read);
$email = htmlsafechars($rows["email"]);
$password = htmlsafechars($rows["password"]);
if($sor == 1) {
mail($email, "Elfelejtett jelsz�", $password);
print 'Jelszavad kik�ldt�k a c�medre';
} else {
print 'Nem siker�lt.';
}
}
}
echo '
</div>
<div class="right_panel_footer"></div>
</div>';

foot();
?>