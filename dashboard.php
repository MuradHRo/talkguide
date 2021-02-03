<?php
include "handlers/data.php";
include "config.php";
include "handlers/addWords.php";
include "handlers/login_handler.php";
include "handlers/dashboard_handler.php";
if(isset($_SESSION["username"])){
    $loggedUser = $_SESSION["username"];
    $userDetails = $connection->query("SELECT * FROM users WHERE username = '$loggedUser'");
    $row =$userDetails->fetch_all(MYSQLI_ASSOC);
}else{
    header("location:index");
}

$messages_sql =  $connection->query("SELECT * FROM complaints");
$messages_array = $messages_sql->fetch_all(MYSQLI_ASSOC);

// Messages Info fetch
function getMessagesInfo($data){
    $open = 0;
    $messages_count = 0;
    $today=0;
    $month=0;
    foreach ($data as $message){
        if ($message["closed"]=="no")$open++;
        if($message["date"] == date("Y-m-d")) $today++;
        if(date("m",strtotime($message["date"]))==date("m")) $month++;
        $messages_count ++;
    }
 
    return array($open,$messages_count,$today,$month);
}

// Member Info

$dep_sql = $connection->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='tolkeguide_nonorwegian' AND TABLE_NAME != 'aboutus' AND TABLE_NAME != 'complaints' AND TABLE_NAME != 'users' AND TABLE_NAME != 'words_to_add' AND TABLE_NAME != 'examples' AND TABLE_NAME != 'home'  ");
$deps = $dep_sql->fetch_all(MYSQLI_ASSOC);
$counter_array = $tables_array = "";
foreach($dep_sql as $dep){
    $tableName = $dep["TABLE_NAME"];
    $tables_array .= ",".$tableName;
    $sql = $connection->query("SELECT count(id) AS id FROM $tableName");
    $num = $sql->fetch_all(MYSQLI_ASSOC)[0]["id"];
    $counter_array .= ",".$num;
}
$dep_array = explode(",",$tables_array);
$counter_array = explode(",",$counter_array);
array_shift($dep_array);
array_shift($counter_array);
$counter_array = json_encode($counter_array);
$dep_array = json_encode($dep_array);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/dashboard.css">

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

<!-- Menu -->
    <div class="page d-flex">
        <div class="sidebar order-2 bg-primary d-flex flex-column align-items-center">
            <h3 class="text-center my-3"><a href="dashboard" class="text-white text-decoration-none">Tolkeguiden</a></h3>
            <ul class="text-center my-5">
                <li><a href="?page=messages">الرسائل</a></li>
                <li><a href="?page=editWords">التعديل على الكلمات</a></li>
                <?php
                if($row[0]['is_admin'] == 'yes'){
                    echo '
                <li><a href="?page=about_us">تعديل صفحة معلومات عنا</a></li>
                <li><a href="?page=homeInfo">تعديل بيانات الصفحة الرئيسية</a></li>
                <li><a href="?page=users">إضافة أو إزالة مستخدم</a></li>
                <li><a href="?page=user_info">تتبع نشاط المستخدمين</a></li>
 
';
                }
                ?>
                <li><a href="handlers/logout">تسجيل الخروج</a></li>
                </ul>

        </div>
        <div class="content order-1 w-100 text-center p-3">
            <h1 dir="rtl">مرحبًا <?php  echo $row[0]["first_name"]; ?></h1>
            <hr>


            <!-- start -->
            <div class="row">
            <div class="card col-lg-5 col-10 mx-auto my-2" dir="rtl">
                <div class="card-body">
                <h5 class="card-title">الرسائل</h5>
                <hr>
                <canvas id="msg" style="display: block; height: 338px; width: 677px;" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="card col-lg-5 col-10 mx-auto my-2">
                <div class="card-body">
                <h5 class="card-title">الأقسام</h5>
                <hr>
                <canvas id="dep" style="display: block; height: 338px; width: 677px;" width="400" height="400"></canvas>
                </div>
            </div>

            

            </div>
            <!-- end -->


            </div>

    <!-- <div class="col-md-5 d-flex" style="width:40%;" dir="rtl">
                    <canvas id="myChart" style="display: block; height: 338px; width: 677px;" width="400" height="400"></canvas>
                </div> -->


<!-- End of Menu -->



    <!-- Scripts -->
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Ajax jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <!-- BootBox js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <script src="assets/js/dashboard.js"></script>



<script>
var ctx = document.getElementById('msg');
var pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['مغلق', 'مفتوح'],
        datasets: [{
            data: [<?= getMessagesInfo($messages_array)[1] - getMessagesInfo($messages_array)[0] ; ?>, <?= getMessagesInfo($messages_array)[0]?>],
            backgroundColor: [
                '#7DBB42',
                '#BC2026',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive:true

    }
});

