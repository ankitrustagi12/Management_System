<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_POST["submit"])){
  $category=mysqli_real_escape_string($Connection,$_POST["category"]);
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();
  $datetime=strftime("%B-%d-%Y  %H:%M:%S",$currenttime);
  $datetime;
  $Admin="Ankit Rustagi";
if(strlen($category)==0){
  $_SESSION["ErrorMessage"]="All fields must be filled out";
  //header("Location:dashboard.php");
  //exit;
  Redirect_to("categories.php");
 }
 elseif(strlen($category)>99){
  $_SESSION["ErrorMessage"]="Too long name.";
  Redirect_to("categories.php");
 }
 else{
  global $Connection;
  $Query="Insert into category(datetime,name,creatorname)
  VALUES('$datetime','$category','$Admin')";
  $Execute=mysqli_query($Connection,$Query);
  if($Execute){
    $_SESSION["SuccessMessage"]="Category added successfully";
    Redirect_to("categories.php");
  }
  else{
    $_SESSION["ErrorMessage"]="Category failed to Add";
    Redirect_to("categories.php");
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
          <li class="active"><a href="categories.php">Categories</a></li>
          <li><a href="Admins.php">Manage admin</a></li>
          <li><a href="#">Comments</a></li>
          <li><a href="#">Live Blog</a></li>
          <li><a href="#">Logout</a></li>
         </ul>
      </div>
      <div class="col-sm-10">
        <h1>MANAGE CATEGORIES</h1>
         <?php
          echo Message();
          echo SuccessMessage()
          ?>
        <div>
          <form action="categories.php" method="post">
            <fieldset>
              <div class="form-group"
              <label for="categoryname">Name:</label>
              <input class="form-control" type="text" name="category" id="categoryname" placeholder="name">
            </div>
            <input class="btn btn-success" type="submit" name="submit" value="Add new Category">
            </fieldset>
          </form>
      </div>
      <div class="table-responsive">                         <!----Not working--->
        <table class="table table-hover">
          <tr>
            <th>Sr No.</th>
            <th>Date & Time</th>
            <th>Category Name</th>
            <th>Creator Name</th>
            <th>Action</th>
          </tr>
          <br>
          <?php
          global $Connection;
          $ViewQuery="SELECT * From category
                      order by Datetime desc";
          $Execute=mysqli_Query($Connection,$ViewQuery);
          $SrNo=0;
          while($DataRows=mysqli_fetch_array($Execute)){

            $Id=$DataRows["id"];
            $Datetime=$DataRows["datetime"];
            $Categoryname=$DataRows["name"];
            $Creatorname=$DataRows["creatorname"];
            $SrNo++;

          ?>
          <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $Datetime; ?></td>
            <td><?php echo $Categoryname; ?></td>
            <td><?php echo $Creatorname; ?></td>
            <td><span class="btn btn-danger">Delete</span></td>
          </tr>
          <?php
           }                            /*End of while*/
          ?>
        </table>
      </div>
    </div>  
  </div>
<div id="footer">
  <hr><p>Made by || Ankit Rustagi</p>
  <a style="color:white; text-decoration: none; cursor: pointer; font-weight: bold"
  <p>This is my summer project for intern.
  </a>
</div>
</body>
</html>
