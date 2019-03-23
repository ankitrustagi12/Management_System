<?php 
require_once("Include/db.php");
require_once("Include/sessions.php");
require_once("Include/Functions.php");
?>
<?php Confirm_Login() ?>
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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a class="navbar-brand" href="#">Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="blog.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="blog.php">Blog</a>
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
 <div style="height: 5px;"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
         <ul id="Side_Menu" class="nav flex-column ">
          <li class="active"><a href="Dashboard.php">Dashboard</a></li>
          <li><a href="AddNewPost.php">Add Post</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li><a href="Admins.php">Manage admin</a></li>
          <li><a href="#">Comments</a></li>
          <li><a href="#">Live Blog</a></li>
          <li><a href="Logout.php">Logout</a></li>
         </ul>
      </div>
      <div class="col-sm-10">
        <h1>ADMIN DASHBOARD</h1>
        <div class="table-responsive">
          <table class="table table-hover">
            <tr>
              <th>No.</th>
              <th>Title</th>
              <th>Date</th>
              <th>Author</th>
              <th>Category</th>
              <th>Banner</th>
              <th>Comment</th>
              <!---
              <th>Action</th>  -->
              <th>Details</th>
            </tr>
            <?php
            global $Connection;
            $ViewQuery="Select * from admin_panel ORDER BY datetime desc; ";
            $Execute=mysqli_query($Connection,$ViewQuery);
            $SrNo=0;
            while($DataRows=mysqli_fetch_array($Execute))
            {
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Title=$DataRows["title"];
              $Category=$DataRows["category"];
              $Admin=$DataRows["author"];
              $Image=$DataRows["image"];
              $Post=$DataRows["post"];
              $SrNo++;
            ?>
            <tr>
              <td><?php echo $SrNo; ?></td>
              <td><?php echo $Title; ?></td>
              <td>
                <?php
                  if(strlen($DateTime)>30)
                  {
                    $DateTime = substr($DateTime,0,30);
                  } 
                  echo $DateTime; 
                ?>
              </td>
              <td><?php echo $Admin; ?></td>
              <td><?php echo $Category; ?></td>
              <td>
                <img src="Upload/<?php echo $Image; ?>" width="180px"; height="90px">
              </td>
              <td>Process</td>
              <!--
              <td>
                <a href="EditPost.php">
                  <span class="btn btn-warning">Edit</span>
                </a>
                <a href="DeletePost.php">
                  <span class="btn btn-danger"> Delete</span>
                </a>
              </td>
            -->
              <td><a href="FullPost.php?id=<?php echo $Id; ?>"><span class="btn btn-primary">Live Preview</span></td>
            </tr>
            <?php
                }
            ?>  

          </table>
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
