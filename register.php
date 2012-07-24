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
// Menü
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';

// Tartalom
?>
<div id="right_panel">
<div class="news_right_panel_top">Regisztráció</div>
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
echo '<hr><div class="error">A felhasználónév '.$username.' már létezik.</div>';
} else {
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)) {
// Adatok bevitele
$query_reg = "INSERT INTO users VALUES ('',".mysqlesc($username).",".mysqlesc($password_hash).",".mysqlesc($email).", 0)";
if ($query_run_reg = mysql_query($query_reg)) {
echo 'Sikeres regisztráció';
header('Location: register.php?success');
exit();
} else {
echo '<hr><div class="error">Hiba történt a regisztráció közben! Kérjük, próbáld meg újra pár perc múlva.</div>';
}
} else {
print '<div class="error">Hibás e-mail cím!</div>';
}
}
}
} else {
echo '<hr><div class="error">Minden mezõ kitöltése kötelezõ!</div>';
}
}
?>
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
Felhasználónév:<br><input type="text" name="username" value="<?php echo $username; ?>"><br><br>
Jelszó:<br><input type="password" name="password"><br><br>
Jelszó újra:<br><input type="password" name="password_again"><br><br>
E-mail:<br><input type="text" name="email"value="<?php echo $email; ?>"><br><br>
<input type="submit" name="register" value="Regisztráció">
</form>
<?php
} else if (loggedin()) {
echo 'Te már regisztráltál, és beléptél.';
}
} else if (isset(htmlsafechars($_GET['success']))) {
print '<div class="success"><strong>Gratulálunk,</strong> sikeresen regisztráltad magad oldalunkra!<br>
Most már beléphetsz!</div>';
} else if (isset(htmlsafechars($_GET['forgetpass']))) {
?>
<form action="register.php?forgetpass" method="POST">
Amennyiben elfelejtetted a jelenlegi jelszavadat, itt kérhetsz újat. Csak add meg a regisztrációkor használt e-mail címet, és rendszerünk küld egy új jelszót!
Az eddig használt jelszó el fog veszni.<p>
<center>
<input type="text" name="forgetpass"> <input type="submit" name="forgetpass" value="Küldés">
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
mail($email, "Elfelejtett jelszó", $password);
print 'Jelszavad kiküldtük a címedre';
} else {
print 'Nem sikerült.';
}
}
} else {
print 'Nem létezõ URL lekérés.';
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