<?php
require 'mysql.php';
require 'core.php';

if (isset($_GET['user_id']) && $_GET['user_id'] != "") {
$user_id = $_GET['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$query = mysql_query ($sql) or die (mysql_error ());
$user_info = mysql_fetch_array ($query);
} else {
header ("Location: index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<html lang="hu">
<head>
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>HTML f�jl</title>
</head>
<body>
<div id="content">
<div id="header"></div>

<?php
// Men�
include 'includes/menu.php';

// Jobb oldali panelek
include 'includes/left_panel.php';

// H�rek
?>
<div id="right_panel">
<div class="news_right_panel_top">Profil</div>
<div class="right_panel_content">
<table>
<tr>
<td><label>Felhaszn�l�neved: </label></td>
<td><?php print ($user_info['username']) ?></td>
</tr>
<tr>
<td><label>Email c�med: </label></td>
<td><?php print ($user_info['email']) ?></td>
</tr>
</table>
</div>
<div class="right_panel_footer"></div>
</div>
<?php
// Footer
include("includes/footer.php");
?>


</div>
</body>
</html>