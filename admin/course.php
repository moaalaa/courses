<?php   
 session_start();
include "include/functions.php"; 
        insertCourses();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>acc courses</title>
    <link rel="stylesheet" href="css/bootstrap.css"> <!-- Latest compiled and minified CSS -->
			<link href="css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
            <link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
                <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Panel</a>
        </div>
        <div class="collapse navbar-collapse" id="app-nav">
          <ul class="nav navbar-nav">
            <li><a href="Cources prevuew.php">Cources</a></li>
            <li><a href="Articles prevuew.php">Articles</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="../admin-profile.php" ><?php echo $_SESSION["logged_name"]; ?> Profile</a>
                <li><a href="../massges.php">Massegs</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

        <div class="admin">
            <div class="container">
            	<div class="form_container">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data" class="formValidation">
            <h2>Courses</h2>
            <input type="text" name="name" placeholder="cource name" class="in inputValidation form-control">
             <select name="category" class="in inputValidation form-control">
                <option value="0" >--------</option>
                <?php getCategory(); // => include folder => functions file ?>
            </select>
            <input type="text" name="price" placeholder="cource price" class="in inputValidation form-control">
            <input type="number" name="hours" placeholder="cource hourse" class="in inputValidation form-control">
            <textarea name="description" placeholder="cource descrption" class="in inputValidation form-control"></textarea>
            <input type="number" name="numberset" placeholder="cource sets" class="in inputValidation form-control">
            <input type="file" name="img" class="in inputValidation form-control">
            <input type="submit" class="in btn btn-primary btn-block" name="add" value="add cources"/>	
                  
            
        </form>
        <div class="errorMessage"></div>
         <form method="post" action="course-E-D.php">
         <input type="submit" name="" value=" Go To Edit &amp; Delete"  class="inp btn btn-info btn-block" >
        </form>
        </div>
       
            </div>
            </div>
             <?php include "include/templates/footer.php"; ?>
            <script src="js/jquery.min.js"></script> <!-- Jquery Mini file -->
            <script src="js/bootstrap.min.js"></script> <!-- Latest compiled and minified JavaScript -->
            <script src="js/script.js"></script> <!-- Externa Js File file - My File -->
    </body>