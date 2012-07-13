<center>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<title>Anisekai - Adminisztráció</title>
<?php
session_start();
ob_start();

$nev = "12";
$jelszo = "122";

if(isset($_POST["login"])) {
    $name = $_POST["nev"];
        $pass = $_POST["jelszo"];
       
        if ($nev == $name && $jelszo == $pass){
            $_SESSION['logged'] = true;
                header("Location: admin_home.php");
    } else {
            print "Rossz jelszó vagy felhasználónév";
    }
}
?>
<form method="post" action="">
<div id="page-wrap">
<fieldset>
<legend>Adminisztrációs belépés</legend>
Felhasználónév:<br>
<input type="text" name="nev" id="nev"><br>
Jelszó:<br>
<input type="password" name="jelszo" id="jelszo"><br><br>
<input type="hidden" name="login"/>
<input type="submit" id="submit" value="Belépés">
</fieldset>
</div>
</center>
</form>
<?php
ob_end_flush();
?>