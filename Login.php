<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_POST["submit"])){
  $username=mysqli_real_escape_string($Connection,$_POST["username"]);
  $password=mysqli_real_escape_string($Connection,$_POST["password"]);
if(empty($username) || empty($password)){
  $_SESSION["ErrorMessage"]="All fields must be filled out";
  Redirect_to("Login.php");
 }
 else{
  $Found_Account=Login_Attempt($username,$password);
  $_SESSION["id"]=$Found_Account["id"];
  $_SESSION["name"]=$Found_Account["name"];
  if($Found_Account){
    $_SESSION["SuccessMessage"]="Welcome {$_SESSION["name"]} ";
    Redirect_to("dashboard.php");
  }
  else{
    $_SESSION["ErrorMessage"]="Invalid UserName/Password";
    Redirect_to("Login.php");
  }
 }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ADMIN DASHBOARD</title>
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="adminstyle.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <br>
        <br>
         <?php
          echo Message();
          echo SuccessMessage()
          ?>
          <h1 style="color: green;">Welcome Back!</h1>
        <div>
          <form action="Login.php" method="post">
            <fieldset>
              <div class="form-group">
                   <label for="username"><b>UserName:</b></label>
                   <div class="input-group input-group-lg">
                     <input class="form-control" type="text" name="username" id="username" placeholder="username">
                   </div>
              </div>
               <div class="form-group">
                    <label for="password"><b>Password:</b></label>
                    <div class="input-group input-group-lg">
                     <input class="form-control" type="password" name="password" id="password" placeholder="password">
                    </div>
                </div>
            <input class="form-control btn btn-success" type="submit" name="submit" value="Login">
            </fieldset>
          </form>
      </div>
      <div class="col-sm-4"></div>
    </div>  
  </div>

</body>
</html>
