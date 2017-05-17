<?php
     include "includes/templates/offline-courcesHeader.php";
 include "includes/templates/navbar.php";     ?>

             <section id="course">
             <div class="container ">
                <div class="course-category row">
                 <div class="cat-drop col-xs-4">
                     <ul class="list-group">
       
   <li class="list-group-item"> <a href="#web design">Web Design</li></a>
  <li class="list-group-item"><a href="#web develop">Web develop</a> </li>
  <li class="list-group-item"><a href="#Android">Mobile App</a> </li>
             
</ul>
                 </div>
                 <div class="category-banner col-xs-8" >
                    <div class="category-img " col-xs-12>
                     <img src="img/achevement-bg.jpg" alt="">
                     
                     </div>
                    
                    
                    </div>
                 
                 </div>
                 <div class="course-container col-xs-8" >
                 <div class="course-header col-xs-12">
            <div class="row">
            <?PHP 
			 $connection             = mysqli_connect('localhost', 'root' , '', 'cources');
			$Select_join        = "     SELECT *
									      FROM `cources` JOIN `categoury` 
									    WHERE 
									      categoury.cat_id = cources.cat_id AND 
									      categoury.cat_id = 11 limit 1 " ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="web design" > <?PHP echo $Select_join_result['Name']; ?>   </h1>
            <img src="img/creative-website-design.jpg" alt="">
             </div>
            </div>
            
         <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p> <?PHP echo $Select_join_result['Describtion']; ?></p>
                </div>
                
            </div>
                </div>
          
        
            </div>
            </div>
            <div class="course-info col-xs-4"> 

                <div class="info row">
                            <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Price : $<?PHP echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                            <button class="btn hvr-sweep-to-right" name="web_design">Enrol this Course</button>
                                    <hr>    
                                     <label>Category :<?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: Peter Adam</label>     
                                    <hr>
                                   <label>Duration : <?PHP echo $Select_join_result['Hours']; ?> hours </label> 
                                    <hr>

                            </form>
             <?PHP
				 //**----  Start  course registeration form PHP code ---***//
				  
				  // check if the usr is a member 
				  
		 if(isset($_POST['web_design'])) {
				$select_User = " SELECT `UserID` , `user_name` from users " ;
				$select_User_query = mysqli_query($connection , $select_User);
				
				if($select_user_result = mysqli_fetch_array($select_User_query))
				{ 
				  $user_ID  = $select_user_result['UserID']; 
				  
				 
				 
				  if( $_SESSION['logged_as_user'] == 'yes')
				  {
					$registerCourse_inssert    = 
								" INSERT INTO `registered_courses` (`Reg_ID`, `CourceID`, `UserID`) 
								VALUES (NULL, '".$Select_join_result['CourceID']."', '".$_SESSION['UserID']."')";
								
				  $registerCourse_inssert_query = mysqli_query ($connection , $registerCourse_inssert); 
				  if($registerCourse_inssert_query == true){
					   echo " <script> alert('course saved ..')</script>"; 
					   }
				  exit();	 
							 
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					} // if ( fetch array ) #END
				
					  
		 } // if isset #END
				
			//**----  #END  course registeration form PHP code ---***//	
				   
 } // While Loop END 
		  
		  
			  ?>               </div>
            </div>

         <div class="course-container col-xs-8" >
                 <div class="course-header col-xs-12">
            <div class="row">
            <?PHP 
			
			$Select_join        = "     SELECT *
									      FROM `cources` JOIN `categoury` 
									    WHERE 
									      categoury.cat_id = cources.cat_id AND 
									      categoury.cat_id = 10 limit 1 " ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="web develop"> <?PHP echo $Select_join_result['Name']; ?></h1>
            <img src="img/Web-Develop-article-img-1.jpg" alt="">
             </div>
            </div>
            
            
                    
            <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p> <?PHP echo $Select_join_result['Describtion']; ?> </p>
                </div>
                
            </div>
                </div>
          
        
            </div>
            </div>
            <div class="course-info col-xs-4">

                <div class="info row">
                            <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Price : $<?PHP echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                                    <button class="btn hvr-sweep-to-right" name="web_develop">Enrol this Course</button> 
                                    <hr>    
                                     <label>Category : <?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: adam joe</label>     
                                    <hr>
                                   <label>Duration : <?PHP echo $Select_join_result['Hours']; ?> hours </label> 
                                    <hr>
                            </form>
            
                      <?PHP
					  
	     //**----  Start  course registeration form PHP code ---***//
					  
					  // check if the usr is a member 
						  
		 if(isset($_POST['web_develop'])) {
				$select_User = " SELECT `UserID` , `user_name` from users " ;
				$select_User_query = mysqli_query($connection , $select_User);
				
				if($select_user_result = mysqli_fetch_array($select_User_query))
				{ 
				  $user_ID  = $select_user_result['UserID']; 
				  
				 
				 
				  if( $_SESSION['logged_as_user'] == 'yes')
				  {
					$registerCourse_inssert    = 
					" INSERT INTO `registered_courses` (`Reg_ID`,`Date`,`CourceID`, `UserID`) 
				VALUES (NULL, '". date('d - m - y') ."' , '".$Select_join_result['CourceID']."', '".$_SESSION['UserID']."')";
								
				  $registerCourse_inssert_query = mysqli_query ($connection , $registerCourse_inssert); 
				  if($registerCourse_inssert_query == true){
					   echo " <script> alert('course saved ..')</script>"; 
					   }
				  exit();	 
							 
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					} // if ( fetch array ) #END
				
					  
		 } // if isset #END
		 
				//**----  #END  course registeration form PHP code ---***//	
					   
			 } // While Loop END 		   
					    ?>  
                      
                   
				  
				       
				   
				        
                            </div>
            </div>
