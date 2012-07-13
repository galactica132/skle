<?php
require 'mysql.php';
require 'core.php';
require 'functions/bbcode.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<html lang="hu">
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<title><?php print $title00; if (isset($_GET['news'])) print $title01; ?></title>
</head>
<body>
<div id="content">
<div id="header"></div>

<?php
// Menü
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';

// Hírek
$getnews = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 0,5");
while($r=mysql_fetch_array($getnews)){
extract($r);
if (isset ($_GET['news'])) {
?>
<div id="right_panel">
<div class="news_right_panel_top"><?php print htmlspecialchars($title) ?><hr> <?php print htmlspecialchars($date)?> - <?php print htmlspecialchars($user) ?> </div>
<div class="right_panel_content"><?php print bb("$message") ?></div>
<div class="right_panel_footer"></div>
</div>
<?php
} else {
Header ('Location: news.php?news');
}
}
// Footer
include("includes/footer.php");
?>


</div>
</body>
</html>