<?php
include "../config.php";
include "dashboard_handler.php";
if(isset($_REQUEST["tableName"])){
    if($_REQUEST["tableName"] == "users"){
        $obj = new dashboard($connection,"users");
        if(isset($_REQUEST["id"])){
            $obj->removeUser($_REQUEST["id"]);    
        }
        else{
            $password = $_REQUEST["password"];
            if(!empty($password)){
                $password = md5($password);    
            }
            
            $obj->insertUser($_REQUEST["username"],$_REQUEST["first_name"],$_REQUEST["last_name"],$password,$_REQUEST["loggedUser"],$_REQUEST["email"]);
        }
    }elseif($_REQUEST["tableName"] == "complaints"){
        $obj = new dashboard($connection,"complaints");
        $obj->moveToClosed($_REQUEST["id"]);

    }elseif($_REQUEST["tableName"] == "words_to_add"){
        $id = $_REQUEST["id"];
        $connection->query("DELETE FROM words_to_add WHERE id = '$id'");
    }
}
if(isset($_REQUEST["username"])){
    $obj = new dashboard($connection,'users');
    $obj->getUserActivity($_REQUEST["username"]);
}

?>