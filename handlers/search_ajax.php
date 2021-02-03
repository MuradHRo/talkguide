<?php
include "data.php";
include "../config.php";

if(isset($_REQUEST["pageNum"])){
    $limit = isset($_POST["limit"]) ? $_POST["limit"] : 35;
    $listObj = new dataFetch($connection,$_REQUEST["tableName"],$limit,$_REQUEST["pageNum"]);
    $listObj->getSearchData($_REQUEST["pattern"]);
}else{
    $limit = isset($_POST["limit"]) ? $_POST["limit"] : 35;
    $page = isset($_GET["page"])? $_GET["page"]:1;

    $listObj = new dataFetch($connection,$_REQUEST["tableName"],$limit,$page);
    $listObj->getSearchData($_REQUEST["pattern"]);
}

?>