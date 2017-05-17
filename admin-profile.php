<?php
        include "includes/templates/navbar.php";
        include "includes/templates/admin-profileHeader.php";

     ?>
    <section id="user-profile-content">
        <div class="container">
            <div class="row">
            <?php profileadmin();?>
            <div class='col-xs-12' id='edit-account'>    
            </div>
        </div>
    </section>
<?php include "includes/templates/footer.php"; ?>