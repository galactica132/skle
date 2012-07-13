<?php
// Belépés
?>
<div id="left_panel">
<div class="left_panel_top"><?php
if (loggedin()) {
print 'Felhasználói panel';
} else {
print 'Bejelentkezés';
}
?></div>
<div class="left_panel_content">
<?php
if (loggedin()) {
echo '<a href="user.php?user_id='.$_SESSION['user_id'].'">Profilom</a><br><a href="logout.php">Kilépés</a>';
} else {
if (isset($_POST['login'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = md5("De98W6R8D3W97PL".$password."10EGfTNbvNvs5sp");

$query = "SELECT id FROM users WHERE username='".mysql_real_escape_string($username)."' AND password='".mysql_real_escape_string($password_hash)."'";
if ($query_run = mysql_query($query)) {
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows == 0) {
echo '<div class="error">Helytelen adatok!</div>';
} else if ($query_num_rows == 1) {
$user_id = mysql_result($query_run, 0, 'id');
$_SESSION['user_id'] = $user_id;
header('Location: index.php');
}
}
}
?>

<form action="" method="POST">
<center>
Felhasználónév:<br><input type="text" name="username"><br>Jelszó:<br>
<input type="password" name="password"><br>
<input type="submit" name="login" value="Belépés"><br>
[ <a href="register.php?user">regisztráció</a> | <a href="register.php?forgetpass">elfelejtett jelszó</a> ]
</center></form>
<?php
}
?>
</div>
<div class="left_panel_footer"></div>
<div style="clear:both;"></div>
</div>
<?php
// Másik panel
?>
<div id="left_panel">
<div class="left_panel_top">asd</div>
<div class="left_panel_content">asd</div>
<div class="left_panel_footer"></div>
</div>