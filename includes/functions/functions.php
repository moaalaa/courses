<?php
// start include the connection file the connection file named => $conn
include "connect.php";
// the the session start for the functions
session_start();

//=====================================================================================================
//Start signup form
	
	function userSignUp(){
	// global the connction file
	global $conn;
	   //check way that open the function for morew security
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            //check if isset the sign up post
    		if(isset($_POST['signUp'])) {
                // the posts valeu and make strip tags to validate
    			$firstname   	= strip_tags($_POST['firstname']);
    			$lastname    	= strip_tags($_POST['lastname']);
    			$username    	= strip_tags($_POST['username']);
    			$password    	= strip_tags($_POST['psw']);
    			$confirm_pas 	= strip_tags($_POST['con_psw']); 
    			$email       	= strip_tags($_POST['email']);
                //the directory of the image
    			$dir_name 		= dirname(__FILE__) . "/userImages/";
    			$path 			= $_FILES['image']['tmp_name'];//temporary path
    			$name 			= $_FILES['image']['name'];//the name of the image
    			$size 			= $_FILES['image']['size'];//the size of the image
    			$type 			= $_FILES['image']['type']; //image/png
    			$error 			= $_FILES['image']['error'];//the error of the image
    			
    			/*Start Chech the Image Type&Size*/
   if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000) {
    			//move the uploaded files function
    			move_uploaded_file($path, $dir_name . $name);
    			} else {
    			echo 'error in upload file ' . $error;
    			}
    			/*End Check the Image Type&Size*/
                
                // Start the Form validation
                $formValidation = array();
                //check for the empty areas
                if(empty($firstname)){
                    //the result that will happend
                    $formValidation[] = 'You Must Enter the firstname';
                
                }
                //check for the empty areas
                if (empty($lastname)) {
                    // the result that will happend 
                    $formValidation[] = 'You Must Enter the lastname';
                        
                }
                //check for the empty areas
                if (empty($username)) {
                       //the result that will happend 
                    $formValidation[] = 'You Must Enter the username';
                        
                }
                //check for the empty areas
                if (empty($password)) {
                        //the resulty yhat will happend
                    $formValidation[] = 'You Must Enter the password';
                        
                }
                //check for the empty areas
                if (empty($confirm_pas)) {
                       //the resulty yhat will happend 
                    $formValidation[] = 'You Must Enter the repeated password';
                        
                }
                    //check if the confige password match with the password
                if (strval($password) !== strval($confirm_pas)) {
                        //the resulty yhat will happend
                    $formValidation[] = 'The Password is not as exepted';
                        
                }
                    //check for the empty areas
                if (empty($email)) {
                        //the resulty yhat will happend
                    $formValidation[] = 'You Must Enter the email';
                        
                }
                //check for the empty areas
                if (empty($name)) {
                       //the resulty yhat will happend 
                    $formValidation[] = 'You must Add Photo';
                        
                }
				//check and fillter the email
				if( filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE ){
                    //the result that will happend
					$formValidation[] = "Please Enter A Validate Email";	
				}
				
                // Ckeck the username if exists in database

                $sql_u_n = "SELECT `password` FROM `users` WHERE `user_name`='hamza omar' ";

                $result_u_n = mysqli_query($conn,$sql_u_n);

                $ro = mysqli_num_rows($result_u_n);
                if($ro==1){
                  
                  $formValidation[] = "this user name is Registed BeFore خلي عند امك دم و جرب واحد تاني";

                }

				// End the Form validation
                
                //if not empty
				if(!empty($formValidation)){
					//the result of the validation and inputs
					echo '
						  <div 
						  		class	=	"container" 
								style	=	"
												position: absolute;
												z-index: 1000;
												background-color: #fff;
												left: 94px;
												top: 156px;
												padding: 40px;
												border-radius: 10px;
												box-shadow: 1px 4px 19px #eee;
											">
						 ';
					//start loop to get the errors
					foreach ($formValidation as $error) {
							
						echo '<div class="alert alert-danger">' . $error . '</div>';
					
					}//end loop
					
					echo '</div>';
					
				}
                    //check if the array that carry the error is empty
                if (empty($formValidation)) {
                            
                    // Insert Into the database

  @$sql_insert = "INSERT INTO users (frist_name, last_name, user_name, password, email, img) VALUES ('".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$email."', '".$name."')";
                    //run the query
                    $run_sql_insert = @mysqli_query($conn, $sql_insert);

                    echo '
							<div 
								class	=	"container" 
								style	=	"
												position: absolute;
												z-index: 1000;
												background-color: #fff;
												left: 94px;
												top: 156px;
												padding: 40px;
												border-radius: 10px;
												box-shadow: 1px 4px 19px #eee;
											">	  
							  
	  <div class="alert alert-success"> 
			You Have Sucessfully Registered In <strong>Learn it\'s free</strong> now You Can Register In Our <a href="index.php">Cources</a> 
								  </div>
								  <div class="alert alert-success">
							  	  		<a data-target="#sign-in-modal" data-toggle="modal" href="#">Test Your Membership</a>
								  </div>
							</div>	  
						  ';
                }
            }	
        } 
    }

//End signup form
//=================================================================================================================
//Start Login Function

	function login(){
        //global the connection function
		global $conn;
        //check if the person is admin or not by post the admin value 
		if(isset($_POST['admin'])){
            //check if isset the posts value 
			if(isset($_POST['username']) && isset($_POST['psw'])){
                //set the value post in the variabales
				$username = $_POST["username"];
				$password = $_POST["psw"];
                //select the admin from the admin table
				$sql = "SELECT user_name, password FROM admin WHERE user_name = '".$username."' && password = '".$password."'";
                //run the code
				$result = mysqli_query($conn, $sql);
                //check if there is any result 
				if($row = mysqli_fetch_array($result)){
                    //make session for the checks later
					$_SESSION['loged']     	 = 'YES'; 
					$_SESSION['logged_as_admin'] = 'yes';
					$_SESSION['logged_name'] = $username; //Register the sission name
					$_SESSION['logged_pass'] = $password;//Register the sission password
					}
				}
			}
            //check if the person is user or not by post the user value 
		else if(isset($_POST['user'])){
				
				if(isset($_POST['username']) && isset($_POST['psw'])){
                    //set the value post in the variabales
					$username = $_POST["username"];
					$password = $_POST["psw"];
                    //select the admin from the admin table
					$sql = "SELECT UserID , user_name, password FROM users WHERE user_name = '".$username."' && password = '".$password."'";
                    //run the code
					$result = mysqli_query($conn, $sql);
                    //check if there is any result 
					if($row = mysqli_fetch_array($result)){
                        //make session for the checks later
					$_SESSION['loged']     	 = 'YES';
                    $_SESSION['UserID']      = $row["UserID"];
					$_SESSION['logged_as_user'] = 'yes';
					$_SESSION['logged_name'] = $username; //Register the sission name
					$_SESSION['logged_pass'] = $password;//Register the sission password
						}
					}
			}
		}