<?php
echo "var departments=".$dep_array.";\r\n"; echo "var counters=".$counter_array;
?>

var dep = document.getElementById("dep");
var bar = new Chart(dep,{
    type:"bar",
    data: {
        labels: <?= $dep_array?>,
        datasets: [{
            data: <?= $counter_array?>,
            backgroundColor: [
                '#7DBB42',
                '#BC2026',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive:true,
        legend: false

    }
}

)


</script>




<!-- Pages -->

<?php
if (isset($_GET["page"])){
    // About us page
    if ($_GET["page"] == "about_us"){
        $dashboard_obj =new dashboard($connection,"aboutus");
        $data_array =  $dashboard_obj->getDataInfo();
        $header = goTrim($connection,$data_array[0]);
        $arabic = goTrim($connection,$data_array[1]);
        $norwegian = goTrim($connection,$data_array[2]);
        $existText = "<h1>تعديل صفحة معلومات عنا</h1><hr><h4>العنوان الحالي</h4><p>$header</p><h4>النص العربي</h4><p>$arabic</p><h4> النص النرويجي</h4><p>$norwegian</p>";
        $form = '<form method="POST" style="flex-direction:column;direction:rtl;" class="updateAbout"><input type="text" class="form-control" name="header" placeholder="برجاء كتابة العنوان هنا"><textarea type="text" class="form-control" name="arabic" placeholder="برجاء كتابة النص العربي هنا"></textarea><textarea type="text" class="form-control" name="norwegian" placeholder="برجاء كتابة النص النرويجي هنا"></textarea><input class="btn btn-success update_btn" type="submit" value="تعديل" name="updateData"></form>';
        $script = "<script> $('.content').empty(); $('.content').html('$existText.$form'); updateData();</script>";
        echo $script;
        if(isset($_POST["header"])){
            if(!empty($_POST["norwegian"])){
                $norwegian =$_POST["norwegian"];
            }
            if(!empty($_POST["arabic"])){
                $arabic = $_POST["arabic"];
            }
            if(!empty($_POST["header"])){
                $header = $_POST["header"];
            }
            $norwegian = goTrim($connection,$norwegian);
            $arabic =goTrim($connection,$arabic);
            $header = goTrim($connection,$header);
            $dashboard_obj->UpdateInfo($header,$arabic,$norwegian,$loggedUser);
        }
    }elseif($_GET["page"] == "users"){
        $dashboard_obj = new dashboard($connection,"users");
        $rows = $dashboard_obj->getUsers($loggedUser);
        $rows = mysqli_real_escape_string($connection,$rows);
        $table = "<h1>الأعضاء</h1><table><thead><th>اسم المستخدم</th><th>الاسم الأول</th><th>اسم العائلة</th><th>أٌضيف بواسطة</th><th>البريد الإلكتروني</th><th>تاريخ الإضافة</th><th>حالة العضو</th><th>حظر العضو</th></thead>".$rows."</table>" ;
        $formBox = '<h1>إضافة عضو جديد</h1><form method="POST" style="flex-direction:column;direction:rtl;" class="userForm"><input type="text" class="form-control" name="username" placeholder="اسم المستخدم"><input type="text" class="form-control" name="first_name" placeholder="الاسم الأول"><input type="text" class="form-control" name="last_name" placeholder="الاسم الأخير"><input class="form-control" type="email" name="email" placeholder="البريد الإلكتروني"><input class="form-control" type="password" name="password" placeholder="كلمة المرور"><input type="hidden" value="'.$loggedUser.'" name="loggedUser"><input class="btn btn-success newUser" type="submit" value="إضافة" name="add_user"></form><div class="error_box"></div>';
        $script = "<script> $('.content').empty(); $('.content').html('$table.$formBox'); del_user(); newUser(); </script>";
        echo $script;
    

    }elseif($_GET["page"] == "user_info"){ 
        $dashboard_obj = new dashboard($connection,"users");
        $users_query = $connection->query("SELECT username FROM users ");
        $rows = $users_query->fetch_all(MYSQLI_ASSOC);
        $content = "<h1>صفحة تتبع نشاط الأعضاء</h1><hr><div class=".'"form-group input-group" dir="rtl">'.'<div class="input-group-append"> <label class="input-group-text" for="users" dir="rtl">اسم العضو:</label> </div>'."<select class=".'"form-control" id="users"><option disabled selected>قم بتحديد العضو</option>';
        foreach ($rows as $row){
            $content .= "<option value=".$row["username"].">".$row["username"]."</option>";
        }
        $content .= "</select></div>";
        $results='<p class="userResult"></p>';
        $script = "<script> $('.content').empty(); $('.content').html('$content$results'); userInfo();</script>";
        echo $script;
        
    }elseif($_GET["page"] == "messages"){
        $dashboard_obj = new dashboard($connection,"complaints");
        $rows = $dashboard_obj->getOpenMessages();
        $rows = mysqli_real_escape_string($connection,$rows);
        $rows_closed = $dashboard_obj->getClosedMessages();
        $rows_closed = mysqli_real_escape_string($connection,$rows_closed);
        $table_closed = "<h1>رسائل مغلقة</h1><table><thead><th>الاسم</th><th>البريد الإلكتروني</th><th>العنوان</th><th>الرسالة</th><th>التاريخ</th></thead>".$rows_closed."</table>" ;
        $table = "<h1>رسائل مفتوحة</h1><table><thead><th>الاسم</th><th>البريد الإلكتروني</th><th>العنوان</th><th>الرسالة</th><th>التاريخ</th><th>نقل إلى الرسائل المغلقة</th></thead>".$rows."</table>" ;
        $script = "<script> $('.content').empty(); $('.content').html('$table.$table_closed'); del_message();</script>";
        echo $script;

    }elseif($_GET["page"] == "editWords"){
        $form_add = '<h1>إضافة كلمة جديدة</h1><form class = "newWordForm" method="POST" dir="rtl"><input type="text" class="form-control" name="norwegian" placeholder="الكلمة بالنرويجية"><input type="text" class="form-control" name="arabic" placeholder="الكلمة بالعربية">';
        $content = "<div class=".'"form-group input-group" dir="rtl">'.'<div class="input-group-append">  </div>'."<select class=".'"form-control" id="deps"><option disabled selected>القسم</option>';
        foreach ($deps as $row){
            if ($row["TABLE_NAME"] != "verb"){
                $content .= "<option value=".$row["TABLE_NAME"].">".$row["TABLE_NAME"]."</option>";
            }
        }
        $content .= "</select></div>";
        $form_add .= $content.'<input type="submit" class="btn btn-primary" value="إضافة" id="addNewWord" name="addNewWord"></form>';
        $form_edit = '<hr><h1>إضافة فعل جديد</h1><form class = "newVerbForm" method="POST" dir="rtl"><input type="text" class="form-control" name="form1" placeholder="الفعل بالنرويجية"><input type="text" class="form-control" name="form2" placeholder="التصريف الأول"><input type="text" class="form-control" name="form3" placeholder="التصريف الثاني"><input type="text" class="form-control" name="form4" placeholder="التصريف الثالث"><input type="text" class="form-control" name="arabic" placeholder="القعل بالعربية"></form><input type="submit" class="btn btn-primary" value="إضافة" id="addNewVerb" name="addNewVerb">';

        $script = "<script> $('.content').empty(); $('.content').html('$form_add$form_edit'); preventForms();</script>";

        echo $script;
    }elseif($_GET["page"] == "words_to_add"){
        $dashboard_obj = new dashboard($connection,"complaints");
        $rows = $dashboard_obj->wordsToAdd();
        $rows = mysqli_real_escape_string($connection,$rows);
        $table = "<h1>كلمات لللإضافة</h1><table><thead><th>الكلمة</th><th>البريد الإلكتروني</th><th>ملاحظات</th><th>اسم القسم</th><th>إزالة</th></thead>".$rows."</table>";
        $script = "<script> $('.content').empty(); $('.content').html('$table'); del_wordToAdd();</script>";
        echo $script;
    }elseif($_GET["page"] == "homeInfo"){
        $dashboard_obj =new dashboard($connection,"home");
        $data_array =  $dashboard_obj->homeInfo();
        $title = goTrim($connection,$data_array[0]);
        $body = goTrim($connection,$data_array[1]);
        $existText = "<h1>تعديل الصفحة الرئيسية</h1><hr><h4>العنوان الحالي</h4><p>$title</p><h4>النص العربي</h4><p>$body</p>";
        $form = '<form method="POST" style="flex-direction:column;direction:rtl;" class="updateHome"><input type="text" class="form-control" name="title" placeholder="برجاء كتابة العنوان هنا"><textarea type="text" class="form-control" name="body" placeholder="برجاء كتابة النص هنا"></textarea><input class="btn btn-success update_home_btn" type="submit" value="تعديل" name="updateData"></form>';
        $script = "<script> $('.content').empty(); $('.content').html('$existText.$form'); updateHome();</script>";
        echo $script;    
    }
    




}
?>

<!-- End of Pages -->


</body>
</html>