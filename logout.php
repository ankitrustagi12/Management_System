<?php 
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
$_SESSION["id"]=NULL;
session_destroy();
Redirect_to("Login.php");
?>

