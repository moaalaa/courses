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
			
			// Web Design Course 
 $connection  = mysqli_connect('localhost', 'root' , '', 'cources');
$Select_join  = "SELECT * FROM onlinecources JOIN categoury WHERE categoury.cat_id = onlinecources.cat_id AND categoury.cat_id = 11 LIMIT 1" ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="web design" > <?PHP echo $Select_join_result['Name']; ?>     </h1>
              
            
        <img src="admin/include/course_img/<?PHP echo $Select_join_result['course_img']; ?>"  width="100px" height="400px"/>
             
             
             
             </div>
            </div>
            
         <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p> <?PHP echo $Select_join_result['Description']; ?> </p>
                </div>
                
            </div>
                </div>
          <script>  </script>
        
            </div>
            </div>
            <div class="course-info col-xs-4"> 

                <div class="info row">
                                 <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Date  : <?PHP echo date('d M y') ;// echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                           
                                     <label>Category :<?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: <?PHP echo $Select_join_result['Instructor']; ?> </label>
                                   <hr> 
           
                            </form> 
   <form method="post" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 
                            
             <button value="watch video" class="btn hvr-sweep-to-right btn-block" name="web_design" onclick="widno.location:watch.php">
             Watch Course Online     
                 </button>  
                            </form> 
             <?PHP

				  // check if the usr is a member
				   
				  
		 if(isset($_POST['web_design'])) {
				
				 
				  if( $_SESSION['logged_as_user'] == 'yes') {
					  
					  $cc = $Select_join_result['OCourceID'];
					  
					   echo "<script> window.open('watch_videos.php?id=$cc','_self') </script>";
					
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					
				
					  
		 } // if isset #END
				
				   
 } // While Loop END 		   
		  
			  ?>               </div>
            </div>

         <div class="course-container col-xs-8" >
                 <div class="course-header col-xs-12">
            <div class="row">
            <?PHP 
			
	$Select_join =" SELECT * FROM onlinecources JOIN categoury WHERE categoury.cat_id = onlinecources.cat_id AND categoury.cat_id = 10 LIMIT 1" ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="web develop"> <?PHP echo $Select_join_result['Name']; ?></h1>
        <img src="admin/include/course_img/<?PHP echo $Select_join_result['course_img']; ?>"  width="100px" height="400px"/>
    <?PHP echo $Select_join_result['course_img']; ?>
             </div>
            </div>
            
            
                    
            <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p> <?PHP echo $Select_join_result['Description']; ?> </p>
                </div>
                
            </div>
                </div>
          
        
            </div>
            </div>
            <div class="course-info col-xs-4">

                <div class="info row">
                              <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Date  : <?PHP echo date('d M y') ;// echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                           
                                     <label>Category :<?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: <?PHP echo $Select_join_result['Instructor']; ?></label>     
                                    <hr>
                                 </form>
 <form method="post" action="watch_videos.php<?PHP echo '?id='.$Select_join_result['OCourceID'];echo'?Ct='.$Select_join_result['cat_id'] ?>">
                            
             <button value="watch video" class="btn hvr-sweep-to-right btn-block" name="web_design" onclick="widno.location:watch.php">
             Watch Course Online     
                 </button>  
                            </form>
            
                      <?PHP
			 
				  // check if the usr is a member 
				  
		 if(isset($_POST['web_dev'])) {
				
				 
				  if( $_SESSION['logged_as_user'] == 'yes')
				  {
					   echo " <script> alert(' you can watch the web development video...')</script>"; 
					
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					
				
					  
		 } // if isset #END
				
				   
 } // While Loop END 		   
		  
				   
		   
					    ?>  
                      
                   
				  
				       
				   
				        
                            </div>
            </div>
<div class="course-container col-xs-8" >
                 <div class="course-header col-xs-12">
            <div class="row">
            
             <?PHP 
$Select_join = " SELECT * FROM onlinecources JOIN categoury WHERE categoury.cat_id = onlinecources.cat_id AND categoury.cat_id = 13 LIMIT 1" ;
			$Select_join_query	= mysqli_query($connection,$Select_join);
			while($Select_join_result = mysqli_fetch_array($Select_join_query)){
	
			
			 ?>
             <h1 id="Android"> <?PHP echo $Select_join_result['Name']; ?></h1>
   
        <img src="admin/include/course_img/<?PHP echo $Select_join_result['course_img']; ?>"  width="100px" height="400px"/>
 
             </div>
            </div>
            
            
                    
            <div class="course-description col-xs-12">
            <div class="row">
                    <div class="description-title col-xs-12">
                <h2>Course Description</h2>
                <div class="discription-content col-xs-12">
                <p><?PHP echo $Select_join_result['Description']; ?>  </p>
                </div>
                
            </div>
                </div>
          
        
            </div>
            </div>
            <div class="course-info col-xs-4">

                <div class="info row">
                           <form method="post" class="col-xs-12" action="<?PHP $_SERVER['PHP_SELF'] ?>"> 

                                    <label>Date  : <?PHP echo date('d M y') ;// echo $Select_join_result['Price']; ?></label>  
                                    <hr>
                           
                                     <label>Category :<?PHP echo $Select_join_result['name']; ?></label>
                                    <hr>
                                   <label>Instractor: <?PHP echo $Select_join_result['Instructor']; ?></label>     
                                    <hr>
                            </form>
 <form method="post" action="watch_videos.php<?PHP echo '?id='.$Select_join_result['OCourceID'];echo'?Ct='.$Select_join_result['cat_id'] ?>">
                            
             <button value="watch video" class="btn hvr-sweep-to-right btn-block" name="web_design" onclick="widno.location:watch.php">
             Watch Course Online     
                 </button>  
                            </form>
                       <?PHP 
	
				  // check if the usr is a member 
				  
		 if(isset($_POST['mobile_app'])) {
				
				 
				  if( $_SESSION['logged_as_user'] == 'yes')
				  {
					   echo " <script> alert(' you can watch the mobile application video...')</script>"; 
					
					  } else{
							   echo " <script> alert('Please Login First...')</script>"; 
							   exit();	   
						 } // Else #END 
					  
					
				
					  
		 } // if isset #END
				
				   
 } // While Loop END 		   
		  
					   ?>      
                            </div>
            </div>

         
               
                </div>
            </section>
            

<?php include "includes/templates/footer.php"; ?>