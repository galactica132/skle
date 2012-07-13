<?php
$mysql_host = "localhost";
$mysql_user = "45102";
$mysql_pass = "vertenex1";
$mysql_db = "45102";

if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db)) {
die(mysql_error());
}
?>