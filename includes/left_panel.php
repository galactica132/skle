<?php
// Bel�p�s
?>
<div id="left_panel">
<div class="left_panel_top"><?php
if (loggedin()) {
print 'Felhaszn�l�i panel';
} else {
print 'Bejelentkez�s';
}
?></div>
<div class="left_panel_content">
<?php
if (loggedin()) {
echo '<a href="user.php?user_id='.$_SESSION['user_id'].'">Profilom</a><br><a href="logout.php">Kil�p�s</a>';
} else {
if (isset(htmlsafechars($_POST['login']))) {
$username = htmlsafechars($_POST['username']);
$password = htmlsafechars($_POST['password']);
$password_hash = md5("De98W6R8D3W97PL".$password."10EGfTNbvNvs5sp");

$query = "SELECT id FROM users WHERE username=".mysqlesc($username)." AND password=".mysqlesc($password_hash);
if ($query_run = mysql_query($query)) {
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows == 0) {
echo '<div class="error">Helytelen adatok!</div>';
} else if ($query_num_rows == 1) {
$user_id = mysql_result($query_run, 0, 'id');
$_SESSION['user_id'] = (int)$user_id;
header('Location: index.php');
}
}
}
?>

<form action="" method="POST">
<center>
Felhaszn�l�n�v:<br><input type="text" name="username"><br>Jelsz�:<br>
<input type="password" name="password"><br>
<input type="submit" name="login" value="Bel�p�s"><br>
[ <a href="register.php?user">regisztr�ci�</a> | <a href="register.php?forgetpass">elfelejtett jelsz�</a> ]
</center></form>
<?php
}
?>
</div>
<div class="left_panel_footer"></div>
<div style="clear:both;"></div>
</div>
<?php
// M�sik panel
?>
<div id="left_panel">
<div class="left_panel_top">asd</div>
<div class="left_panel_content">asd</div>
<div class="left_panel_footer"></div>
</div>