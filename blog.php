<?php
     include "includes/templates/blogHeader.php";
     include "includes/templates/blogNavbar.php";
	 include "includes/functions/connect.php";
     ?>

     
            
           
                <?php directblog(); ?>
   
        

    <section id="web-design">
        <div class="container">
            <div class="section-header">
                <h1>Web Design</h1>
            </div>
            <div class="blog-content row">
                <div class="recent col-md-4">
                    <h3>Recent Posts</h3>
                    <?php webDesignRecentPosts(); ?>
                </div>
                <?php websedign(); ?>
            </div>
        </div>
    </section>
    <section id="web-develop">
        <div class="container">
            <div class="section-header">
                <h1>Wep Development</h1>
            </div>
            <div class="blog-content row">
                <div class="recent col-md-4 wow fadeIn" data-wow-duration="3s" data-wow-offset="100">
                    <h3>Recent Posts</h3>
					<?php webDevelopRecentPosts(); ?>
                </div>
                <?php webDevelop(); ?>
            </div>
        </div>
    </section>
    <section id="mobile-app">
        <div class="container">
            <div class="section-header">
                <h1>Mobile Application</h1>
            </div>
            <div class="blog-content row">
                <div class="recent col-md-4 wow fadeIn" data-wow-duration="3s" data-wow-offset="100">
                    <h3>Recent Posts</h3>
                	<?php MobileAppRecentPosts(); ?>
                </div>
                <?php MobileApp();	?>
            </div>
        </div>
    </section>
<?php include "includes/templates/blogFooter.php"; ?>

