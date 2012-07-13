<?php
if(!isset($_SESSION['logged'])) {
header("Location: index.php");
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Anisekai - Adminisztrációs főoldal</title>
<link href="../css/style_admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="content">
<div id="header">
<h1>Adminisztrációs főoldal</h1>
</div>
<div id="col_1">
<center>
<a href="add_news.php">Új hír hozzáadása</a><br>
<a href="add_news.php">Hírek szerkesztése</a><br>
</strong>
</div>
<div id="col_2">
<strong><big>Adminisztrációs hírek / Fejlesztési hírek</big></strong><p>
Ide fogom írni a frissítéseket, fejlesztéseket, amiket megcsináltam.
</div>
<div id="footer">
Verzió: 0.5
</div>
</div>
</body>
</html>