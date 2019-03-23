<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
?>
<?php
function Redirect_to($New_location){
	header("Location:".$New_location);
	exit;
}
function Login_Attempt($username,$password){
	global $Connection;
	$Query="SELECT * from registration 
	where name='$username' and password='$password' ";
	$Execute=mysqli_query($Connection,$Query);
	if($Admin=mysqli_fetch_assoc($Execute)){
		return $Admin;
	}
	else{
		return null;
	}
}
function Login(){
	if(isset($_SESSION["id"])){
		return true;
	}
}
function Confirm_Login(){
	if(!Login()){
		$_SESSION["ErrorMessage"]=" Login Required !";
		Redirect_to("Login.php");
	}
}
?>