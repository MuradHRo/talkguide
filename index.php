<?php
include "handlers/data.php";
include "config.php";
$info = $connection->query("SELECT * FROM home");
$row = $info->fetch_all(MYSQLI_ASSOC)[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <!-- Primary Meta Tags -->
    <title>Tolkeguiden</title>
    <meta name="title" content="Tolkeguiden">
    <meta name="description" content="قاموس من العربية للنرويجية والعكس">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.tolkeguide.no/">
    <meta property="og:title" content="Tolkeguiden">
    <meta property="og:description" content="قاموس من العربية للنرويجية والعكس">
    <meta property="og:image" content="assets/imgs/meta_pic.jpg">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.tolkeguide.no/">
    <meta property="twitter:title" content="Tolkeguiden">
    <meta property="twitter:description" content="قاموس من العربية للنرويجية والعكس">
    <meta property="twitter:image" content="assets/imgs/meta_pic.jpg">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" media="print" href="assets/css/printing.css">
    <!-- Animate Library -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- Material Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
     <!--fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mada&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&family=Mada&display=swap" rel="stylesheet">
    <style>
        footer{
             clip-path: polygon(0% 0%,100% 21%,100% 100%,0 100%);
        }
    </style>

</head>

<body>
    <!-- Main Section -->
    <div class="home">
        <!-- Navbar -->
        <nav class="myNav navbar navbar-expand-lg navbar-light" >
            <a class="navbar-brand" href = 'index'><img src="assets/imgs/logo.png" alt="flags-logo" width="312" class="animated fadeIn"></a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                 <li class="nav-item"><a href="https://tolkeguide.no/index"  class="nav-link">Forsiden</a></li>
                    <li class="nav-item"><a href="termlistet" class="nav-link">Termlister</a></li>
                    <li class="nav-item"><a href="ordlistet" class="nav-link">Ordlister</a></li>
                    <li class="nav-item"><a href="verblistet" class="nav-link">Verblister</a></li>
                    <li class="nav-item"><a href="om_oss" class="nav-link">Om oss</a></li>
                    <li class="nav-item"><a href="kontakt_oss" class="nav-link">Kontakt oss</a></li>
                    <li class="nav-item"><a href="<?= (isset($_SESSION['username']))?"dashboard":"logginn"?>" class="nav-link"><?= (isset($_SESSION['username']))?"Dashboard":"Logg inn"?></a></li>
                </ul>
            </div>
        </nav>
    
        <div class="main">
    
            <!-- End of Navbar -->
            <!-- Vision Section -->
            <div class="info">
                <h1 class="text-center wow bounceInLeft"><?= $row["title"]?></h1>
                <p>عزيزي الزائر. اهلا بك في موقعنا. يعد هذا الموقع بمثابة مرشد لك لترجمة الأفعال و الكلمات المتخصصة في عدة مجالات مثل المجال الطبي، القانوني، مكتب العمل الخ. لذا ان كنت تبحث عن ترجمة كلمات عادية غير متخصصة مثل سيارة ، مدرسة الخ فننصحك بزيارة موقع جوجل. مع وافر التحية و التقدير.</p>
            </div>
            <!-- End of Vision Section -->
        </div>
        <!-- End of Main Section -->
    </div>


    <!-- Search Section -->
    <div class="container-fluid">
        <div class="row">
            <div class="searchSection w-100">

                <!-- iPhone Pic -->
                <!--<div class="iphone-div col-lg-4 d-none d-lg-block ">-->
                <!--    <img src="assets/imgs/iphone.png" alt="iphone-img" width="422" data-wow-duration="1.5s" class="img-fluid wow slideInLeft">-->
                <!--</div>-->
                <!-- End of iphone pic -->

                <!-- Search Box -->
                <div class="searchBox col-lg-8 col-12 mx-auto">

                    <h3 class="text-center mb-4">Søĸ </h3>

                    <form action="" method="POST">
                        <div class="row input-group">
                            <div class="input-group mb-3 col-12 col-md-10" style="margin:0 auto;" >
                                <input type="text" class="form-control searchBoxInput mainSearch shadow-none" placeholder="Search Norwegian - Arabic Dictionary" id="searchBox" name="email">
                                <div class="input-group-append searchIcon">
                                    <span class="input-group-text material-icons">Søk</span>
                                </div>
                            </div>
                


                            <!--<div class="norwegianLayout col-4 col-md-2 mx-auto">-->
                            <!--    <a href="javascript:addLetter('å')">å</a>-->
                            <!--    <a href="javascript:addLetter('ø')">ø</a>-->
                            <!--    <a href="javascript:addLetter('æ')">æ</a>-->
                            <!--</div>-->
                        </div>
                    </form>
                    <!--<div class="langChange">-->
                    <!--    <span>Arabic</span>-->
                    <!--    <i class="material-icons" id="arrows-icon">compare_arrows</i>-->


                    <!--    <span>Norwegian</span>-->
                    <!--</div>-->
                    <ul class="list-group result">
                    </ul>

                </div>
                <!-- End of search box -->

            </div>
        </div>
    </div>
    <!-- End of search Section -->



    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020  </h4>
        <p>Powered by : <a href="https://www.peofree.com" target="_blank">PeoFree ltd.</a></p>

    </footer>

    <!-- End of footer -->







    <!-- Scripts -->
    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Ajax jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- End of Bootstrap -->
    <!-- Wow Library -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/custom.js"></script>

</body>

</html>
