<?php
     include "includes/templates/contact-usHeader.php";
     include "includes/templates/navbar.php";
	 contactUsInsert();
     ?>
    <header id="contact-us-header">
        <h1>Contact Us</h1><img alt="" src="img/line.png">
        <h2>We Wanna hear from you</h2>
    </header>
    <section id="contact-us-content">
        <div class="container">
            <div class="contact-us-map col-xs-12">
                <iframe allowfullscreen="" class="col-xs-12" frameborder="0" height="400" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13803.90341849937!2d31.2683238!3d30.1235044!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1469401096735" style="border:0" width="1170"></iframe>
            </div>
            <div class="contact-us-forms col-xs-12">
                <div class="form-header">
                    <h1>Contact Us</h1><img alt="" src="img/line.png">
                    <h2>We Wanna hear from you</h2>
                </div>
                <div class="contact-form col-xs-12 col-lg-8" >
                    <form class="col-lg-12 formValidation" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <input class="col-md-7 in inputValidation form-control" name="username" placeholder="Name" type="text"> 
                        <input class="col-md-7 in inputValidation form-control" name="email" placeholder="Email" type="email"> 
                        <input class="col-md-7 in inputValidation form-control" name="subject" placeholder="Subject" type="text"> 
                        <textarea class="col-xs-11 in inputValidation form-control" name="message" placeholder="Message" rows="5"></textarea>
                        <input type="submit" value="send" name="send" class="btn col-xs-7 btn-primary" style="background-color:#337ab7; color: #fff;" />
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include "includes/templates/footer.php"; ?>
<script src="admin/js/script2.js"></script> <!-- Externa Js File file - My File -->
<script src="js/jquery.min.js"></script>
    
        
    <script> 
   $(document).ready(function(e) {
    $('#textarea').fadeOut(6000);
});

    </script>