//End Login Function

	//=============================//	
	/*start profile admin function*/
	//===========================//	

	  function profileadmin(){
        //start the connection 
        global $conn;

       $name =  $_SESSION['logged_name']; // the session that will select by it
       $pass = $_SESSION['logged_pass'];
      if($_SESSION['logged_as_admin'] == 'yes'){ //check if the admin is really logged

      		//select the data
            $admin_select = "SELECT * FROM admin WHERE user_name = '$name' && password = '$pass' ";
            //run the query
            $result = mysqli_query($conn, $admin_select);

            if(mysqli_num_rows($result) > 0){//check if there is any fields

                while($row_admin = mysqli_fetch_array($result)){
                	//start loop
                    echo "<div class='user-information col-xs-12 col-md-12'>
                    <div id='user-face' >
                        <img alt='user image' style = 'width:350px; height:350px;' src='includes/functions/adminImages/".$row_admin["img"]."'>
                        <h2>".$row_admin["user_name"]."</h2>
                    </div>
                    <div id='user-info'>
                        <div class='lable'>
                            <p><b>user name:</b> ".$row_admin["user_name"]."</p>
                        </div>
                        <div>
                            <p><b>First name:</b> ".$row_admin["frist_name"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>Last name:</b> ".$row_admin["last_name"]."</p>
                        </div>
                        <div>
                            <p><b>E-mail:</b> ".$row_admin["email"]."</p>
                        </div>
                    </div>
                    <form action='editadminprofile.php?id=".$row_admin["AdminID"]."' method='post'>
                    <a href='editadminprofile.php?id=".$row_admin["AdminID"]."'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-top: 9px;'>Edit</button></a>
                    </form>
                    <a href='massges.php'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-left:30px; '>show massages</button></a>
                    <a href='admin/index.php'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-left:30px; '>Go to Admin Panel</button></a>
                </div>
                ";
                //end loop
                }
                
           }

        }

    } 
    //===========================//	
	/*end profile admin function*/
	//=========================//

	//============================//	
	/*start profile user function*/
	//==========================//
