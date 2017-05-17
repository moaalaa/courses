<?php

	//global the database file connection 
	
	require_once "db.php";

	//==========================================//
	/*start  filter function for sign up inputs*/
	//========================================//
	function fillterArtical() { // this function to the artical.php file beside => include folder
	
		if(isset($_POST['signUp']) ){
			
			//get post value
			$article   = $_POST['article'];
			$comment    = $_POST['comment']; 
	
				//SANITIZE the fields
			filter_var($article, FILTER_SANITIZE_STRING);
			filter_var($comment, FILTER_SANITIZE_STRING);
	
		}
	}	
	
	//========================================//
	/*end  filter function for sign up inputs*/
	//======================================//

	//==================================//
	/* start select the category data  */
	//================================//
	
	function getCategoryli(){
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		$sql_c_p = "select * from categoury";
		$result_c_p = mysqli_query ($conn, $sql_c_p);
		while($row_c_p = mysqli_fetch_array($result_c_p)){
			echo 
			"
			<li>
				<a href='#'>
					<button class='btn btn-info' value='".$row_c_p['cat_id']."'>
						".$row_c_p['name']."
					</button>
				</a>
			</li>
			";	
			
		}
		}
	
	function getCategory() { // this function to the artical.php file beside => include folder
	
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		
		$sql_c_p = "select * from categoury";
		
		$result_c_p = mysqli_query ($conn, $sql_c_p);
		
		while($row_c_p = mysqli_fetch_array($result_c_p)){
			echo 
			"
				<option value='".$row_c_p['cat_id']."'>".$row_c_p['name']."</option>
			";
		}
	}

	//================================//
	/* end select the category data  */
	//==============================//
	
	//=============================//
	/* start insert the user data */
	//===========================//
	
	function insertArtical(){ // this function to the artical.php file beside => include folder
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//check on submit
			if(isset($_POST['submit'])) {
				//posts values
				$article   		= $_POST['article'];
				$comment    	= $_POST['comment'];
				$category    	= $_POST['category'];
				$dir_name 		= dirname(__FILE__) . "/artical_img/";
				$path 			= $_FILES['img']['tmp_name'];//temporary path
				$name 			= $_FILES['img']['name'];
				$size 			= $_FILES['img']['size'];
				$type 			= $_FILES['img']['type']; //image/png
				$error 			= $_FILES['img']['error'];
				
				/*Start Check the Image Type&Size*/
				
				if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000)
				{
					move_uploaded_file($path, $dir_name . $name);
				} else 
				{
					echo 'error in upload file ' . $error;
				}
				/*End Chech the Image Type&Size*/
				$sql_insert = "INSERT INTO articles (Title, content, Image, cat_id) VALUES ('".$article."', '".$comment."', '".$name."', '".$category."')";
				
				$run_sql_insert = mysqli_query($conn, $sql_insert);
				if($run_sql_insert){
					echo "<script> alert('data saved..');</script>";
					}else{
						echo "<script> alert(' please try again data not saved..');</script>";
						
						}
			}		
		}
	}

	//=============================//
	/* end insert the user data */
	//===========================//

	//========================//
	/*start show the articals*/
	//======================//

	function articlesE_D(){ // this function to the artical-E-D.php file beside => include folder
		$conn = mysqli_connect('localhost','root', '' , 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//check on the Request way
			if(isset($_REQUEST['delete'])) {
				//get value 	
				$id = $_GET['id'];
		 		$sql = "DELETE FROM articles WHERE ArtID = " . $id;
		 		$result_d = mysqli_query($conn,$sql);
		 	}	
			$sql = "SELECT * FROM articles ORDER BY ArtID DESC";
			$result = mysqli_query ($conn, $sql);
			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>" . $row ['ArtID'] . "</td>";
					echo "<td>" . $row ['Title'] . "</td>";
					echo "<td>" . $row ['content'] . "</td>";
					$img = $row ['Image'];
					echo "<td>" . "<img ". "src='include/artical_img/".$img."' " . "height='350' " . "width='350' " . "/>" . "</td>";
					echo "<td>" . $row ['Time'] . "</td>";
					echo "<td>";
					echo "<form action='include/Edit.php?id=".$row ['ArtID']."' method='post'>";
					echo "<a href='#?id=".$row ['ArtID']."'><input type='submit' class='btn btn-primary btn-block' name='update' value='update'></a>";
					echo "</form>";
					echo "<form action='artical-E-D.php?id=".$row ['ArtID']."' method='post'>";
					echo "<a href='#?id=".$row ['ArtID']."'><input type='submit'onClick='return confirm(\"are you sure you wnt to delete this artical ?\");' class='btn btn-danger btn-block' name='delete' value='delete'></a>";
					echo "</form>";
					echo "</td>";
				}	echo "</tr>";	
			}
			
		} else {
			echo "<script>alert('you can\'t get in this page directlly')</script>";
		}
	}

	//======================//
	/*end show the articals*/
	//====================//

	//================================//
	/*start show the update functions*/
	//==============================//

