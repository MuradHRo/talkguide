<?php
include "handlers/data.php";
include "config.php";
include "handlers/addWords.php";

$limit = isset($_POST["limit"]) ? $_POST["limit"] : 35;
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


<form action="" method="POST" style="display:flex;" class="search-Form">
    <div class="input-group" >
                <input type="text" class="form-control searchBoxInput shadow-none" onkeyup="loadWords(1);" placeholder="Search Norwegian - Arabic Dictionary" id="searchBox" name="email">
                <div class="input-group-append searchIcon">
                    <span class="input-group-text material-icons">search</span>
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
    <form method = "POST" id="filterForm">
        <!-- <div class="form-group" id="filter">
            <label for="filterOption">Filter</label>
            <select id="filterOption" class="form-control" name="limit" onchange="limitChange();">
                <option disabled="disabled" selected="selected">Limit</option>
                <?php foreach([25,50,100,250,500] as $num): ?>
                <option <?php if($limit == $num) echo "selected"; ?> value = <?=$num?> class > <?=$num?> </option>
                <?php endforeach ?>
            </select> -->
            <a href="javascript:printDoc();" class ="printBtn"> Print</a>
        </div>
    </form>
    <!-- End of Search Box -->
    <div class="results">

    <table class="results-table">
    <thead class="table-head">
        <tr>
            <th>النرويجية<br>Norsk</th>
            <th>العربية<br>Arabisk</th>
            <?= (isset($_SESSION["username"]))?"<th class='bg-danger'>إزالة</th>":"" ?>

        </tr>
    </thead>
    <tbody id="results-body">
        <?php
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
