<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_POST["submit"])){
   $title=mysqli_real_escape_string($Connection,$_POST["title"]);
   $category=mysqli_real_escape_string($Connection,$_POST["category"]);
   $post=mysqli_real_escape_string($Connection,$_POST["post"]);
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();
  $datetime=strftime("%B-%d-%Y  %H:%M:%S",$currenttime);
  $datetime;
  $Admin="Ankit Rustagi";
  $Image=$_FILES["image"]["name"];
  $Target="upload/".basename($Image);
if(strlen($title)==0){
  $_SESSION["ErrorMessage"]="Title field can't be empty";
  //header("Location:dashboard.php");
  //exit;
  Redirect_to("AddNewPost.php");
 }
 elseif(strlen($title)<2){
  $_SESSION["ErrorMessage"]="Title should have more than 2 characters.";
  Redirect_to("AddNewPost.php");
 }
 else{
  global $Connection;
  $Query="Insert into admin_panel(datetime,title,category,author,image,post)
  VALUES('$datetime','$title','$category','$Admin','$Image','$post')";
  $Execute=mysqli_query($Connection,$Query);
  move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
  if($Execute){
    $_SESSION["SuccessMessage"]="Category added successfully";
    Redirect_to("AddNewPost.php");
  }
  else{
    $_SESSION["ErrorMessage"]="Category failed to Add";
    Redirect_to("AddNewPost.php");
  }
 }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ADD NEW POST</title>
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
          <li class="active"><a href="AddNewPost.php">Add New Post</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li><a href="Admins.php">Manage admin</a></li>
          <li><a href="#">Comments</a></li>
          <li><a href="#">Live Blog</a></li>
          <li><a href="#">Logout</a></li>
         </ul>
      </div>
      <div class="col-sm-10">
        <h1>ADD NEW POST</h1>
         <?php
          echo Message();
          echo SuccessMessage();
          ?>
      <div>
          <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Title:</span></label>
                <input class="form-control" type="text" name="title" id="title" placeholder="title">
              </div>
            <div class="form-group"
              <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
              <select class="form-control" id="categoryselect" name="category" placeholder="category">
                  <?php
                  global $Connection;
                  $ViewQuery="SELECT * From category
                              order by Datetime desc";
                  $Execute=mysqli_Query($Connection,$ViewQuery);
                  while($DataRows=mysqli_fetch_array($Execute)){

                    $Id=$DataRows["id"];
                    $Categoryname=$DataRows["name"];                           
                  ?>
                    <option><?php echo $Categoryname; ?></option>
                  <?php } ?>
              </select>
            </div>
              <div class="form-group">
                <label for="imageselect"><span class="FieldInfo">Select Image:</span></label><br>
                <input type="File" class="form-group" name="image" id="imageselect">
              </div>
              <div class="form-group">
                <label for="postarea"><span class="FieldInfo">Post:</span></label>
                <textarea class="form-control" name="post" id="postarea" placeholder="post"></textarea>
              </div>
              <input class="btn btn-success" type="submit" name="submit" value="Add new Post">
            </fieldset>
          </form>
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
