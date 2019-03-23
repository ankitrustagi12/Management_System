<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_POST["submit"])){
  $username=mysqli_real_escape_string($Connection,$_POST["username"]);
  $password=mysqli_real_escape_string($Connection,$_POST["password"]);
  $confirmpassword=mysqli_real_escape_string($Connection,$_POST["confirmpassword"]);
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();
  $datetime=strftime("%B-%d-%Y  %H:%M:%S",$currenttime);
  $datetime;
  $Admin="Ankit Rustagi";
if(empty($username) && empty($password) && empty($confirmpassword)){
  $_SESSION["ErrorMessage"]="All fields must be filled out";
  Redirect_to("Admins.php");
 }
 elseif(strlen($password)<6){
  $_SESSION["ErrorMessage"]="Password must be greater than 6 Characters.";
  Redirect_to("Admins.php");
 }
 elseif($password!=$confirmpassword){
  $_SESSION["ErrorMessage"]="Password does not match.";
 }
 else{
  global $Connection;
  $Query="Insert into registration(datetime,name,addedby,password)
  VALUES('$datetime','$username','$Admin','$password')";
  $Execute=mysqli_query($Connection,$Query);
  if($Execute){
    $_SESSION["SuccessMessage"]="Admin added successfully";
    Redirect_to("Admins.php");
  }
  else{
    $_SESSION["ErrorMessage"]="Admin failed to Add";
    Redirect_to("Admins.php");
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
  <link rel="stylesheet" href="css/adminstyle.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
         <ul id="Side_Menu" class="nav flex-column ">                  <!-----still make it better--->
          <li><a href="Dashboard.php">Dashboard</a></li>
          <li><a href="AddNewPost.php">Add New Post</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li class="active"><a href="Admins.php">Manage admin</a></li>
          <li><a href="#">Comments</a></li>
          <li><a href="#">LIve Blog</a></li>
          <li><a href="#">Logout</a></li>
         </ul>
      </div>
      <div class="col-sm-10">
        <h1>MANAGE Admin</h1>
        <p><b>Sign up New Admin</b><p>
         <?php
          echo Message();
          echo SuccessMessage()
          ?>
        <div>
          <form action="Admins.php" method="post">
            <fieldset>
              <div class="form-group">
                   <label for="username">UserName:</label>
                   <input class="form-control" type="text" name="username" id="username" placeholder="username">
              </div>
               <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="password">
              </div>
               <div class="form-group">
                    <label for="username">Confirm Password:</label>
                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" placeholder="confirmpassword">
              </div>
            <input class="btn btn-success" type="submit" name="submit" value="Add new Admin">
            </fieldset>
          </form>
      </div>
      <p></p>
      <div class="table-responsive">                         <!----Not working--->
        <table class="table table-hover">
          <tr>
            <th>Sr No.</th>
            <th>Date & Time</th>
            <th>Admin Name</th>
            <th>Added By</th>
            <th>Action</th>
          </tr>
          <?php
          global $Connection;
          $ViewQuery="SELECT * From registration
                      order by datetime desc";
          $Execute=mysqli_Query($Connection,$ViewQuery);
          $SrNo=0;
          while($DataRows=mysqli_fetch_array($Execute)){

            $Id=$DataRows["id"];
            $datetime=$DataRows["datetime"];
            $username=$DataRows["name"];
            $Admin=$DataRows["addedby"];
            $SrNo++;

          ?>
          <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $datetime; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $Admin; ?></td>
            <td>
              <a href="DeleteAdmin.php?id=<?php echo $Id; ?>">
                <span class="btn btn-danger">Remove</span>
              </a>
            </td>
          </tr>
          <?php
           }                            /*End of while*/
          ?>
        </table>
      </div>
    </div>  
  </div>
<div class="container-fluid" id="footer">
  <hr><p>Made by || Ankit Rustagi</p>
  <a style="color:white; text-decoration: none; font-weight: bold">
    <p>This is my summer project for intern.</p>
  </a>
</div>
</body>
</html>
