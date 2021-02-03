<?php
include "handlers/data.php";
include "config.php";
include "handlers/addWords.php";

$limit = isset($_GET["limit"]) ? $_GET["limit"] : 35;
$page = isset($_GET["page"])? $_GET["page"]:1;

if(isset($_GET["medsin"])){
    $listObj = new dataFetch($connection,"helse",$limit,$page);
}elseif(isset($_GET["juss"])){
    $listObj = new dataFetch($connection,"juss",$limit,$page);
}elseif(isset($_GET["nav"])){
    $listObj = new dataFetch($connection,"nav_og_sosial",$limit,$page);
}elseif(isset($_GET["trafikk"])){
    $listObj = new dataFetch($connection,"trafikk",$limit,$page);
}elseif(isset($_GET["pysk"])){
    $listObj = new dataFetch($connection,"pysk",$limit,$page);
}elseif(isset($_GET["norsk_utrykk"])){
    $listObj = new dataFetch($connection,"norsk_utrykk",$limit,$page);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Termlistet</title>
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
                <li class="nav-item"><a href="index"  class="nav-link">Forsiden</a></li>
                <li class="nav-item"><a href="termlistet" style="border-bottom: 7px solid #fff;"  class="nav-link">Termlister</a></li>
                <li class="nav-item"><a href="ordlistet"  class="nav-link">Ordlister</a></li>
                <li class="nav-item"><a href="verblistet" class="nav-link">Verblister</a></li>

                <li class="nav-item"><a href="om_oss" class="nav-link">Om oss</a></li>
                <li class="nav-item"><a href="kontakt_oss" class="nav-link">Kontakt oss</a></li>
                <li class="nav-item"><a href="<?= (isset($_SESSION['username']))?"dashboard":"logginn"?>" class="nav-link"><?= (isset($_SESSION['username']))?"Dashboard":"Logg inn"?></a></li>
            </ul>
            </div>
        </nav>

        
        <div class="content d-block" style=>
            <div class="adsSection">
            </div>
            <div class="searchBox-verb" style="height:auto;overflow:hidden; width:100%">
                    <h1>Termlister</h1>
                    <div class="container">
                    <div class="row departments my-4">
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="Termlistet?medsin" class="d-block text-center">
                            <img src="assets/imgs/icons/medicine.png" alt="" class="img-fluid">
                            <h4>Medsin</h4>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="Termlistet?juss" class="d-block text-center">
                            <img src="assets/imgs/icons/law.png" alt="" class="img-fluid">
                            <h4>Juss</h4>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="Termlistet?nav" class="d-block text-center">
                            <img src="assets/imgs/icons/work.png" alt="" class="img-fluid">
                            <h4>NAV</h4>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="Termlistet?trafikk" class="d-block text-center">
                            <img src="assets/imgs/icons/traffic.png" alt="" class="img-fluid">
                            <h4>Trafikk</h4>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="Termlistet?pysk" class="d-block text-center">
                            <img src="assets/imgs/icons/brain.png" alt="" class="img-fluid">
                            <h4>Psykisk helse</h4>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 mx-auto py-4">
                            <a href="?norsk_utrykk" class="d-block text-center">
                            <img src="assets/imgs/icons/book.png" alt="" class="img-fluid">
                            <h4>Norsk utrykk</h4>
                            </a>
                        </div>
                    </div>
                    </div>

            </div>



                    
            <div class="adsSection"></div>
        </div>






    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020</h4>
        <p>Powered by:<a href="https://www.peofree.com/" target="_blank"> PeoFree </a></p>

    </footer>
    <p class= "copywrightP">Tolkeguiden 2020</p>


    <!-- End of footer -->





    <!-- Scripts -->
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Ajax jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- End of Bootstrap -->
    <!-- Wow Library -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Bootbox js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