function profileuser(){
    //start connection 
        global $conn;
       $name =  $_SESSION['logged_name']; // the session that will select by it
       $pass = $_SESSION['logged_pass'];
      if($_SESSION['logged_as_user'] == 'yes'){ //check if the admin is really logged

      		//select the data
            $admin_select = "SELECT * FROM users WHERE user_name = '$name' && password = '$pass' ";
            //run the query
            $result = mysqli_query($conn, $admin_select);

            if(mysqli_num_rows($result) > 0){//check if there is any fields

                while($row_user = mysqli_fetch_array($result)){
                	//start loop
                    echo "<div class='user-information col-xs-12 col-md-12'>
                    <div id='user-face' >
                        <img alt='user image' style = 'width:350px; height:350px;' src='includes/functions/userImages/".$row_user["img"]."'>
                        <h2>".$row_user["user_name"]."</h2>
                    </div>
                    <div id='user-info'>
                        <div class='lable'>
                            <p><b>user name:</b> ".$row_user["user_name"]."</p>
                        </div>
                        <div>
                            <p><b>First name:</b> ".$row_user["frist_name"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>Last name:</b> ".$row_user["last_name"]."</p>
                        </div>
                        <div>
                            <p><b>E-mail:</b> ".$row_user["email"]."</p>
                        </div>
                    </div>
                    <form action='edituserprofile.php?id=".$row_user["UserID"]."' method='post'>
                    <a href='edituserprofile.php?id=".$row_user["UserID"]."'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-top:9px;'>Edit</button></a>
                    </form>
                    <form action='savedCourses.php?id=".$row_user["UserID"]."' method='post'>
                    <a href='savedCourses.php?id=".$row_user["UserID"]."'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-left:30px;'>Courses</button></a>
                    </form>
                    <form action='savedOnlineCourses.php?id=".$row_user["UserID"]."' method='post'>
                    <a href='savedOnlineCourses.php?id=".$row_user["UserID"]."'><button class='btn hvr-sweep-to-right col-xs-3' style='color:#000; margin-left:30px;'>online Courses</button></a>
                    </form>
                </div>
                ";
                //end loop
                }
                
           }

        }

    }
	//============================//	
	/*start profile user function*/
	//==========================//

	//=========================//
    /*start edit admin profile*/
    //=======================//

    function adminEdit(){
        //start the connection file
    	global $conn;
    	$id = $_GET["id"];
    	if(isset($_POST["update"])){//check if isset on the element to run the update code
    		// posts values
    		$username 	     = $_POST["username"];
    		$firstname       = $_POST["first-name"];
    		$lastname 	     = $_POST["last-name"];
    		$password 	     = $_POST["password"];
            $confirm_pas     = $_POST["confirm_password"];
    		$email 		     = $_POST["email"];
            //check if the password matches
            if (strval($password) !== strval($confirm_pas)) {
                
                echo "<script>alert('Password dose not match.')</script>";
            } else {
    		//validation for the inserts boxs
    		filter_var($username, FILTER_SANITIZE_STRING);
			filter_var($firstname, FILTER_SANITIZE_STRING);
			filter_var($lastname, FILTER_SANITIZE_STRING);
			filter_var($password, FILTER_SANITIZE_STRING);
			filter_var($email, FILTER_SANITIZE_STRING);
			//image start info
    		$dir_name 		= dirname(__FILE__) . "/adminImages/";//directory
			$path 			= $_FILES['img']['tmp_name'];//temporary path
			$name 			= $_FILES['img']['name'];//name
			$size 			= $_FILES['img']['size'];//size
			$type 			= $_FILES['img']['type']; //image/png
			$error 			= $_FILES['img']['error'];//error
			
			/*Start Chech the Image Type&Size*/
			
			if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000) {
			
			move_uploaded_file($path, $dir_name . $name);
			} else {
			echo 'error in upload file ' . $error;   
			}
            //start update the function
			$sql_update = "UPDATE admin SET frist_name = '$firstname', last_name = '$lastname', user_name = '$username', password = '$password', email = '$email', img = '$name' WHERE AdminID = " . $id;
            //run the code
			$result_up = mysqli_query($conn, $sql_update);
            //set the sessions
			$name =  $_SESSION['logged_name'] = $username;//put it to make the function save the new data in the new sessions
            $pass =  $_SESSION['logged_pass'] = $password;//put it to make the function save the new data in the new sessions
            $_SESSION['logged_as_admin'];//put it to make the function save the new data in the new sessions
    	}
    }

    	//start select the data 
    	$select_edit = "SELECT * FROM admin WHERE AdminID = " . $id;
    	//run the query
    	$result = mysqli_query($conn, $select_edit);
    	//check if there is any fields
    	if(mysqli_num_rows($result) > 0){

    		while($row_edit = mysqli_fetch_array($result)){
    			//start loop
    		/*the admin card view*/
    			echo "<div class='admin-information col-xs-12 col-md-4'>
                    <div id='admin-face'>
                        <img alt='admin image' style = 'width:320px; height:320px;' src='includes/functions/adminImages/".$row_edit["img"]."'>
                        <h2>".$row_edit["user_name"]."</h2>
                    </div>
                    <div id='admin-info'>
                        <div class='lable'>
                            <p><b>user name:</b> ".$row_edit["user_name"]."</p>
                        </div>
                        <div>
                            <p><b>First name:</b> ".$row_edit["frist_name"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>Last name:</b> ".$row_edit["last_name"]."</p>
                        </div>
                        <div>
                            <p><b>E-mail:</b> ".$row_edit["email"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>User Rating:</b> 4.5</p>
                        </div>
                    </div>
                </div>
                 <div class='admin-pannel col-xs-12 col-md-7 row'>
                ";
                /*account setting*/
               echo" <div class='col-xs-12' id='edit-account'>
                        <form class='row formValidation' action='editadminprofile.php?id=".$row_edit["AdminID"]."' method='post' enctype='multipart/form-data'>
                            <h3>Account Setting:</h3>
                            <div class='col-xs-12 float-left'>
                                Email<input class='col-md-9 float-right in inputValidation form-control' name='email' placeholder='name@example.com' type='text' value='".$row_edit["email"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Username<input class='col-md-9 float-right in inputValidation form-control' name='username' placeholder='username' type='text' value='".$row_edit["user_name"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Password<input class='col-xs-9 float-right in inputValidation form-control' name='password' placeholder='password' type='password' value='".$row_edit["password"]."'>
                             </div>
                            <div class='col-xs-12 float-left'>
                                Confirm Password<input class='col-xs-9 float-right in inputValidation form-control' name='confirm_password' placeholder='Confirm password' type='password'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Profile Picture<input class='col-md-9 float-right input-file in inputValidation form-control' name='img' type='file'>
                            </div>
                             <h3>Profile Setting:</h3>
                            <div class='col-xs-12 float-left'>
                                First Name<input class='col-md-9 float-right in inputValidation form-control' name='first-name' placeholder='first name' type='text' value='".$row_edit["frist_name"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Last Name<input class='col-md-9 float-right in inputValidation form-control' name='last-name' placeholder='last name' type='text' value='".$row_edit["last_name"]."'>
                            </div>
                            <input type='submit' class='btn hvr-sweep-to-right col-xs-3' name='update' value='Update' style='color:#000;'>
                        </form>

                    </div>
                    ";
                    //end loop
                  } 
 
    	}
    }

    //=========================//
    /*end edit admin profile*/
    //=======================//

    //=========================//
    /*start edit user profile*/
    //=======================//

    function userEdit(){
        //start connection file
    	global $conn;
    	$id = $_GET["id"];
    	if(isset($_POST["update"])){//check if isset on the element to run the update code
    		// posts values
    		$username 	= $_POST["username"];
    		$firstname 	= $_POST["first-name"];
    		$lastname 	= $_POST["last-name"];
    		$password 	= $_POST["password"];
    		$confirm_pas     = $_POST["confirm_password"];
            $email           = $_POST["email"];
            //check if the passord match
             if (strval($password) !== strval($confirm_pas)) {
                
                echo "<script>alert('Password dose not match.')</script>";
            } else {
    		//validation for the inserts boxs
    		filter_var($username, FILTER_SANITIZE_STRING);
			filter_var($firstname, FILTER_SANITIZE_STRING);
			filter_var($lastname, FILTER_SANITIZE_STRING);
			filter_var($password, FILTER_SANITIZE_STRING);
			filter_var($email, FILTER_SANITIZE_STRING);
			//image start info
    		$dir_name 		= dirname(__FILE__) . "/userImages/";
			$path 			= $_FILES['img']['tmp_name'];//temporary path
			$name 			= $_FILES['img']['name'];
			$size 			= $_FILES['img']['size'];
			$type 			= $_FILES['img']['type']; //image/png
			$error 			= $_FILES['img']['error'];
			
			/*Start Chech the Image Type&Size*/
			
			if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000) {
			
			move_uploaded_file($path, $dir_name . $name);
			} else {
			echo 'error in upload file ' . $error;
			}
            //update the code
			$sql_update = "UPDATE users SET frist_name = '$firstname', last_name = '$lastname', user_name = '$username', password = '$password', email = '$email', img = '$name' WHERE UserID = " . $id;
            //run the code
			$result_up = mysqli_query($conn, $sql_update);
			$name =  $_SESSION['logged_name'] = $username;
    	}
    }

    	//start select the data 
    	$select_edit = "SELECT * FROM users WHERE UserID = " . $id;
    	//run the query
    	$result = mysqli_query($conn, $select_edit);
    	//check if there is any fields
    	if(mysqli_num_rows($result) > 0){

    		while($row_edit = mysqli_fetch_array($result)){
    			//start loop
    		/*the admin card view*/
    			echo "<div class='admin-information col-xs-12 col-md-4'>
                    <div id='admin-face'>
                        <img alt='admin image' style = 'width:320px; height:320px;' src='includes/functions/userImages/".$row_edit["img"]."'>
                        <h2>".$row_edit["user_name"]."</h2>
                    </div>
                    <div id='admin-info'>
                        <div class='lable'>
                            <p><b>user name:</b> ".$row_edit["user_name"]."</p>
                        </div>
                        <div>
                            <p><b>First name:</b> ".$row_edit["frist_name"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>Last name:</b> ".$row_edit["last_name"]."</p>
                        </div>
                        <div>
                            <p><b>E-mail:</b> ".$row_edit["email"]."</p>
                        </div>
                        <div class='lable'>
                            <p><b>User Rating:</b> 4.5</p>
                        </div>
                    </div>
                </div>
                 <div class='admin-pannel col-xs-12 col-md-7 row'>
                ";
                /*account setting*/
               echo" <div class='col-xs-12' id='edit-account'>
                        <form class='row formValidation' action='edituserprofile.php?id=".$row_edit["UserID"]."' method='post' enctype='multipart/form-data'>
                            <h3>Account Setting:</h3>
                            <div class='col-xs-12 float-left'>
                                Email<input class='col-md-9 float-right in inputValidation' name='email' placeholder='name@example.com' type='text' value='".$row_edit["email"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Username<input class='col-md-9 float-right in inputValidation' name='username' placeholder='username' type='text' value='".$row_edit["user_name"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Password<input class='col-xs-9 float-right in inputValidation' name='password' placeholder='password' type='password' value='".$row_edit["password"]."'>
   	                         </div>
                            <div class='col-xs-12 float-left'>
                                Confirm Password<input class='col-xs-9 float-right in inputValidation' name='confirm password' placeholder='Confirm_password' type='password'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Profile Picture<input class='col-md-9 float-right input-file inputValidation' name='img' type='file'>
                            </div>
                             <h3>Profile Setting:</h3>
                            <div class='col-xs-12 float-left'>
                                First Name<input class='col-md-9 float-right in inputValidation' name='first-name' placeholder='first name' type='text' value='".$row_edit["frist_name"]."'>
                            </div>
                            <div class='col-xs-12 float-left'>
                                Last Name<input class='col-md-9 float-right in inputValidation' name='last-name' placeholder='last name' type='text' value='".$row_edit["last_name"]."'>
                            </div>
                            </div>

                            <input type='submit' class='btn hvr-sweep-to-right col-xs-3' name='update' value='Update' style='color:#000;'>
                        </form> 
                    </div>

                    ";
                    //end loop
                  } 
  
    	}
    }

    //=========================//
    /*end edit user profile*/
    //=======================//	
