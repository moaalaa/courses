<style> 
ul { padding-left:40px ; list-style:none ; text-align:center}
 li {; padding-top:10px;}
 #hiddin_area { display:none}

</style>
<?php
        include "includes/templates/navbar.php";
        include "includes/templates/UserProfileHeader.php";
  
     ?>
    <section id="user-profile-content">
        <div class="container">
            <div class="row">

        <div class='user-information col-xs-12 col-md-12'>
                    <div id='user-face' >
                    
                    <?PHP
					$id = $_GET['id'];
					$connection    = mysqli_connect( "localhost" ,"root" , "" , "cources" );
					$select_videos = "SELECT * FROM `onlinecources` where OCourceID = '$id' " ;
					$select_videos_query = mysqli_query($connection ,$select_videos);
					while( $select_videos_reslt= mysqli_fetch_array($select_videos_query))
					{
						
					 ?>
                    
                 <?PHP echo $select_videos_reslt['Links']; ?>
   
                    </div>
                    <div id='user-info'>
                        <div class='lable'>
                            <p><b>Course Name:</b> <?PHP echo $select_videos_reslt['Name']; ?></p>
                             <p><b>Instructor Name:</b> <?PHP echo $select_videos_reslt['Instructor']; ?></p>
                       
                        </div>
                      <br>
                      <?PHP 
					   } // while loop END
					  ?>
                            <div class='lable'>
        
         <p><b>
         <button id="SHOW" class="btn hvr-sweep-to-right btn-block" style="color:#000; background-color:#FC6"> Watch other courses</button>
         
         </b></p>
         
         <!-- // course links   //-->
         <div class='lable' id="hiddin_area"> 
          <ul > 
               <?PHP 
			   $select_ALL   = " SELECT * FROM `onlinecources` " ;
			   $select_query = mysqli_query($connection , $select_ALL);
			   while( $rsult = mysqli_fetch_array( $select_query)){
			    ?>   
          
           <li> 
         <h3><b> <big><a href="#"> <?PHP echo $rsult['Name']; ?> </a></big> </b> </h3>
          <br /><br /> <?PHP echo $rsult['Links']; ?>
           <br />
             
           </li>
<?PHP }?> 
 
           </ul>

            </div>

                        </div>
                   
                         
                   
                    </div>
      
                  
                </div>
            
   
            </div>
             
        </div>
       
    </section>
    
    <script src="js/jquery.min.js"> </script>
     <script> 
         $(document).ready(function(e) {
           $("#SHOW").click(function(){
			   $("#hiddin_area").slideDown(4000).fadeIn();
			   
			   })   
        });
     </script>
     
     
<?php  include "includes/templates/footer.php"; ?>


