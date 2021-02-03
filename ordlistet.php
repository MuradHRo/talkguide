<?php
include "handlers/data.php";
include "config.php";
include "handlers/addWords.php";

$limit = isset($_GET["limit"]) ? $_GET["limit"] : 35;
$page = isset($_GET["page"])? $_GET["page"]:1;
$tableName= "words";
$word=$email=$notes="";
$error_array=array();

if(isset($_GET["sendWord"])){

    $email= $_GET["emailWord"] ;
    $email = goTrim($connection,$email);
    $notes= $_GET["notes"];
    $notes = goTrim($connection,$notes);
    if(empty($_GET["word"])){
        array_push($error_array,"برجاء إدخال الكلمة");
    }elseif(strlen($_GET["word"])>35){
        array_push($error_array,"الكلمة طويلة للغاية");
    }else{
        $word =$_GET["word"];
        $word = goTrim($connection,$word);
        $sendWordObj = new addWords($connection,"words");
        $sendWordObj->AddToDataBase($word,$email,$notes);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Ordlistet</title>
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
                <li class="nav-item"><a href="termlistet" class="nav-link">Termlister</a></li>
                <li class="nav-item"><a href="ordlistet" style="border-bottom: 7px solid #fff;"  class="nav-link">Ordlister</a></li>
                <li class="nav-item"><a href="verblistet" class="nav-link">Verblister</a></li>
                <li class="nav-item"><a href="om_oss" class="nav-link">Om oss</a></li>
                <li class="nav-item"><a href="kontakt_oss" class="nav-link">Kontakt oss</a></li>
                <li class="nav-item"><a href="<?= (isset($_SESSION['username']))?"dashboard":"logginn"?>" class="nav-link"><?= (isset($_SESSION['username']))?"Dashboard":"Logg inn"?></a></li>
            </ul>
            </div>
        </nav>

        
        <div class="content">
            <div class="adsSection">
            </div>
            <div class="searchBox-verb">
                    <h1>Ordlister</h1>
                    <!-- Search Box -->
                    <form action="" method="POST" style="display:flex;" class="search-Form">
                    <div class="input-group" >
                                <input type="text" class="form-control searchBoxInput shadow-none" placeholder="Search Norwegian - Arabic Dictionary" id="searchBox" name="email">
                                <div class="input-group-append searchIcon">
                                    <span class="input-group-text material-icons">Søĸ </span>
                                </div>
                            </div>
                        <!--<div class="norwegianLayout">-->
                        <!--    <a href="javascript:addLetter('å')">å</a>-->
                        <!--    <a href="javascript:addLetter('ø')">ø</a>-->
                        <!--    <a href="javascript:addLetter('æ')">æ</a>-->
                        <!--</div>-->
                    </form>
                    <!--<div class="langChange">-->
                    <!--    <span>Arabic</span>-->
                    <!--    <i class="material-icons" id="arrows-icon-verb">compare_arrows</i>-->
                    <!--    <span>Norwegian</span>-->
                    <!--</div>-->

                    
                    <!-- DropdownFilter -->
                    <form method = "GET" id="filterForm">
                        <div class="form-group" id="filter">
                            <label for="filterOption">Filter</label>
                            <select id="filterOption" class="form-control" name="limit" onchange="limitChange();">
                                <option disabled="disabled" selected="selected">Limit</option>
                                <?php foreach([25,50,100,250,500] as $num): ?>
                                <option <?php if($limit == $num) echo "selected"; ?> value = <?=$num?> class > <?=$num?> </option>
                                <?php endforeach ?>
                            </select>
                            <a href="javascript:printDoc();" class ="printBtn"> Skriv ut</a>
                        </div>
                    </form>
                    <!-- End of Search Box -->
                    <div class="results">

                    <table class="results-table">
                    <thead class="table-head">
                        <tr>
                            <th>Norsk</th>
                            <th>Arabisk</th>
                            <?= (isset($_SESSION["username"]))?"<th class='bg-danger'>إزالة</th>":"" ?>

                        </tr>
                    </thead>
                    <tbody id="results-body">
                        <?php
                        $listObj = new dataFetch($connection,"words",$limit,$page);
                        $listObj->getData();
                        ?>
	            	</tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="notFoundDiv"></div>

                    <nav aria-label="Page navigation" class = "page-pagination">
                        <ul class="pagination justify-content-center">
                            <?= $listObj->getPagesNumber(); ?>
                        </ul>
                    </nav>


                    <!-- End of Pagination -->
                    </div>
                
            </div>
                    
                    
            <div class="adsSection"></div>
        </div>






    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020</h4>
        <p>Powered by:<a href="https://www.peofree.com/" target="_blank"> PeoFree </a></p>

    </footer>
    <p class= "copywrightP">حقTolkeguiden 2020</p>


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