//=================================================================================================================
// Start Check Login
	
	function check(){
		global $conn;
		//if the gest lgged as admin 
		if(isset($_SESSION['loged']) && isset($_SESSION['logged_as_admin'])){?>
				<nav class="navbar navbar-default">
					<div id="top-nav">
						<div class="container">
							<div class="navbar-header">
								<button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
							</div><!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav navbar-right">
									<li>
										<div style="color: #FFF; padding:10px ;"> <?php echo $_SESSION['logged_name'] ?></div>
									</li>
                                    <li>
										<a href="includes/functions/logOutFunc.php">Logout</a>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</div>
					<div id="bottom-nav">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
							</div><!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
								<ul class="nav navbar-nav navbar-right">
									<li>
										<a class="act" href="index.php">Home</a>
									</li>
									<li class="dropdown">
										<a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Courses <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li>
												<a href="online-courses.php">Online Course</a>
											</li>
											<li>
												<a href="offline-courses.php">Offline Course</a>
											</li>
										</ul>
                                    <li>
                                    	<a href="admin-profile.php">My Profile</a>
                                    </li>
									</li>
									<li>
										<a href="blog.php">Blog</a>
									</li>
									<li>
										<a class="act" href="contact-us.php">Contact Us</a>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</div>
				</nav><!-- End Navbar -->
				  
				
		<?php // if the gest logged as user
            }else if (isset($_SESSION['loged']) && isset($_SESSION['logged_as_user'])){?>
                        <nav class="navbar navbar-default">
                            <div id="top-nav">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                                    </div><!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li>
                                                 <div style="color: #FFF; padding:10px ;"><?php echo $_SESSION['logged_name'] ?></div>
                                            </li>
                                            <li>
                                                <a href="includes/functions/logOutFunc.php">Logout</a>
                                            </li>
                                        </ul>
                                    </div><!-- /.navbar-collapse -->
                                </div>
                            </div>
                            <div id="bottom-nav">
                                <div class="container">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
                                    </div><!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li>
                                                <a class="act" href="index.php">Home</a>
                                            </li>
                                            <li class="dropdown">
                                                <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Courses <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="online-courses.php">Online Course</a>
                                                    </li>
                                                    <li>
                                                        <a href="offline-courses.php">Offline Course</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="user-profile.php">My Profile</a>
                                            </li>
                                            <li>
                                                <a href="blog.php">Blog</a>
                                            </li>
                                            <li>
                                                <a class="act" href="contact-us.php">Contact Us</a>
                                            </li>
                                        </ul>
                                    </div><!-- /.navbar-collapse -->
                                </div>
                            </div>
                        </nav><!-- End Navbar -->
		<?php	  //if the geust didn't logged
                 }else{?>
                    <nav class="navbar navbar-default">
                        <div id="top-nav">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                                </div><!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a data-target="#sign-in-modal" data-toggle="modal" href="#">Sign In</a>
                                        </li>
                                        <li>
                                            <a data-target="#sign-up-modal" data-toggle="modal" href="#">Sign Up</a>
                                        </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                                <div id="sign-in">
                                    <form method="post" name="signin" action="<?php $_SERVER['PHP_SELF'] ?>" >
                                        <div aria-labelledby="myModalLabel" class="modal fade" id="sign-in-modal" role="dialog" tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-primary" style="color: #fff;"><input autocomplete="off" type="radio" name="admin"> Admin</label> <label class="btn btn-primary" style="color: #fff;"><input autocomplete="off" type="radio" name="user"> User</label>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control" name="username" placeholder="Username" type="text"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control" name="psw" placeholder="password" type="password"></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input class="btn btn-primary" type="submit" value="Sign In" style="color: #fff;" name="Sign In"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="sign-up">
                                    <div aria-labelledby="myModalLabel" class="modal fade" id="sign-up-modal" role="dialog" tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form enctype="multipart/form-data" name="signup" class="formValidation" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="firstname" placeholder="First Name" type="text"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="lastname" placeholder="Last Name" type="text"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="username" placeholder="Username" type="text"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="psw" placeholder="Password" type="password"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="con_psw" placeholder="confirm Password" type="password"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control inputValidation" name="email" placeholder="email" type="email"></p>
                                                        </div>
                                                        <div class="input-group">
                                                            <p>Profile Picture:<br>
                                                            <input type="file" class="img form-control inputValidation" name="image" aria-describedby="basic-addon1" ></p>
                                                        </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="signUp" value="signUp" class="btn btn-primary" style="color: #fff;" />
                                                </div>
                                                </form>
                                                <div class='errorMessage'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="bottom-nav">
                            <div class="container">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
                                </div><!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a class="act" href="index.php">Home</a>
                                        </li>
                                        <li class="dropdown">
                                            <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Courses <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="online-courses.php">Online Course</a>
                                                </li>
                                                <li>
                                                    <a href="offline-courses.php">Offline Course</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="blog.php">Blog</a>
                                        </li>
                                        <li>
                                            <a class="act" href="contact-us.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div>
                        </div>
                    </nav><!-- End Navbar -->
		   <?php }
		}

/*start blog nav check*///==========================================================================================
function checkblog(){
        global $conn;
        //if the getst logged as admin for the blog bage
        if(isset($_SESSION['loged']) && isset($_SESSION['logged_as_admin'])){?>
                <nav class="navbar navbar-default">
        <div id="top-nav">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div><!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                             <div style="color: #FFF; padding:10px ;"> <a href="admin-profile.php"><?php echo $_SESSION['logged_name'] ?></a></div>
                        </li>
                        <li>
                            <a href="includes/functions/logOutFunc.php">Logout</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
        <div id="bottom-nav">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
                </div><!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a data-scroll="" href="#web-design">Web Design</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#web-develop">Web Development</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#mobile-app">Mobile App</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </nav><!-- End Navbar -->
        <?php //if the getst logged as user for the blog bage
                }else if (isset($_SESSION['loged']) && isset($_SESSION['logged_as_user'])){?>
                        <nav class="navbar navbar-default">
        <div id="top-nav">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div><!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                             <div style="color: #FFF; padding:10px ;"> <a href="user-profile.php"><?php echo $_SESSION['logged_name'] ?></a></div>
                        </li>
                        <li>
                            <a href="includes/functions/logOutFunc.php">Logout</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
        <div id="bottom-nav">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
                </div><!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a data-scroll="" href="#web-design">Web Design</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#web-develop">Web Development</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#mobile-app">Mobile App</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </nav><!-- End Navbar -->
        <?php   //if the getst didn't logged for the blog bage 
                  }else{?>
                    <nav class="navbar navbar-default">
                        <div id="top-nav">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                                </div><!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a data-target="#sign-in-modal" data-toggle="modal" href="#">Sign In</a>
                                        </li>
                                        <li>
                                            <a href="index.php">Sign Up</a>
                                        </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                                <div id="sign-in">
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                        <div aria-labelledby="myModalLabel" class="modal fade" id="sign-in-modal" role="dialog" tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-primary"><input autocomplete="off" type="radio" name="admin"> Admin</label> <label class="btn btn-primary"><input autocomplete="off" type="radio" name="user"> User</label>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control" name="username" placeholder="Username" type="text"></p>
                                                        </div>
                                                        <div class="input-group col-xs-12">
                                                            <p><input aria-describedby="basic-addon1" class="form-control" name="psw" placeholder="password" type="password"></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input class="btn btn-primary" type="submit" value="Sign In" name="Sign In"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                       <div id="bottom-nav">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Learn It's Free</a>
                </div><!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a data-scroll="" href="#web-design">Web Design</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#web-develop">Web Development</a>
                        </li>
                        <li>
                            <a data-scroll="" href="#mobile-app">Mobile App</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </nav><!-- End Navbar -->
           <?php }
        }
