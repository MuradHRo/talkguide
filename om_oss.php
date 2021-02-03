<?php
include "handlers/data.php";
include "config.php";
include "handlers/dashboard_handler.php";
$aboutObj = new dashboard($connection,"aboutus") ;
$row = $aboutObj->getDataInfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Om oss</title>
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" media ="print" href="assets/css/printing.css" >
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



</head>
<body>
    <!-- Navbar -->
    <nav class = "myNav navbar navbar-expand-lg navbar-light">
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
                    <li class="nav-item"><a href="om_oss" style="border-bottom: 7px solid #fff;" class="nav-link">Om oss</a></li>
                    <li class="nav-item"><a href="kontakt_oss" class="nav-link">Kontakt oss</a></li>
                    <li class="nav-item"><a href="<?= (isset($_SESSION['username']))?"dashboard":"logginn"?>" class="nav-link"><?= (isset($_SESSION['username']))?"Dashboard":"Logg inn"?></a></li>
            </ul>
            </div>
        </nav>

        <div class="content" >
            <div id="about_us">
                <div class='about_us'>
                    <h1 class="text-center about_header"><?= $row[0];?></h1>
                    <p class="arabic "><?= $row[1];?></p>
                    <p class="norwegian "><?= $row[2]; ?></p>
                </div>
            </div>
        
        </div>




    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020</h4>
        <p>Powered by:<a href="https://www.peofree.com/" target="_blank"> PeoFree </a></p>

    </footer>
    <p class= "copywrightP">حقوق النشر و الطباعة محفوظة باسم القائمين علي الموقع</p>


    <!-- End of footer -->





    <!-- Scripts -->
    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
