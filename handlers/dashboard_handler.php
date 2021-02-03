<?php
class dashboard{
    private $connection;
    private $tableName;
    private $page;
    private $limit;
    public function __construct($connection,$tableName){
        $this->connection = $connection;
        $this->tableName = $tableName;
    }
    public function getDataInfo(){
        $sql = $this->connection->query("SELECT * FROM $this->tableName");
        $data = $sql->fetch_all(MYSQLI_ASSOC);
        $header = $data[0]["header"];
        $body = $data[0]["body"];
        $footer = $data[0]["footer"];
        return array($header,$body,$footer);
    }
    public function UpdateInfo($header,$body,$footer,$loggedUser){
        $sql =$this->connection->query("UPDATE $this->tableName SET header ='$header', body = '$body', footer ='$footer'");
        $activity = 'تحديث صفحة معلومات عنا<br>'.date("Y-m-d H:i:s");
        $sql= $this->connection->query("UPDATE users SET activity=CONCAT(activity,'$activity,') WHERE username = '$loggedUser'");
        
    }
    public function homeInfo(){
        $info = $this->connection->query("SELECT * FROM $this->tableName");
        $row = $info->fetch_all(MYSQLI_ASSOC)[0];
        $title= $row["title"];
        $body = $row["body"];
        return array($title,$body);
    }
    public function updateHome($title,$body){
        $this->connection->query("UPDATE home SET title = '$title',body='$body'");
    }
    public function getUsers($loggedUser){
        $str = "";
        $sql = $this->connection->query("SELECT * FROM users WHERE username != 'peofree'");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row){
            if($row["closed"] == "no") $status = "نشط";else $status = "محظور";
            $str .= "<tr><td>".$row["username"]."</td><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["added_by"]."</td><td>".$row["email"]."</td><td>".$row["added_date"]."</td><td>".$status."</td><td><button class='del_user btn btn-danger' id='".$row["id"]."'>X</button></td></tr>";
        }
        return $str;
    }
    public function insertUser($username,$first_name,$last_name,$password,$loggedUser,$email){
        $date = date("Y-m-d H:i:s");
        $username_to_check=$this->connection->query("SELECT * FROM users WHERE username = '$username'");
        $email_to_check = $this->connection->query("SELECT * FROM users WHERE email = '$email'");
        $error_array = array();
        if(mysqli_num_rows($username_to_check)>0){
            array_push($error_array,"اسم المستخدم موجود بالفعل");
        }
        if(mysqli_num_rows($email_to_check)>0){
            array_push($error_array,"البريد الإلكتروني موجود بالفعل");
        }
        if(empty($password)){
            array_push($error_array,"برجاء إدخال كلمة المرور");
        }
        if(empty($error_array)){
            $sql = $this->connection->query("INSERT INTO users VALUES (NULL,'$username','$first_name','$last_name','$password','$loggedUser','$email','$date',',','no','no')");
            $activity = 'إضافة عضو جديد<br>'.date("Y-m-d H:i:s");
            $sql= $this->connection->query("UPDATE users SET activity=CONCAT(activity,'$activity,') WHERE username = '$loggedUser'");
    
            
        }
        $str="";
        foreach ($error_array as $x){
            $str .="<p>$x</p>";
        }
        echo $str;
    }
    public function removeUser($id){
        $sql = $this->connection->query("UPDATE users SET closed = 'yes' WHERE id = '$id'");
    }
    public function getUserActivity($username){
        $sql = $this->connection->query("SELECT activity FROM users WHERE username = '$username' ");
        $activity_row = $sql->fetch_all(MYSQLI_ASSOC)[0]["activity"];
        $activity_array = explode(",",$activity_row);
        $returnData= "";
        if (substr_count($activity_row,",")-1 == 0){
            $returnData = "<p>لا يوجد أي نشاط بعد<p>";
        }else{
            $activity_array = array_reverse($activity_array);
            $returnData .="<h1 dir='rtl'>تشاط العضو<br>$username</h1><hr>";
            foreach ($activity_array as $activity){
                $returnData .= "<h4>".$activity."<h4>";
            }

        }
        echo $returnData;

    }
    public function getOpenMessages(){
        $sql = $this->connection->query("SELECT * FROM complaints WHERE closed = 'no'");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);
        $returnTable="";
        if(empty($rows)){
            $returnTable ="<h1>لا توجد رسائل مفتوحة بعد</h1>";
        }else{
            foreach($rows as $row){
                $returnTable .=  "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["subject"]."</td><td>".$row["message"]."</td><td>".$row["date"]."</td><td><button class='btn btn-danger del_message' id='".$row["id"]."'>X</button></td></tr>";
            }
        }
        return $returnTable;
    }
    public function getClosedMessages(){
        $sql = $this->connection->query("SELECT * FROM complaints WHERE closed = 'yes'");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);
        $returnTable="";
        if(empty($rows)){
            $returnTable ="<h1>لا توجد رسائل مغلفة بعد</h1>";
        }else{
            foreach($rows as $row){
                $returnTable .=  "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["subject"]."</td><td>".$row["message"]."</td><td>".$row["date"]."</td></tr>";
            }
        }
        return $returnTable;

    }
    public function moveToClosed($id){
        $this->connection->query("UPDATE complaints SET closed = 'yes' WHERE id = '$id'");
    }
    public function wordsToAdd(){
        $sql = $this->connection->query("SELECT * FROM words_to_add WHERE closed = 'no'");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);
        $returnTable="";
        if(empty($rows)){
            $returnTable ="<h1>لا توجد للكلمات للإضافة مفتوحة بعد</h1>";
        }else{
            foreach($rows as $row){
                $returnTable .=  "<tr><td>".$row["word"]."</td><td>".$row["email"]."</td><td>".$row["notes"]."</td><td>".$row["tableName"]."</td><td><button class='btn btn-danger del_wordToAdd' id='".$row["id"]."'>X</button></td></tr>";
            }
        }
        return $returnTable;



    }
}



?>