/*==================*/
// End Check Login
/*================*/
    /*=========================*/
    /*start the blog functions*/
    /*=======================*/
    //start directlink blog
     function directblog(){
        //start the connectio
        global $conn;
        //get id of the artical
        $id = @$_GET["id"];
        //select the value
        $sql = "SELECT * FROM articles WHERE ArtID = " .$id;
        //run the code
        $result = mysqli_query($conn, $sql);
        //check if the value found
        if(@mysqli_num_rows($result) > 0){
            //start the loop 
            while($row = mysqli_fetch_array($result)){

                echo '
                 <section id="web-design">
                    <div class="container">
                     <div class="section-header">
                            <h1 style="color:#fdc735;">this is the artical that you choose it</h1>
                        </div>
                         <div class="blog-content row">
                    <div class="article col-xs-12 col-lg-7">
                                <a class="date" href="#">'.$row['Time'].'</a> <img alt="article image" class="col-xs-12" src="admin/include/artical_img/'.$row['Image'].'" height="500" width="100%">
                                <h1 style="color: #fdc735;">'.$row['Title'].'</h1>
                                <p>'.$row['content'].'</p>
                                         </div>
                          </div>
                          </div>
                        </section>
                     ';
            }
            //end loop
        }
    } 

    //resent posts function
    function webDesignRecentPosts(){
        global $conn;//start connection
        //select the articals limit 3 posts
        $sql = "SELECT * FROM articles WHERE cat_id = 11 ORDER BY ArtID DESC LIMIT 3";
        //run the code
        $result = mysqli_query($conn, $sql);
        //check on the value
        if(mysqli_num_rows($result) > 0){
            //start loop
            while($row = mysqli_fetch_array($result)){
                echo '<p><a href="#"><i aria-hidden="true" class="fa fa-hand-o-right fa-1x"></i>"'.$row['content'].'"</a></p>';
            }//end loop
        }   
    }

    
    //blogs bost function the web design category
    
    function websedign(){
        global $conn;//start connection
        //select the data
        $sql = "SELECT * FROM articles WHERE cat_id = 11 ORDER BY ArtID DESC LIMIT 1";
        ///run the code
        $result = mysqli_query($conn, $sql);
        //check if there is data found
        if(mysqli_num_rows($result) > 0){
            //start loop
            while($row = mysqli_fetch_array($result)){
                echo '<div class="article col-xs-12 col-lg-7">
                            <a class="date" href="#">'.$row['Time'].'</a> <img alt="article image" class="col-xs-12" src="admin/include/artical_img/'.$row['Image'].'" height="500" width="100%">
                            <h1 style="color: #fdc735;">'.$row['Title'].'</h1>
                            <p>'.$row['content'].'</p>
                      </div>
                     ';
            }//end loop
        }
    } 

    //cweb develop resent posts
    function webDevelopRecentPosts(){
        global $conn;//start connection
        ////select the data
        $sql = "SELECT * FROM articles WHERE cat_id = 10 ORDER BY ArtID DESC LIMIT 3";
        //run the code
        $result = mysqli_query($conn, $sql);
        //check if the data found
        if(mysqli_num_rows($result) > 0){
            //start loop
            while($row = mysqli_fetch_array($result)){
                echo '<p><a href="#"><i aria-hidden="true" class="fa fa-hand-o-right fa-1x"></i>"'.$row['content'].'"</a></p>';
            }//end loop
        }   
    }
    //start web develop blog post
    
    function webDevelop(){
        global $conn;//start connection
        //start select the data
        $sql = "SELECT * FROM articles WHERE cat_id = 10 ORDER BY ArtID DESC LIMIT 1";
        //run the code
        $result = mysqli_query($conn, $sql);
        //check if the data found
        if(mysqli_num_rows($result) > 0){
            //start loop
            while($row = mysqli_fetch_array($result)){
                echo '<div class="article col-xs-12 col-lg-7">
                            <a class="date" href="#">'.$row['Time'].'</a> <img alt="article image" class="col-xs-12" src="admin/include/artical_img/'.$row['Image'].'" height="500" width="100%">
                            <h1 style="color: #fdc735;">'.$row['Title'].'</h1>
                            <p>'.$row['content'].'</p>
                      </div>
                     ';
            }//end loop
        }
    }

    //start mobile application resent post
    function MobileAppRecentPosts(){
        global $conn;//start connection
        //start select the data
        $sql = "SELECT * FROM articles WHERE cat_id = 13 ORDER BY ArtID DESC LIMIT 3";
        //run the code
        $result = mysqli_query($conn, $sql);
        //check if the data found
        if(mysqli_num_rows($result) > 0){
            //start the loop
            while($row = mysqli_fetch_array($result)){
                echo '<p><a href="#"><i aria-hidden="true" class="fa fa-hand-o-right fa-1x"></i>"'.$row['content'].'"</a></p>';
            }//end loop
        }   
    }
    //start the mobile application blog posts

    function MobileApp(){
        global $conn;//start connection
        //select the data
        $sql = "SELECT * FROM articles WHERE cat_id = 13 ORDER BY ArtID DESC LIMIT 1";
        //run the code
        $result = mysqli_query($conn, $sql);
        //check if the data found
        if(mysqli_num_rows($result) > 0){
            //start the loop
            while($row = mysqli_fetch_array($result)){
                echo '<div class="article col-xs-12 col-lg-7">
                            <a class="date" href="#">'.$row['Time'].'</a> <img alt="article image" class="col-xs-12" src="admin/include/artical_img/'.$row['Image'].'" height="500" width="100%">
                            <h1 style="color: #fdc735;">'.$row['Title'].'</h1>
                            <p>'.$row['content'].'</p>
                      </div>
                     ';
            }//end the loop
        }
    }                                        
//=================================================================================================================

