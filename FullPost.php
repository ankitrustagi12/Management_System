<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php
if(isset($_POST["submit"])){
   $name=mysqli_real_escape_string($Connection,$_POST["name"]);
   $email=mysqli_real_escape_string($Connection,$_POST["email"]);
   $comment=mysqli_real_escape_string($Connection,$_POST["comment"]);
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();
  $datetime=strftime("%B-%d-%Y  %H:%M:%S",$currenttime);
  $datetime;
if(strlen($name)==0){
  $_SESSION["ErrorMessage"]="Name Field can't be empty";
  Redirect_to("Fullpost.php?id=<?php $id ?>");
 }
 elseif(strlen($email)==0){
  $_SESSION["ErrorMessage"]="Email Field can't be empty";
  Redirect_to("Fullpost.php?id=<?php $id ?>");
 }
 else{
  global $Connection;
  $Query="Insert into comments(datetime,title,category,author,image,post)
  VALUES('$datetime','$title','$category','$Admin','$Image','$post')";
  $Execute=mysqli_query($Connection,$Query);
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
<!Doctype html>
<html lang="en">
<head>
	<title>Full blog</title>
	  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/bootstrap.min.js"></script>
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="css/publicstyle.css">
</head>
<body>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
 	<div class="container">
  <a class="navbar-brand" href="#">Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Feature</a>
      </li>
    </ul>
    <form action="blog.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="SearchButton" type="submit">Go</button>
    </form>
  </div>
</div>
 </nav>
  <div style= "height:10px; background: skyblue;"></div>
<div class="container">
	  <div class="blog-header">
	     <h1>Content Management System Blog</h1>
	     <p class="lead">The complete cms blog</p>
	  </div>
	  <div class="row">
		  	<div class="col-sm-8">
		  	<?php
		  		global $Connection;
          if(isset($_GET["SearchButton"]))
          {
            $Search=$_GET["Search"];
            $ViewQuery="Select * from admin_panel
             Where datetime like '%$Search%' or title like '%$Search%' or category like '%$Search%' or post like '%$Search%'";
          }
          else
          {
            $PostidFromURL=$_GET["id"];
		  		$ViewQuery="Select * from admin_panel where id='$PostidFromURL' Order by datetime desc";
          }
		  		$Execute=mysqli_query($Connection,$ViewQuery);
		  		while($DataRows=mysqli_fetch_array($Execute))
		  	{
		  		$Postid=$DataRows["id"];
		  		$DateTime=$DataRows["datetime"];
		  		$Title=$DataRows["title"];
		  		$Category=$DataRows["category"];
		  		$Admin=$DataRows["author"];
		  		$Image=$DataRows["image"];
		  		$Post=$DataRows["post"];
            ?>
            <div class="img-thumbnail">
            	<img class="img-responsive rounded float-left" src="Upload/<?php echo $Image; ?>">
            <div class="caption">
            	<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
            	<p class="description"><b>Category:</b> <?php echo htmlentities($Category); ?><br>
            		<b>Published on:</b> <?php echo htmlentities($DateTime);?></p>
                <p class="Post">
                  <?php
                  echo htmlentities($Post); 
                  ?>
                </p>
            </div>
            </div>
            <?php
                  }
            ?>
             <fieldset>
              <div>
                <p></p>
                <p style="color: red;">Add Your Suggestions/Comments for the changes.</p>
              </div>
              <div class="form-group">
                <label for="name"><span class="FieldInfo">Name:</span></label>
                <input class="form-control" type="text" name="name" id="name" placeholder="name">
              </div> 
            <div class="form-group">
                <label for="email"><span class="FieldInfo">Email:</span></label>
                <input class="form-control"  type="text" name="email" id="email" placeholder="email">
            </div>
            <div class="form-group">
                <label for="postarea"><span class="FieldInfo">Comment:</span></label>
                <textarea class="form-control" name="comment" id="postarea"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </fieldset>
            <br>
		  	  </div>
		  	<div class="col-sm-1"></div>
		  	<div class="col-sm-3">
          <div class="test">
		  		<h1>Test</h1>
		  		<p>dudiudh dgujbdj gdhjd hgdh hhjdhgjd hdhjh ujdh gh hks wujj wjdj</p>
          </div>
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