<?php 
    include "includes/templates/indexHeader.php";
    include "includes/templates/navbar.php";
?>

<table class="table table-bordered table-hover " >
                	<tr>
                    	<th width='7%'>#</th>
                        <th width='7%'>Name</th>
                        <th width='7%'>Price</th>
                        <th width='7%'>Hours</th>
                        <th width='25%'>Image</th>
                        <th width='14%'>Describtion</th>
                        <th width='7%'>setas</th>
                    </tr>
                    <?php userCourses(); ?>
                </table>
<?php include "includes/templates/footer.php"; ?>