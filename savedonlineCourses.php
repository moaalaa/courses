<?php 
    include "includes/templates/indexHeader.php";
    include "includes/templates/navbar.php";
?>

<table class="table table-bordered table-hover " >
                	<tr>
                    	<th >#</th>
                        <th >Name</th>
                        <th >insractor</th>
                        <th >video</th>
                    </tr>
                    <?php userOnlineCourses(); ?>
                </table>
<?php include "includes/templates/footer.php"; ?>