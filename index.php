<?php 
    include "includes/templates/indexHeader.php";
    include "includes/templates/navbar.php";
    ?>
    <header id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="single-item col-xs-12">
                    <div class="text-center" id="slider-1">
                        <h1>never stop learning</h1>
                        <p>are you ready?</p><a href="offline-courses.php"><button class="btn hvr-sweep-to-right">view courses</button></a>
                    </div>
                    <div class="text-center" id="slider-2">
                        <h1>take the first step</h1>
                        <p>are you ready?</p><a href="offline-courses.php"><button class="btn hvr-sweep-to-right">view courses</button></a>
                    </div>
                    <div class="text-center" id="slider-3">
                        <h1>take the first step</h1>
                        <p>are you ready?</p><a href="offline-courses.php"><button class="btn hvr-sweep-to-right">view courses</button></a>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- End Header -->
    <section id="welcome">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12 section-header">
                    <h1>Welcome To<br>
                    <span>Learn it's free</span></h1><img alt="line" src="img/line.png">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
                <div class="col-md-6 col-xs-12 section-content">
                    <iframe allowfullscreen="" frameborder="0" height="340" src="https://www.youtube.com/embed/i5qpS_D8Law" width="620"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section id="popular-courses">
        <div class="container">
            <div class="section-header">
            <h1>popular courses</h1><img alt="line" src="img/line.png"></div>
            <div class="section-content">
                <div class="row">
                    <div class="multiple-items col-xs-12">
                        <?php popular_courses(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="articles" style="background-color: #fff; box-shadow: 0 -2px 20px 1px #999; margin-bottom: 20px;">
        <div class="container">
            <div class="section-header">
                <h1>Recent articles</h1><img alt="line" src="img/line.png">
            </div>
            <div class="section-content row">
            <?php popular_articals(); ?>
            </div>
        </div>
    </section>
    <section id="courses-type">
        <div class="container">
            <div class="section-header">
            <h1>you can learn</h1><img alt="line" src="img/line.png"></div>
            <div class="section-content row">
                <div class="responsive col-xs-12">
                <?php learn(); ?>
                </div>
            </div>
        </div>
    </section>
<?php include "includes/templates/footer.php"; ?>
<!-- Externa Js File file - My File<script src="admin/js/script2.js"></script> -->