//start index functions
    function popular_courses(){
        global $conn;//start the connection
        $slide = 4;//the slide id count
        //select the data
        $sql_select = "SELECT * FROM cources ORDER BY CourceID DESC";
        //run the code
        $sql_query = mysqli_query($conn, $sql_select);
        //check if the data found
        if(mysqli_num_rows($sql_query) > 0){
            //start the loop
            while($row = mysqli_fetch_array($sql_query)){
                echo "
                <div class='col-xs-4 text-center' id='slider-".$slide++."'>
                                    <div class='course-img' width='320' height='320'><img style='width:350px;height:400px;' alt='' src='admin/include/course_img/".$row["Image"]."'></div>
                                    <div class='course-name'>
                                        <form action='offline-courses.php?id=".$row["CourceID"]."' method='post'>
                                        <h3><a href='offline-courses.php?id=".$row["CourceID"]."'>".$row["Name"]."</a></h3>
                                        </form>
                                <p style='max-height:500px'>".$row["Describtion"]." </p> 
                                    </div>
                                    <div class='course-user-interactive'>
                                        <div id='interactive-left'>
                                            <ul>
                                                <li><i aria-hidden='true' class='fa fa-comment'></i>4</li>
                                                <li><i aria-hidden='true' class='fa fa-user'></i>200</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                ";
            }//end the loop
        }    
    }

    //popular articals functions
    function popular_articals(){
        global $conn;//start the connection 
        $slide = 4;//slide count
        //select the data
        $sql_selectAr = "SELECT * FROM articles ORDER BY ArtID DESC LIMIT 3";
        //run the code
        $sql_queryAr = mysqli_query($conn, $sql_selectAr);
        if(mysqli_num_rows($sql_queryAr) > 0){//check if the data found
            while($rowAr = mysqli_fetch_array($sql_queryAr)){//start loop
                echo "
                <div class='col-xs-12 col-md-4'>
                    <div class='article-img'><img width='360' height='230' alt='' src='admin/include/artical_img/".$rowAr["Image"]."'></div>
                    <div class='article-content'>
                        <div class='date btn'>
                            <span>".date('d'). '<br>' .date('M')."</span>
                        </div>
                        <br />
                        <br />
                        <br />
                        <div class='content'>
                        <h3>
                            <a href='blog.php?id=".$rowAr["ArtID"]."'>".$rowAr["Title"]."</a>
                        </h3>
                        <br />
                        <p>".$rowAr["content"].".</p>
                            <img alt='line' src='img/line.png'>
                        </div>
                    </div>
                </div>
                ";
                
            }//end loop
        }
    }   

    //start  you can learn functions
    function learn(){
        global $conn;//start connection
        $slide = 9;//slide count
        //select the data
        $sql_select = "SELECT * FROM cources ORDER BY CourceID DESC";
        //run the function
        $sql_query = mysqli_query($conn, $sql_select);
        if(mysqli_num_rows($sql_query) > 0){//check if the data found
            //startb loop
            while($row = mysqli_fetch_array($sql_query)){
                echo "
                    <div class='col-xs-3' id='slider-".$slide++."'><img width='200' height='240' alt='course' src='admin/include/course_img/".$row["Image"]."'></div>
                ";
            }//ennd loop
        }
    }            
