<?php
include "../config.php";
if(isset($_REQUEST["word_id"])){
    $tableName = $_REQUEST["tableName"];
    $word_id = $_REQUEST["word_id"];
    $connection->query("DELETE FROM $tableName WHERE id = '$word_id'");
}
if(isset($_REQUEST["arabic"])){
    if(isset($_REQUEST["form1"])){
        $form1 = $_REQUEST["form1"];
        $form2 = $_REQUEST["form2"];
        $form3 = $_REQUEST["form3"];
        $form4 = $_REQUEST["form4"];
        $arabic = $_REQUEST["arabic"];
        $connection->query("INSERT INTO verb VALUES (NULL,'$form1','$form2','$form3','$form4','$arabic','')");    
        var_dump($_REQUEST);
        $activity = 'إضافة فعل جديدة<br>'.date("Y-m-d H:i:s");
        $loggedUser = $_SESSION["username"];
        $sql= $connection->query("UPDATE users SET activity=CONCAT(activity,'$activity,') WHERE username = '$loggedUser'");

    }else{
        $norwegian =$_REQUEST["norwegian"];
        $arabic = $_REQUEST["arabic"];
        $tableName = $_REQUEST["tableName"];
        $connection->query("INSERT INTO $tableName VALUES (NULL,'$norwegian','$arabic')");    
        $activity = 'إضافة كلمة جديد<br>'.date("Y-m-d H:i:s");
        $loggedUser = $_SESSION["username"];
        $sql= $connection->query("UPDATE users SET activity=CONCAT(activity,'$activity,') WHERE username = '$loggedUser'");

    }
}



?>