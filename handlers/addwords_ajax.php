<?php
include "../config.php";
include "addwords.php";
$error_array = array();
$email= $_POST["emailWord"] ;
$notes= $_POST["notes"];
$email = strip_tags($email);
$notes = strip_tags($notes);
if(empty($_POST["word"])){
    array_push($error_array,"برجاء إدخال الكلمة");
}elseif(strlen($_POST["word"])>35){
    array_push($error_array,"الكلمة طويلة للغاية");
}else{
    $word =$_POST["word"];
    $word = strip_tags($word);
    $sendWordObj = new addWords($connection,$_REQUEST["tablName"]);
    $sendWordObj->AddToDataBase($word,$email,$notes);
}
if(!empty($$error_array)){
    foreach($error_array as $x){
     echo $x;
    }
}
?>