//======================================================================================================================
    //start offline courses functions
    //start the ofline course by link
    function directCourse(){
        global $conn;//start connection
        //get the course id
        $id = @$_GET["id"];
        //select the data
        $sql_selectCur = "SELECT * FROM cources WHERE CourceID = " . $id;
        //run the code
        $sql_queryCur = mysqli_query($conn, $sql_selectCur);
        if(@mysqli_num_rows($sql_queryCur) == 1){//check if the data found
            while($rowCur = mysqli_fetch_array($sql_queryCur)){//start loop
                echo'
                    <div class="course-container col-xs-8" id="web design">
                        <div class="course-header col-xs-12">
                            <div class="row">
                            <h1 style="text-align: center; color:#fdc735;">this is the course that you choose</h1>
                            <h1>'.$rowCur["Name"].'</h1><img width="500" height="500" alt="" src="admin/include/course_img/'.$rowCur["Image"].'"></div>
                        </div>
                        <div class="course-description col-xs-12">
                            <div class="row">
                                <div class="description-title col-xs-12">
                                    <h2>Course Description</h2>
                                    <div class="discription-content col-xs-12">
                                        <p>'.$rowCur["Describtion"].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-info col-xs-4">
                        <div class="info row"> ';
                            echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["CourceID"].">";
                                echo '<button class="btn hvr-sweep-to-right" name="web_design">Enrol this Course</button>
                                <hr>
                                 <label>Price : '.$rowCur["Price"].' $</label>  
                                <hr>
    
                                <label>instractor : alaa mohamed</label>
                                <hr>
                                <label>Duration : '.$rowCur["Hours"].' Hours</label>
                                <hr>
                            </form>
                        </div>
                    </div>
                ';
                break;
            }//end loop
           
        }      
    }
    //start the web design functions
    function webDesign(){
        global $conn;//start connection
        //select the data
        $sql_selectCur = "SELECT * FROM cources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = cources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 3 limit 1 

                                        ";
                                        //run the code
        $sql_queryCur = mysqli_query($conn, $sql_selectCur);
        if(mysqli_num_rows($sql_queryCur) > 0){//check if the data found
            //start loop
            while($rowCur = mysqli_fetch_array($sql_queryCur)){
                echo'

                    <div class="course-container col-xs-8" id="web design">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1 style="text-align: center; color:#fdc735;">Our New Courses</h1>
                    <h1>'.$rowCur["Name"].'</h1><img width="500" height="500" alt="" src="admin/include/course_img/'.$rowCur["Image"].'"></div>
                </div>
                <div class="course-description col-xs-12">
                    <div class="row">
                        <div class="description-title col-xs-12">
                            <h2>Course Description</h2>
                            <div class="discription-content col-xs-12">
                                <p>'.$rowCur["Describtion"].'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["CourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="web_design">Enrol this Course</button>
                        <hr>
                         <label>Price : '.$rowCur["Price"].' $</label>  
                        <hr>
                        <label>Category : Web Design</label>
                        <hr>
                        <label>instractor : alaa mohamed</label>
                        <hr>
                        <label>Duration : '.$rowCur["Hours"].' Hours</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }//end loop
        }
        //**----  Start  course registeration form PHP code ---***//
                  
                  // check if the usr is a member 
                  
         if(isset($_POST['web_design'])) {
                $id = $_GET["id"];
                $select_User = " SELECT UserID , user_name from users WHERE UserID = " . @$_SESSION['UserID'];
                $select_User_query = mysqli_query($conn , $select_User);
                
                if($select_user_result = @mysqli_fetch_array($select_User_query))
                { 
                  $user_ID  = $select_user_result['UserID']; 
                 
                  if( $user_ID == $_SESSION['UserID'])
                  {
                    $registerCourse_inssert    = 
                                " INSERT INTO `registered_courses` (`Reg_ID`, `CourceID`, `UserID`) 
                                VALUES ('".$id."', '".$_SESSION['UserID']."')";
                                
                  $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                  if(isset($registerCourse_inssert_query) ){
                       echo " <script> alert('Data saved...')</script>"; 
                      }else{
                               echo " <script> alert('Please login First...')</script>";    
                         } // Else #END  
                             
                      } else{
                               echo " <script> alert('Please login First...')</script>";    
                         } // Else #END 
                      
                    } // fetch array #END
                
                      
         } // if isset #END
                
            //**----  #END  course registeration form PHP code ---***//                                 

    }

    //start the web develp function

    function develop(){
        global $conn;//start connection
        //select the data
        $sql_devCur = "SELECT * FROM cources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = cources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 1 limit 1 

                                        ";
                                        //run the code
        $sql_devCur = mysqli_query($conn, $sql_devCur);
        if(mysqli_num_rows($sql_devCur) > 0){//check if the data found
            while($rowCur = mysqli_fetch_array($sql_devCur)){//startb loop
                echo'
                    <div class="course-container col-xs-8" id="web develop">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1>'.$rowCur["Name"].'</h1><img width="500" height="500" alt="" src="admin/include/course_img/'.$rowCur["Image"].'"></div>
                </div>
                <div class="course-description col-xs-12">
                    <div class="row">
                        <div class="description-title col-xs-12">
                            <h2>Course Description</h2>
                            <div class="discription-content col-xs-12">
                                <p>'.$rowCur["Describtion"].'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["CourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="web_develop">Enrol this Course</button>
                        <hr>
                         <label>Price : '.$rowCur["Price"].' $</label>  
                        <hr>
                        <label>Category : Web Development</label>
                        <hr>
                        <label>instractor : mohamed zayed</label>
                        <hr>
                        <label>Duration : '.$rowCur["Hours"].' Hours</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }//end the loop

        }
        //**----  Start  course registeration form PHP code ---***//
                      
                      // check if the usr is a member 
                      
                      if(isset($_POST['web_develop'])) {
                        $id = $_GET["id"];
                        $select_User = " SELECT `UserID` , `user_name` from users WHERE UserID = " . @$_SESSION['UserID'];
                        $select_User_query = mysqli_query($conn , $select_User);
                        
                        if($select_user_result = @mysqli_fetch_array($select_User_query))
                        { 
                          $user_ID  = $select_user_result['UserID']; 
                         
                          if( $user_ID == $_SESSION['UserID'])
                          {
                            $registerCourse_inssert    = 
                                        " INSERT INTO `registered_courses` (`Reg_ID`, `CourceID`, `UserID`) 
                                        VALUES (NULL, '".$id."', '".$_SESSION['UserID']."')";
                                        
                          $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                          if($registerCourse_inssert_query == true ){
                               echo " <script> alert('Data saved...')</script>"; 
                              }  
                                     
                              } else{
                                       echo " <script> alert('Please login First...')</script>";    
                                 } // Else #END 
                              
                            } // fetch array #END
                    
                          
                      } // if isset #END
                    
                //**----  #END  course registeration form PHP code ---***// 
    }

    //start the adroid courses
    function android(){
        global $conn;//start connection
        //start select
        $sql_andCur = "SELECT * FROM cources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = cources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 2 limit 1 

                                        ";
                                        //run the code
        $sql_andCur = mysqli_query($conn, $sql_andCur);
        if(mysqli_num_rows($sql_andCur) > 0){//check if the data found
            while($rowCur = mysqli_fetch_array($sql_andCur)){//start loop
                echo'
                    <div class="course-container col-xs-8" id="android">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1>'.$rowCur["Name"].'</h1><img width="500" height="500" alt="" src="admin/include/course_img/'.$rowCur["Image"].'"></div>
                </div>
                <div class="course-description col-xs-12">
                    <div class="row">
                        <div class="description-title col-xs-12">
                            <h2>Course Description</h2>
                            <div class="discription-content col-xs-12">
                                <p>'.$rowCur["Describtion"].'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["CourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="mobile_app">Enrol this Course</button>
                        <hr>
                         <label>Price : '.$rowCur["Price"].' $</label>  
                        <hr>
                        <label>Category : Mobile application</label>
                        <hr>
                        <label>instractor : Hamza omar</label>
                        <hr>
                        <label>Duration : '.$rowCur["Hours"].' Hours</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }//end the loop

        }
         //**----  Start  course registeration form PHP code ---***//
                  
                  // check if the usr is a member 
                  
              if(isset($_POST['mobile_app'])) {
                $id = $_GET["id"];
                $select_User = " SELECT `UserID` , `user_name` from users WHERE UserID = " . @$_SESSION['UserID'];
                $select_User_query = mysqli_query($conn , $select_User);
                
                if($select_user_result = @mysqli_fetch_array($select_User_query))
                { 
                  $user_ID  = $select_user_result['UserID']; 

                  if( $user_ID == $_SESSION['UserID'])
                  {
                    $registerCourse_inssert    = 
                                " INSERT INTO `registered_courses` (`Reg_ID`, `CourceID`, `UserID`) 
                                VALUES (NULL, '".$id."', '".$_SESSION['UserID']."')";
                                
                  $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                  if($registerCourse_inssert_query == true ){
                       echo " <script> alert('Data saved...')</script>"; 
                       exit();
                      }  
                             
                      } else{
                               echo " <script> alert('Please login First...')</script>";    
                         } // Else #END 
                      
                    } // fetch array #END
                
                      
                  } // if isset #END
                
            //**----  #END  course registeration form PHP code ---***//
    }

    //online courses
    //start the adroid courses
    function onlineWebDesign(){
        global $conn;
        $sql_andCur = "SELECT * FROM onlinecources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = onlinecources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 3 limit 1 

                                        ";
        $sql_andCur = mysqli_query($conn, $sql_andCur);
        if(mysqli_num_rows($sql_andCur) > 0){
            while($rowCur = mysqli_fetch_array($sql_andCur)){
                echo'
                    <div class="course-container col-xs-8" id="android">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1>'.$rowCur["Name"].'</h1>'.$rowCur["Links"].'</div>
                </div>
                <div class="course-description col-xs-12">
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["OCourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="web_design">save this Course</button>
                        <hr>
                        <label>Category : web design</label>
                        <hr>
                        <label>instractor : '.$rowCur["Instructor"].'</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }

        }
         //**----  Start  course registeration form PHP code ---***//
                  
                  // check if the usr is a member 
                  
              if(isset($_POST['web_design'])) {
                $id = $_GET["id"];
                $select_User = " SELECT `UserID` , `user_name` from users WHERE UserID = " . @$_SESSION['UserID'];
                $select_User_query = mysqli_query($conn , $select_User);
                
                if($select_user_result = @mysqli_fetch_array($select_User_query))
                { 
                  $user_ID  = $select_user_result['UserID']; 

                  if( $user_ID == $_SESSION['UserID'])
                  {
                    $registerCourse_inssert    = 
                                " INSERT INTO `registered_onlinecourses` (`Reg_ID`, `OCourceID`, `UserID`) 
                                VALUES (NULL, '".$id."', '".$_SESSION['UserID']."')";
                                
                  $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                  if($registerCourse_inssert_query == true ){
                       echo " <script> alert('Data saved...')</script>"; 
                      }else{
                               echo " <script> alert('Please login First...')</script>";    
                         }   
                             
                      } // Else #END 
                      
                    } // fetch array #END
                
                      
                  } // if isset #END
                
            //**----  #END  course registeration form PHP code ---***//
    }

    function onlineWebDevelopment(){
        global $conn;
        $sql_andCur = "SELECT * FROM onlinecources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = onlinecources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 2 limit 1 

                                        ";
        $sql_andCur = mysqli_query($conn, $sql_andCur);
        if(mysqli_num_rows($sql_andCur) > 0){
            while($rowCur = mysqli_fetch_array($sql_andCur)){
                echo'
                    <div class="course-container col-xs-8" id="android">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1>'.$rowCur["Name"].'</h1>'.$rowCur["Links"].'</div>
                </div>
                <div class="course-description col-xs-12">
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["OCourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="online_develop">save this Course</button>
                        <hr>
                        <label>Category : web development</label>
                        <hr>
                        <label>instractor : '.$rowCur["Instructor"].'</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }

        }
         //**----  Start  course registeration form PHP code ---***//
                  
                  // check if the usr is a member 
                  
              if(isset($_POST['online_develop'])) {
                $id = $_GET["id"];
                $select_User = " SELECT `UserID` , `user_name` from users WHERE UserID = " . @$_SESSION['UserID'];
                $select_User_query = mysqli_query($conn , $select_User);
                
                if($select_user_result = @mysqli_fetch_array($select_User_query))
                { 
                  $user_ID  = $select_user_result['UserID']; 

                  if( $user_ID == $_SESSION['UserID'])
                  {
                    $registerCourse_inssert    = 
                                " INSERT INTO `registered_onlinecourses` (`Reg_ID`, `OCourceID`, `UserID`) 
                                VALUES (NULL, '".$id."', '".$_SESSION['UserID']."')";
                                
                  $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                  if($registerCourse_inssert_query == true ){
                       echo " <script> alert('Data saved...')</script>"; 
                      }else{
                               echo " <script> alert('Please login First...')</script>";    
                         }   
                             
                      } // Else #END 
                      
                    } // fetch array #END
                
                      
                  } // if isset #END
                
            //**----  #END  course registeration form PHP code ---***//
    }

    function online_android(){
        global $conn;
        $sql_andCur = "SELECT * FROM onlinecources JOIN categoury 
                                        WHERE 
                                          categoury.cat_id = onlinecources.cat_id 
                                          
                                        AND 
                                          categoury.cat_id = 1 limit 1 

                                        ";
        $sql_andCur = mysqli_query($conn, $sql_andCur);
        if(mysqli_num_rows($sql_andCur) > 0){
            while($rowCur = mysqli_fetch_array($sql_andCur)){
                echo'
                    <div class="course-container col-xs-8" id="android">
                <div class="course-header col-xs-12">
                    <div class="row">
                    <h1>'.$rowCur["Name"].'</h1>'.$rowCur["Links"].'</div>
                </div>
                <div class="course-description col-xs-12">
                </div>
            </div>
            <div class="course-info col-xs-4">
                <div class="info row"> ';
                    echo "<form method='post' class='col-xs-12' action=". $_SERVER["PHP_SELF"] .'?id='.$rowCur["OCourceID"].">";
                        echo '<button class="btn hvr-sweep-to-right" name="online_android">save this Course</button>
                        <hr>
                        <label>Category : android</label>
                        <hr>
                        <label>instractor : '.$rowCur["Instructor"].'</label>
                        <hr>
                    </form>
                </div>
            </div>
                ';
            }

        }
         //**----  Start  course registeration form PHP code ---***//
                  
                  // check if the usr is a member 
                  
              if(isset($_POST['online_android'])) {
                $id = $_GET["id"];
                $select_User = " SELECT `UserID` , `user_name` from users WHERE UserID = " . @$_SESSION['UserID'];
                $select_User_query = mysqli_query($conn , $select_User);
                
                if($select_user_result = @mysqli_fetch_array($select_User_query))
                { 
                  $user_ID  = $select_user_result['UserID']; 

                  if( $user_ID == $_SESSION['UserID'])
                  {
                    $registerCourse_inssert    = 
                                " INSERT INTO `registered_onlinecourses` (`Reg_ID`, `OCourceID`, `UserID`) 
                                VALUES (NULL, '".$id."', '".$_SESSION['UserID']."')";
                                
                  $registerCourse_inssert_query = mysqli_query ($conn , $registerCourse_inssert); 
                  if($registerCourse_inssert_query == true ){
                       echo " <script> alert('Data saved...')</script>"; 
                      }else{
                               echo " <script> alert('Please login First...')</script>";    
                         }   
                             
                      } // Else #END 
                      
                    } // fetch array #END
                
                      
                  } // if isset #END
                
            //**----  #END  course registeration form PHP code ---***//
    }
//======================================================================================================================
    //start show the regestred courses for user

    function userCourses(){
        //start connection
        global $conn;
        $courseNo = 1;//course nunmber
        $user_id = $_SESSION['UserID'];
        //select the data
        $selectUserCourse = "SELECT * FROM cources JOIN registered_courses

                                                    WHERE registered_courses.CourceID = cources.CourceID AND 
                                                          registered_courses.UserID = $user_id ORDER BY Reg_ID DESC";
                                                          //run the code
        $queryUser = mysqli_query($conn, $selectUserCourse);
        if(mysqli_num_rows($queryUser) > 0){//check if the data found
            while($rowUserCourse = mysqli_fetch_array($queryUser)){//start loop
                echo "
                    <tr>
                    <td>".$courseNo++."</td>
                    <td>".$rowUserCourse["Name"]."</td>
                    <td>".$rowUserCourse["Price"]."</td>
                    <td>".$rowUserCourse["Hours"]."</td>
                    <td width='420' height='320'><img width='100%' height='100%' src='admin/include/course_img/".$rowUserCourse["Image"]."' /></td>
                    <td>".$rowUserCourse["Describtion"]."</td>
                    <td>".$rowUserCourse["Seats"]."</td>
                    </tr>
                ";
            }//end loop
        }                                                  
    }

    //start the online courses
    function userOnlineCourses(){
        global $conn;
        $courseNo = 1;
        $user_id = $_SESSION['UserID'];
        $selectUserCourse = "SELECT * FROM onlinecources JOIN registered_onlinecourses

                                                    WHERE registered_onlinecourses.OCourceID = onlinecources.OCourceID AND 
                                                          registered_onlinecourses.UserID = $user_id ORDER BY Reg_ID DESC";
        $queryUser = mysqli_query($conn, $selectUserCourse);
        if(mysqli_num_rows($queryUser) > 0){
            while($rowUserCourse = mysqli_fetch_array($queryUser)){
                echo "
                    <tr>
                    <td>".$courseNo++."</td>
                    <td>".$rowUserCourse["Name"]."</td>
                    <td>".$rowUserCourse["Instructor"]."</td>
                    <td>".$rowUserCourse["Links"]."</td>
                    </tr>
                ";
            }
        }                                                  
    }
//======================================================================================================================    

    // Start Contact Us Form
	
	function contactUsInsert(){
		global $conn;
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// get the values from the form
            $name        = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$email       = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
			$subject     = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
			$massege     = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

			//insert sql
			$sql_in = "INSERT INTO `contact`(`name`, `email`, `subject`, `massge`) VALUES ('".$name."','".$email."','".$subject."','".$massege."')";
            $query = mysqli_query($conn, $sql_in);
			if($query){
				echo "     <div  class='btn-success' style='z-index:1000; position:absolute;
   top:400px ; left:470px ; height:150px ; width:45%' id='textarea'> 
     
 <b> <strong> <center> <h1> you will recevie a message soon ..<br>  thank you for contact us ,</h1></center></strong></b>   
   </div>
";
				}
       	}	
	
    }					

	function masseges(){
		
		global $conn;
		
		$sql = "Select * FROM contact ORDER BY ContactID DESC";
		$result = mysqli_query ($conn, $sql);
		if (mysqli_num_rows($result) > 0 ){
            echo '<div class="container">';
            echo "<table class='table table-hover table-bordered' style='box-shadow: 1px 2px 27px #ccc;'>";
			echo "<th style='background-color: #333; color: #fff;'>No.</th>";
			echo "<th style='background-color: #333; color: #fff;'>Name.</th>";
			echo "<th style='background-color: #333; color: #fff;'>Email</th>";
			echo "<th style='background-color: #333; color: #fff;'>Subject</th>";
			echo "<th style='background-color: #333; color: #fff;'>Massge</th>";
			while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>".$row['ContactID']." </td>";
						echo "<td> ".$row['name']."</td>";
						echo "<td> ".$row['email']."</td>";
						echo "<td> ".$row['subject']."</td>";
						echo "<td> ".$row['massge']."</td>";
						echo "</tr>";
					}
                echo "</table>";
            echo '</div>';
			}
		}

// End Contact Us Form

//=================================================================================================================