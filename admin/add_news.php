<?php
if(!isset($_SESSION['logged'])) {
header("Location: index.php");
exit();
}
?>
<title>Adminisztráció - Hír hozzáadása</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<?php
include("../mysql.php");
mysql_query("set names 'utf8'");
extract($_POST);
if(!empty($title)) {
$title = htmlspecialchars($title);
$user = htmlspecialchars($user);
$message = htmlspecialchars($message);
 
$date = date("F j, Y");
$date2 = mktime();
$sql = "INSERT INTO news (id, title, user, message, date) VALUES ('NULL', '$title','$user','$message','$date')";
$query = mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
echo "Hír hozzáadva.";
} else {
?>
<form name="news" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<center>

<h1>Hír hozzáadása</h1>
Egyenlőre nincs lehetőség adminisztrációs hír szerkesztésre, de rajta vagyok! Ugyan így van a törléssel is! Addig csak MySQL-ből lehet ezeket megoldani.

<fieldset>
<legend>Új hír hozzáadása</legend>
<label for="title">Hír címe:</label>
<input type="text" name="title" id="title">
<br>
<label for="user">Hírt írta:</label>
<input type="text" name="user" id="user"><br>
<label for="message">Tartalom:</label>
<script type="text/javascript">
function addSmile(smilekod) {
document.getElementById('text').value = document.getElementById('text').value+smilekod;
}

</script>
<img src="../images/bbcodes/b.jpg" alt="" onclick="addSmile('[b][/b]'); return false;"/>
<img src="../images/bbcodes/b.jpg" alt="" onclick="addSmile('[i][/i]'); return false;"/>
<textarea name="message" id="text" rows="10" cols="30"></textarea>
<br>
<input type="submit" id="Submit" value="Hír kiírása">
</fieldset>
</center>
</form>
<?php
}
?>