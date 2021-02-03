<?php
include "data.php";
include "../config.php";
$limit = isset($_POST["limit"]) ? $_POST["limit"] : 35;
$page = isset($_GET["page"])? $_GET["page"]:1;
$tableName = $_REQUEST["tableName"];
$listObj = new dataFetch($connection,$tableName,$limit,$page);
$listObj->getSearchPagesNumber($_REQUEST["search"],$_REQUEST["pageNum"]);

?>