function editart() { // this function to the edit.php file beside => functions file in include folder

		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_GET['id'];
			//check on the Request way to update
			if(isset($_POST["update_art"])) {
				//posts value
				$article   		= $_POST['article'];
				$comment    	= $_POST['comment'];
				//SANITIZE the fields
				filter_var($article, FILTER_SANITIZE_STRING);
				filter_var($comment, FILTER_SANITIZE_STRING);
				$category    	= $_POST['category'];
				$dir_name 		= dirname(__FILE__) . "/artical_img/";
				$path 			= $_FILES['img']['tmp_name'];//temporary path
				$name 			= $_FILES['img']['name'];
				$size 			= $_FILES['img']['size'];
				$type 			= $_FILES['img']['type']; //image/png
				$error 			= $_FILES['img']['error'];
				
				/*Start Check the Image Type&Size*/
				
				if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000)
				{
					move_uploaded_file($path, $dir_name . $name);
				} else 
				{
					echo 'error in upload file ' . $error;
				}
				/*End Chech the Image Type&Size*/
				
				//start update query
				$update = "UPDATE articles SET Title = '$article', content = '$comment', Image = '$name', cat_id ='$category' WHERE ArtID = " . $id;
				$result = mysqli_query($conn, $update);

				//end update query
			}

			//start select  query  after update
			
			$select = "SELECT * FROM articles WHERE ArtID = " . $id;

			$result = mysqli_query($conn, $select);

			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				//start loop
				while($row_sel_up = mysqli_fetch_array($result)) {
					echo "<div class='admin'>
			                <div class='container'>
			                	<div class='form_container'>
			                    <h2>Admin Control Panel Fill the form blow to update the artical </h2>
			                        <form method='post' class='formValidation' enctype='multipart/form-data'>
			                            <input type='text' name='article' placeholder='Article Title' class='in inputValidation form-control' value='".$row_sel_up["Title"]."'>";
			                            echo "<select name='category' class='in inputValidation form-control'>
			                                <option value='0' >--------</option>";
			                                getCategory();
			                            echo "</select>
			                            <textarea name='comment' placeholder='Article Content' class='ina inputValidation' >".$row_sel_up["content"]."</textarea>
			                            <label for='img'>".$row_sel_up["Image"]."</label>	
			                            <input type='file' name='img' class='img in inputValidation form-control'>
			                            <input type='submit' name='update_art' value='update' class='in btn btn-primary btn-block'>
			                        </form>
			                        <form action='../artical-E-D.php' method='post'>
			                            <input type='submit' name='edit-delete' value = 'Go To Edit and Delete Options For The Artical' class='inp btn btn-info btn-block'>
			                        </form>
			                	<div class='errorMessage'></div>  
			                    </div>  
			                </div>
			            </div>
					";
				}
				//end loop
			}
		}			
	}

	//==============================//
	/*end show the update functions*/
	//============================//

	//===============================//
	/*start insert category functions*/
	//=============================//

	function insertCat() {// this function to the category.php file beside => functions file in include folder

		global $conn;
$conn = mysqli_connect('localhost', 'root','', 'cources');
		//if($_SERVER["REQUEST_METHOD"] == "post") { //must do this after make the profile to can enster the page with more security

			if(isset($_POST["add"])) { //check if the submit add is isset to can insert the data
			$category = $_POST["category"];

			filter_var($category, FILTER_SANITIZE_STRING);

			$insert_cat = "INSERT INTO categoury (name) VALUES ('". $category ."')";

			$result = mysqli_query($conn, $insert_cat); 

			
			}
		//}
	}

	//==============================//
	/*end insert category functions*/
	//============================//

	//========================================//
	/*start edit && delete category functions*/
	//======================================//
	
	function editCat() {// this function to the editcategory.php file beside => functions file in include folder
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		$id            = @$_POST['Category']; //the category original id 
		if(isset($_POST['edit'])) { //check if isset for the submit edit to update the data 
			$n_id =  $_SESSION["id"];	// take the saved id and use it to update or delete
	        $New_category  = $_POST['new_category'];
	        $update_query  = "UPDATE categoury SET name = '$New_category' where cat_id = $n_id";
	        $update = mysqli_query($conn, $update_query);
        } else if(isset($_POST["delete"])){ //check if isset for the submit delete to delete the data
        	$id            = @$_POST['Category'];	
	        $delete_query  = "DELETE FROM categoury where cat_id = $id";
	        $delete = mysqli_query($conn, $delete_query);
        	
        }
        if(isset($update) || isset($delete)){ // check if the functions have done 
        	header ("location:editcategory.php");
        }

		if(isset($_POST['show'])) { //check if isset for the submit show to show the data
			
			$_SESSION["id"] = $id;
			$select_cat    = "SELECT * FROM categoury where cat_id = $id";
			$select_query  = mysqli_query($conn,$select_cat);
			while( $rows_result = mysqli_fetch_array($select_query)){ //start loop 
				echo "
				<input type='text' name='new_category' class='input-lg input-group in inputValidation form-control' value='".$rows_result["name"]."'>
				";
			
			}
			//end the loop
		}
	}
	
	//======================================//
	/*end edit && delete category functions*/
	//====================================//

	//===============================//
	/*start insert courses functions*/
	//=============================//

	function insertCourses(){// this function to the course.php file beside => functions file in include folder
	  
		global $conn;
		  $conn = mysqli_connect('localhost', 'root','', 'cources');
		if(isset($_POST["add"])){
			$New_Course_title = $_POST['name'];	
			$New_Course_Price = $_POST['price'];
			$New_Course_Hours = $_POST['hours'];
			$New_Course_Description = $_POST['description'];
			$New_Course_NumberOfSeats = $_POST['numberset'];
			filter_var($New_Course_title, FILTER_SANITIZE_STRING);
			filter_var($New_Course_Price, FILTER_SANITIZE_STRING);
			filter_var($New_Course_Hours, FILTER_SANITIZE_STRING);
			filter_var($New_Course_Description, FILTER_SANITIZE_STRING);
			filter_var($New_Course_NumberOfSeats, FILTER_SANITIZE_STRING);
			$category    	= $_POST['category'];
			$dir_name 		= dirname(__FILE__) . "/Course_img/";
			$path 			= $_FILES['img']['tmp_name'];//temporary path
			$name 			= $_FILES['img']['name'];
			$size 			= $_FILES['img']['size'];
			$type 			= $_FILES['img']['type']; //image/png
			$error 			= $_FILES['img']['error'];
						
					/*Start Check the Image Type&Size*/
					
			if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000)
					{
						move_uploaded_file($path, $dir_name . $name);
			} else {
						echo 'error in upload file ' . $error;
					}

					
			$query = "INSERT INTO `cources`(`Name`, `Price`, `Hours`, `Image`, `Describtion`, `Seats`, cat_id) VALUES
			 ('".$New_Course_title ."', '".$New_Course_Price ."', '".$New_Course_Hours ."', '".$name."', '".$New_Course_Description ."','". $New_Course_NumberOfSeats."', '".$category."')";
			$result = mysqli_query($conn, $query);	
					
																
		
		
		}
	}

	//===============================//
	/*end insert courses functions*/
	//=============================//

	function insertOnlineCourses(){// this function to the course.php file beside => functions file in include folder
	  
		global $conn;
		  $conn = mysqli_connect('localhost', 'root','', 'cources');
		if(isset($_POST["add"])){
			$New_Course_title = $_POST['name'];	
			$New_Course_Instructor = $_POST['Instructor'];
			$url = $_POST["url"];
			$category    	= $_POST['category'];
			filter_var($New_Course_title, FILTER_SANITIZE_STRING);
			filter_var($New_Course_Instructor, FILTER_SANITIZE_STRING);
			filter_var($url, FILTER_SANITIZE_STRING);
						

					
			$query = "INSERT INTO  onlinecources (`Name`, `Instructor`, `Links`, cat_id) VALUES
			 ('".$New_Course_title ."', '".$New_Course_Instructor ."', '".$url."', '".$category."')";
			$result = mysqli_query($conn, $query);	
					
																
		
		
		}
	}

	//===============================//
	/*end insert courses functions*/
	//=============================//

	//========================//
	/*start show the courses*/
	//======================//

	function Course_E_D(){ // this function to the course-E-D.php file beside => include folder
		global $conn;
 $conn = mysqli_connect('localhost', 'root','', 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//check on the Request way
			if(isset($_REQUEST['delete'])) {
				//get value 	
				$id = $_GET['id'];
		 		$sql = "DELETE FROM `cources` WHERE `CourceID` = " . $id;
		 		$result_d = mysqli_query($conn,$sql);
		 	}	
			$sql = "SELECT * FROM `cources` ORDER BY `CourceID` DESC";
			$result = mysqli_query ($conn,$sql);
	
			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>" . $row ['CourceID'] . "</td>";
					echo "<td>" . $row ['Name'] . "</td>";
					echo "<td>" . $row ['Price'] . "</td>";
					echo "<td>" . $row ['Hours'] . "</td>";
					echo "<td>" . $row ['Describtion'] . "</td>";
					echo "<td>" . $row ['Seats'] . "</td>";
					$img = $row ['Image'];
					echo "<td>" . "<img ". "src='include/course_img/".$img."' " . "height='350' " . "width='350' " . "/>" . "</td>";
					echo "<td>";
					echo "<form action='include/EditCourses.php?id=".$row ['CourceID']."' method='post'>";
					echo "<a href='#?id=".$row ['CourceID']."'><input type='submit' class='btn btn-primary btn-block' name='update' value='update'></a>";
					echo "</form>";
					echo "<form action='course-E-D.php?id=".$row ['CourceID']."' method='post'>";
					echo "<a href='#?id=".$row ['CourceID']."'><input type='submit'onClick='return confirm(\"are you sure you wnt to delete this artical ?\");' class='btn btn-danger btn-block' name='delete' value='delete'></a>
					
					";
					echo "</form>";
					echo "</td>";
				}	echo "</tr>";	
			}
			
		} else {
			echo "<script>alert('you can\'t get in this page directlly')</script>";
		}
	}

	//======================//
	/*end show the course*/
	//====================//

	function onlineCourse_E_D(){ // this function to the course-E-D.php file beside => include folder
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');

		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//check on the Request way
			if(isset($_REQUEST['delete'])) {
				//get value 	
				$id = $_GET['id'];
		 		$sql = "DELETE FROM `onlinecources` WHERE `OCourceID` = " . $id;
		 		$result_d = mysqli_query($conn,$sql);
		 	}	
			$sql = "SELECT * FROM `onlinecources` ORDER BY `OCourceID` DESC";
			$result = mysqli_query ($conn,$sql);
	
			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>" . $row ['OCourceID'] . "</td>";
					echo "<td>" . $row ['Name'] . "</td>";
					echo "<td>" . $row ['Instructor'] . "</td>";
					echo "<td>" . $row ['Links'] . "</td>";
					echo "<td>";
					echo "<form action='include/EditonlineCourses.php?id=".$row ['OCourceID']."' method='post'>";
					echo "<a href='#?id=".$row ['OCourceID']."'><input type='submit' class='btn btn-primary btn-block' name='update' value='update'></a>";
					echo "</form>";
					echo "<form action='onlineCourse-E-D.php?id=".$row ['OCourceID']."' method='post'>";
					echo "<a href='#?id=".$row ['OCourceID']."'><input type='submit'onClick='return confirm(\"are you sure you wnt to delete this artical ?\");' class='btn btn-danger btn-block' name='delete' value='delete'></a>
					
					";
					echo "</form>";
					echo "</td>";
				}	echo "</tr>";	
			}
			
		} else {
			echo "<script>alert('you can\'t get in this page directlly')</script>";
		}
	}

	//======================//
	/*end show the course*/
	//====================//
	//================================//
	/*start show the update functions*/
	//==============================//

