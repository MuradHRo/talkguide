<?php
$uname=$pw="";
$error_array =array();
if(isset($_POST["login"])){
    if(empty($_POST["uname"])){
        array_push($error_array,"برجاء إدخال اسم المستخدم");
    }else{
        $uname=$_POST["uname"];
        $uname=goTrim($connection,$uname);
    }
    if(empty($_POST["pw"])){
        array_push($error_array,"برجاء إدخال كلمة المرور");
    }else{
        $pw = $_POST["pw"];
        $pw =md5($pw);
        $pw =goTrim($connection,$pw);
    }
    if(empty($error_array)){
        $sql = $connection->query("SELECT * FROM users WHERE username='$uname' AND password='$pw' AND closed = 'no'");
        if($row=$sql->fetch_all(MYSQLI_ASSOC)){
            $_SESSION["username"] = $uname;
            $date = date("Y:m:d H:i:s");
            $Activity = "تسجيل دخول <br> $date";
            $connection->query("UPDATE users SET activity =CONCAT(activity,'$Activity,') WHERE username = '$uname'");
            header("Location:dashboard");
            
        }else{
            array_push($error_array,"اسم المستخدم أو كلمة المرور غير صحيح");
        }
    }

}

?>