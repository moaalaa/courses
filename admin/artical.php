<?php   
 session_start();
include "include/functions.php"; 
        insertArtical(); // => include folder => functions file
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

					 <title>Admin Panal Artical</title>
            <link rel="stylesheet" href="../css/bootstrap.css"> <!-- Latest compiled and minified CSS -->
			<link href="css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
            <link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
	         <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	        	<!--[if lt IE 9]>
	          <script src="js/html5shiv.min.js"></script>
	          <script src="js/respond.min.js"></script>
	        	<![endif]-->
        </head>
        <body>
            <!-- Type code below this line -->
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
                    <h2>Admin Control Panel Fill the form blow to insert articals</h2>
                        <form method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" class="formValidation" enctype="multipart/form-data">
                            <input type="text" name="article" placeholder="Article Title" class="in inputValidation form-control">
                            <select name="category" class="in inputValidation form-control">
                                <option value="0" >---SELECT CATEGORY-----</option>
						<?PHP
                        
                        $conn = mysqli_connect('localhost', 'root','', 'cources');
                        $sql_c_p = "select * from categoury";
                        $result_c_p = mysqli_query ($conn, $sql_c_p);
                        while($row_c_p = mysqli_fetch_array($result_c_p)){
                        
                        
                        ?>
                        <option value="<?PHP echo $row_c_p['cat_id']; ?>"> <?PHP echo $row_c_p['name']; ?></option>
                        
                        <?php // getCategory(); // => include folder => functions file ?>
                        <?PHP }?>
                             </select>

                            <textarea name="comment" placeholder="Article Content" class="ina inputValidation"></textarea>
                            <input type="file" name="img" class="in inputValidation form-control">
                            <input type="submit" name="submit" value="Add" class="in btn btn-primary btn-block">
                        </form>
                        <form action="artical-E-D.php" target="_blank" method="post">
                            <input type="submit" name="edit-delete" value="go to edit and delete options for the artical" class="inp btn btn-info btn-block">
                        </form>
                	<div class="errorMessage"></div>  
                    </div>  
                </div>
            </div>
             <?php include "include/templates/footer.php"; ?>
            <script src="../js/jquery.min.js"></script> <!-- Jquery Mini file -->
            <script src="../js/bootstrap.min.js"></script> <!-- Latest compiled and minified JavaScript -->
            <script src="js/script.js"></script> <!-- Externa Js File file - My File -->
        </body>
    </html> 