function editCourses() { // this function to the editcourses.php file beside => functions file in include folder

		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_GET['id'];
			//check on the Request way to update
			if(isset($_POST["update_art"])) {
				//posts value
				$courseName 	= $_POST['name'];
				$price	    	= $_POST['price'];
				$number 		= $_POST['number'];
				$description	= $_POST['description'];
				$numberset		= $_POST['numberset'];
				//SANITIZE the fields
				filter_var($courseName, FILTER_SANITIZE_STRING);
				filter_var($price, FILTER_SANITIZE_STRING);
				filter_var($number, FILTER_SANITIZE_STRING);
				filter_var($description, FILTER_SANITIZE_STRING);
				filter_var($numberset, FILTER_SANITIZE_STRING);
				$category    	= $_POST['category'];
				$dir_name 		= dirname(__FILE__) . "/course_img/";
				$path 			= $_FILES['img']['tmp_name'];//temporary path
				$name 			= $_FILES['img']['name'];
				$size 			= $_FILES['img']['size'];
				$type 			= $_FILES['img']['type']; //image/png
				$error 			= $_FILES['img']['error'];
				
				/*Start Check the Image Type&Size*/
				
				if (!$error && is_uploaded_file($path) && in_array($type, array('image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png')) && $size < 200000)
				{
					move_uploaded_file($path, $dir_name . $name);
				} else 
				{
					echo 'error in upload file ' . $error;
				}
				/*End Chech the Image Type&Size*/
				
				//start update query
				$update = "UPDATE cources SET Name = '$courseName', Price = '$price', Hours = '$number', Image = '$name', Describtion = '$description', Seats = '$numberset', cat_id ='$category' WHERE CourceID = " . $id;
				$result = mysqli_query($conn, $update);

				//end update query
			}

			//start select  query  after update
			
			$select = "SELECT * FROM cources WHERE CourceID = " . $id;

			$result = mysqli_query($conn, $select);

			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				//start loop
				while($row_sel_up = mysqli_fetch_array($result)) {
					echo "<div class='admin'>
			                <div class='container'>
			                	<div class='form_container'>
			                    <h2>Admin Control Panel Fill the form blow to update the course </h2>
			                        <form method='post' class='formValidation' enctype='multipart/form-data'>
			                            <input type='text' name='name' placeholder='cource name' class='in inputValidation form-control' value='".$row_sel_up["Name"]."'>";
			                            echo "<select name='category' class='in inputValidation form-control'>
			                                <option value='0' >--------</option>";
			                                getCategory();
			                            echo "</select>
			                            <input type='text' name='price' placeholder='cource price' class='in inputValidation form-control' value='".$row_sel_up["Price"]."'>
			                            <input type='number' name='number' placeholder='cource hourse' class='in inputValidation form-control' value='".$row_sel_up["Hours"]."'>
			                            <textarea name='description' placeholder='cource descrption' class='in inputValidation form-control'>".$row_sel_up["Describtion"]."</textarea>	
			                            <input type='number' name='numberset' placeholder='cource sets' class='in inputValidation form-control' value='".$row_sel_up["Seats"]."'>
			                             <input type='file' name='img' class='in inputValidation form-control' ".$row_sel_up["Image"].">
			                            <input type='submit' name='update_art' value='update' class='in btn btn-primary btn-block'>
			                        </form>
			                        <div class='errorMessage'></div> 
			                        <form action='../course-E-D.php' method='post'>
			                            <input type='submit' name='edit-delete' value = 'Go To Edit and Delete Options For The Artical' class='inp btn btn-info btn-block'>
			                        </form>
			                    </div>  
			                </div>
			            </div>
					";
				}
				//end loop
			}
		}			
	}

	//==============================//
	/*end show the update functions*/
	//============================//

	function editonlineCourses() { // this function to the editcourses.php file beside => functions file in include folder

		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		//check if the user inter the page direct or not
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_GET['id'];
			//check on the Request way to update
			if(isset($_POST["update_art"])) {
				//posts value
				$courseName = $_POST['name'];	
				$instractor = $_POST['instractor'];
				$url = $_POST["url"];
				$category    	= $_POST['category'];
			filter_var($courseName, FILTER_SANITIZE_STRING);
			filter_var($instractor, FILTER_SANITIZE_STRING);
			filter_var($url, FILTER_SANITIZE_STRING);
				
				
				//start update query
				$update = "UPDATE onlinecources SET Name = '$courseName', Instructor = '$instractor', Links = '$url', cat_id ='$category' WHERE OCourceID = " . $id;
				$result = mysqli_query($conn, $update);

				//end update query
			}

			//start select  query  after update
			
			$select = "SELECT * FROM onlinecources WHERE OCourceID = " . $id;
			$result = mysqli_query($conn, $select);

			if (mysqli_num_rows($result) > 0 ){ //check about the recourds
				//start loop
				while($row_sel_up = mysqli_fetch_array($result)) {
					echo "<div class='admin'>
			                <div class='container'>
			                	<div class='form_container'>
			                    <h2>Admin Control Panel Fill the form blow to update the course </h2>
			                        <form method='post' class='formValidation' enctype='multipart/form-data'>
			                            <input type='text' name='name' placeholder='cource name' class='in inputValidation form-control' value='".$row_sel_up["Name"]."'>";
			                            echo "<select name='category' class='in inputValidation form-control'>
			                                <option value='0' >--------</option>";
			                                getCategory();
			                            echo "</select>
			                            <input type='text' name='instractor' placeholder='cource price' class='in inputValidation form-control' value='".$row_sel_up["Instructor"]."'>
			                            <input type='text' name='url' placeholder='cource url' class='in inputValidation form-control' value='".$row_sel_up["url"]."'>
			                            <input type='submit' name='update_art' value='update' class='in btn btn-primary btn-block'>
			                        </form>
			                        <div class='errorMessage'></div> 
			                        <form action='../onlinecourse-E-D.php' method='post'>
			                            <input type='submit' name='update_art' value = 'Go To Edit and Delete Options For The Artical' class='inp btn btn-info btn-block'>
			                        </form>
			                    </div>  
			                </div>
			            </div>
					";
				}
				//end loop
			}
		}			
	}
	//==============================//
	/*Start Contact US Insert*/
	//============================//
	function contactUsInsert(){
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$name = $_POST['name'];
				$email = $_POST['email'];
				$subject = $_POST['subject'];
				$massege = $_POST['massege'];
				//Filter
				filter_var($name, FILTER_SANITIZE_STRING);
				filter_var($email, FILTER_SANITIZE_STRING);
				filter_var($subject, FILTER_SANITIZE_STRING);
				filter_var($massege, FILTER_SANITIZE_STRING);
				//insert sql
				$sql_in = "INSERT INTO `contact`(`name`, `email`, `subject`, `massge`) VALUES ('".$name."','".			 				$email."','".$subject."','".$massege."')";
				$query = mysqli_query($conn, $sql_in);
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					echo "<script>alert('Done Massge Has Been Sent')</script>";
					}
				}
		}
	//==============================//
	/*End Contact US Insert*/
	//============================//
	
	//==============================//
	/*the masseges start*/
	//============================//
	
	function masseges(){
		
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		$sql = "Select * FROM contact";
		$result = mysqli_query ($conn, $sql);
		if (mysqli_num_rows($result) > 0 ){

            echo "<table class='table-bordered'>";
			echo "<th>No.</th>";
			echo "<th>Name.</th>";
			echo "<th>Email</th>";
			echo "<th>Subject</th>";
			echo "<th>Massge</th>";
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
			}
		}
	
	//==============================//
	/*the masseges End*/
	//============================//
	

	//==============================//
	/*Start cources prev*/
	//============================//
	function prevCources() {
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		$sqlSelectCources = "SELECT * FROM `cources` ORDER BY CourceID DESC ";
		$result = mysqli_query($conn, $sqlSelectCources);
		if(mysqli_num_rows($result) > 0){
			echo "<div class='Container'>";
			while($row = mysqli_fetch_array($result)){
					echo "<div class='cource' style='width: 30%; margin-left: 1%; border: 4px solid #333; backgoround-color: #e1e1e1; margin-bottom: 20px; padding: 20px; float: left; border-radius: 10px;'>";
					echo "<div style='margin-bottom: 20px;'><h3 class='color: #eee;'>" . $row ['Name'] . "</h3></div>";
					$img = $row ['Image'];
					echo "<div class='img' style='border-radius: 5px; border: 1px solid #e5e5e5; margin-bottom: 20px;'>" . "<img ". "src='include/course_img/".$img."' " ."style='border-radius: 5px; border: 1px solid #e5e5e5' ". "height='250' " . "width='100%' " . "/>" . "</div>";
					echo "<p style='color: #333; line-height: 1.5; border-bottom: 1px solid #222'>" . $row ['Describtion'] . "</p>";
					echo "<div>";
					echo "<h4>" . "Cource setes is: " . $row ['Seats'] . " Seats</h4>";
					echo "<h4>" . "Cource Hours: ". $row ['Hours'] . " H</h4>";
					echo "</div>";
					echo "<div class='price'>";
					echo "<button class='btn btn-primary btn-block'>" . "Cource Price: " .$row['Price']. "</button>";
					echo "</div>";
					echo "</div>";
				}	
			echo "</div>";	
		}
	}
	//==============================//
	/*End cources prev*/
	//============================//
	
	//==============================//
	/*Start Articles prev*/
	//============================//
	function prevArticles() {
		global $conn;
		$conn = mysqli_connect('localhost', 'root','', 'cources');
		$sqlSelectArticles = "SELECT * FROM `articles` ORDER BY ArtID DESC";
		$result = mysqli_query($conn, $sqlSelectArticles);
		if(mysqli_num_rows($result) > 0){
			echo "<div class='Container'>";
			while($row = mysqli_fetch_array($result)){
					echo "<div class='Article' style='width: 30%; margin-left: 1%; border: 4px solid #333; backgoround-color: #e1e1e1; margin-bottom: 20px; padding: 20px; float: left; border-radius: 10px;'>";
					echo "<div style='margin-bottom: 20px;'><h3 class='color: #eee;'>" . $row ['Title'] . "</h3></div>";
					$img = $row ['Image'];
					echo "<div class='img' style='border-radius: 5px; border: 1px solid #e5e5e5; margin-bottom: 20px;'>" . "<img ". "src='include/artical_img/".$img."' " ."style='border-radius: 5px; border: 1px solid #e5e5e5' ". "height='250' " . "width='100%' " . "/>" . "</div>";
					echo "<p style='color: #333; line-height: 1.5; border-bottom: 1px solid #222'>" . $row ['content'] . "</p>";
					echo "<div>";
					echo "<h4>" . "artical post on: " . $row ['Time'] . "</h4>";
					echo "</div>";
					echo "</div>";
				}	
			echo "</div>";	
		}
	}
	//==============================//
	/*End Aritcles prev*/
	//============================//