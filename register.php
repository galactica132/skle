<?php
require_once 'mysql.php';
require_once 'core.php';

$title1 = $title00;
if (isset($_GET['user'])) $title = $title1.$title02;
if (isset($_GET['forgetpass'])) $title = $title1.$title03;
if (isset($_GET['akarmi'])) $title = $title1.$title_default;

head($title);
// Menü
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';
// Tartalom
if (!isset($_GET['user']))
{ 
echo "Nem létezõ URL lekérés.";
foot();
exit;
}
if (isset($_GET['user']))
echo '
<div id="right_panel">
<div class="news_right_panel_top">Regisztráció</div>
<div class="right_panel_content">
';
if (loggedin())
reg_hiba("Te már regisztráltál, és beléptél.");
if (isset($_GET['success']))
print '<div class="success"><strong>Gratulálunk,</strong> sikeresen regisztráltad magad oldalunkra!<br>
Most már beléphetsz!</div>';

if ( ($_SERVER['REQUEST_METHOD'] === 'POST') AND (isset($_GET['user'])) ) {
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['email'])) {
$username = htmlsafechars($_POST['username']);
$password = htmlsafechars($_POST['password']);
$password_again = htmlsafechars($_POST['password_again']);
$password_hash = md5("De98W6R8D3W97PL".$password."10EGfTNbvNvs5sp");
$email = htmlsafechars($_POST['email']);

if ( (empty($username)) or (empty($password)) or (empty($password_again)) or (empty($email)) )
reg_hiba("Minden mezõ kitöltése kötelezõ!");

if ($password != $password_again)
reg_hiba("A jelszavak nem egyeznek.");
$query_reg = "SELECT username FROM users WHERE username=".mysqlesc($username);
$query_run_reg = mysql_query($query_reg) or die(mysql_error(__FILE__,__LINE__));
if (mysql_num_rows($query_run_reg) == 1)
reg_hiba("A felhasználónév ".$username." már létezik.</div>");
// Adatok bevitele
if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
reg_hiba("Hibás e-mail cím!");

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
<li>A csillaggal (*) jelölt mezõk kitöltése kötelezõ!</li>
<li>A regisztráció során csak az alapadatok megadása kötelezõ. Bejelentkezés után a profilodban több dolgot is megadhatsz.</li>
<li><strong>A regisztrációval automatikusan elfogadod a szabályzatunkat.</strong></li>
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
<li>A csillaggal (*) jelölt mezõk kitöltése kötelezõ!</li>
<li>A regisztráció során csak az alapadatok megadása kötelezõ. Bejelentkezés után a profilodban több dolgot is megadhatsz.</li>
<li><strong>A regisztrációval automatikusan elfogadod a szabályzatunkat.</strong></li>
</ul>
Felhasználónév:<br><input type="text" name="username" /><br><br>
Jelszó:<br><input type="password" name="password" /><br><br>
Jelszó újra:<br><input type="password" name="password_again" /><br><br>
E-mail:<br><input type="text" name="email" /><br><br>
<input type="submit" name="register" value="Regisztráció" />
</form>';
}
if (isset($_GET['forgetpass'])) {
echo '
<div id="right_panel">
<div class="news_right_panel_top">Jelszóemlékeztetõ</div>
<div class="right_panel_content">
';
echo '
<form action="register.php?forgetpass" method="POST">
Amennyiben elfelejtetted a jelenlegi jelszavadat, itt kérhetsz újat. Csak add meg a regisztrációkor használt e-mail címet, és rendszerünk küld egy új jelszót!
Az eddig használt jelszó el fog veszni.<p>
<center>
<input type="text" name="forgetpass"> <input type="submit" name="forgetpass" value="Küldés">
</form>';

if ( (isset($_GET['forgetpass'])) AND ( $_SERVER['REQUEST_METHOD'] === 'POST' ) ) {
$username = htmlsafechars($_POST['username']);
$read = mysql_query("SELECT * FROM users WHERE username=".mysqlesc($username));
$sor = mysql_num_rows($read);
$rows = mysql_fetch_array($read);
$email = htmlsafechars($rows["email"]);
$password = htmlsafechars($rows["password"]);
if($sor == 1) {
mail($email, "Elfelejtett jelszó", $password);
print 'Jelszavad kiküldtük a címedre';
} else {
print 'Nem sikerült.';
}
}
}
echo '
</div>
<div class="right_panel_footer"></div>
</div>';

foot();
?>