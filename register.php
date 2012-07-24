<?php
require 'mysql.php';
require 'core.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<html lang="hu">
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>
<?php print $title00;
if (isset(htmlsafechars($_GET['user']))) print $title02;
if (isset(htmlsafechars($_GET['forgetpass']))) print $title03;
if (isset(htmlsafechars($_GET['akarmi']))) print $title_default;
?>
</title>
</head>
<body>
<div id="content">
<div id="header"></div>

<?php
// Men�
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';

// Tartalom
?>
<div id="right_panel">
<div class="news_right_panel_top">Regisztr�ci�</div>
<div class="right_panel_content">
<?php
if (isset($_GET['user'])) {
if (!loggedin()) {
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['email'])) {
$username = htmlsafechars($_POST['username']);
$password = htmlsafechars($_POST['password']);
$password_again = htmlsafechars($_POST['password_again']);
$password_hash = md5("De98W6R8D3W97PL".$password."10EGfTNbvNvs5sp");
$email = htmlsafechars($_POST['email']);

if (!empty($username) && !empty($password) && !empty($password_again) && !empty($email)) {
if ($password != $password_again) {
echo '<hr><div class="error">A jelszavak nem egyeznek.</div>';
} else {
$query_reg = "SELECT username FROM users WHERE username=".mysqlesc($username);
$query_run_reg = mysql_query($query_reg);
if (mysql_num_rows($query_run_reg) == 1) {
echo '<hr><div class="error">A felhaszn�l�n�v '.$username.' m�r l�tezik.</div>';
} else {
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)) {
// Adatok bevitele
$query_reg = "INSERT INTO users VALUES ('',".mysqlesc($username).",".mysqlesc($password_hash).",".mysqlesc($email).", 0)";
if ($query_run_reg = mysql_query($query_reg)) {
echo 'Sikeres regisztr�ci�';
header('Location: register.php?success');
exit();
} else {
echo '<hr><div class="error">Hiba t�rt�nt a regisztr�ci� k�zben! K�rj�k, pr�b�ld meg �jra p�r perc m�lva.</div>';
}
} else {
print '<div class="error">Hib�s e-mail c�m!</div>';
}
}
}
} else {
echo '<hr><div class="error">Minden mez� kit�lt�se k�telez�!</div>';
}
}
?>
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
Felhaszn�l�n�v:<br><input type="text" name="username" value="<?php echo $username; ?>"><br><br>
Jelsz�:<br><input type="password" name="password"><br><br>
Jelsz� �jra:<br><input type="password" name="password_again"><br><br>
E-mail:<br><input type="text" name="email"value="<?php echo $email; ?>"><br><br>
<input type="submit" name="register" value="Regisztr�ci�">
</form>
<?php
} else if (loggedin()) {
echo 'Te m�r regisztr�lt�l, �s bel�pt�l.';
}
} else if (isset(htmlsafechars($_GET['success']))) {
print '<div class="success"><strong>Gratul�lunk,</strong> sikeresen regisztr�ltad magad oldalunkra!<br>
Most m�r bel�phetsz!</div>';
} else if (isset(htmlsafechars($_GET['forgetpass']))) {
?>
<form action="register.php?forgetpass" method="POST">
Amennyiben elfelejtetted a jelenlegi jelszavadat, itt k�rhetsz �jat. Csak add meg a regisztr�ci�kor haszn�lt e-mail c�met, �s rendszer�nk k�ld egy �j jelsz�t!
Az eddig haszn�lt jelsz� el fog veszni.<p>
<center>
<input type="text" name="forgetpass"> <input type="submit" name="forgetpass" value="K�ld�s">
</form>
<?php
if (isset($forgetpass)) {
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
} else {
print 'Nem l�tez� URL lek�r�s.';
}
?>
</div>
<div class="right_panel_footer"></div>
</div>
<?php
// Footer
include 'includes/footer.php';
?>
</div>
</body>
</html>