<div class="course-container col-xs-8" >
                 <div class="course-header col-xs-12">
            <div class="row">
            
             <?PHP 
			$Select_join        = "     SELECT *
									      FROM `cources` JOIN `categoury` 
									    WHERE 
									      categoury.cat_id = cources.cat_id AND 
									      categoury.cat_id = 13 limit 1 " ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="Android"> <?PHP echo $Select_join_result['Name']; ?></h1>
            <img src="img/Web-Design-article-img.png" alt="">
             </div>
            </div>
            
            
                    
            <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p><?PHP echo $Select_join_result['Describtion']; ?> </p>
                </div>
                
            </div>
                </div>
          
        
            </div>
            </div>
            <div class="course-info col-xs-4">

                <div class="info row">
                            <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Price : $<?PHP echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                                    <button class="btn hvr-sweep-to-right" name="mobile_app">Enrol this Course</button> 
                                    <hr>    
                                     <label>Category : <?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: Joseph </label>     
                                    <hr>
                                   <label>Duration : <?PHP echo $Select_join_result['Hours']; ?> hours </label> 
                                    <hr>

                            </form>
                       <?PHP 
					   				 //**----  Start  course registeration form PHP code ---***//
				  
				  // check if the usr is a member 
						  
		 if(isset($_POST['mobile_app'])) {
				$select_User = " SELECT `UserID` , `user_name` from users " ;
				$select_User_query = mysqli_query($connection , $select_User);
				
				if($select_user_result = mysqli_fetch_array($select_User_query))
				{ 
				  $user_ID  = $select_user_result['UserID']; 
				  
				 
				 
				  if( $_SESSION['logged_as_user'] == 'yes')
				  {
					$registerCourse_inssert    = 
								" INSERT INTO `registered_courses` (`Reg_ID`, `CourceID`, `UserID`) 
								VALUES (NULL, '".$Select_join_result['CourceID']."', '".$_SESSION['UserID']."')";
								
				  $registerCourse_inssert_query = mysqli_query ($connection , $registerCourse_inssert); 
				  if($registerCourse_inssert_query == true){
					   echo " <script> alert('course saved ..')</script>"; 
					   }
				  exit();	 
							 
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					} // if ( fetch array ) #END
				
					  
		 } // if isset #END	
			//**----  #END  course registeration form PHP code ---***//	
				   
		 } // While Loop END 
		  
		  

					   
					   ?>      
                            </div>
            </div>

         
               
                </div>
            </section>
            

<?php include "includes/templates/footer.php"; ?>