<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_GET["id"])){
  $Id=$_GET["id"];
  $Connection;
  $Query="Delete from registration WHERE id='$Id' ";
  $Execute=mysqli_query($Connection,$Query);
  if($Execute){
    $_SESSION["SuccessMessage"]="Admin deleted successfully";
    Redirect_to("Admins.php");
  }
  else{
    $_SESSION["ErrorMessage"]="Something went wrong.";
    Redirect_to("Admins.php");
  }
}
?>