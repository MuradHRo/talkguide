<?php
include "data.php";
include "../config.php";
if(isset($_REQUEST["id"])){
    $id =$_REQUEST["id"];
    $tableName = $_REQUEST["tableName"];
    $verb_sql = $connection->query("SELECT * FROM $tableName WHERE id = '$id'");

    $verb = $verb_sql->fetch_all(MYSQLI_ASSOC)[0];
    $form1=$verb["Form1"];
    $form2=$verb["Form2"];
    $form3=$verb["Form3"];
    $form4=$verb["Form4"];
    $arabic=$verb["Arabic"];
    $norwegian=$verb["Norwegian"];
    if ($tableName=='verb')
    {
        echo "<table class='table'>
            <thead>
                <tr>
                <th>المصدر
                <br>Infinitiv</th>
                <th>الحاضر
                <br>Presens</th>
                <th>الماضي
                <br>Preteritum</th>
                <th>التام
                <br>Perfektum</th>
                <th>العربية
                <br>Arabisk</th>
                </tr>
            </thead>
            <tbody>
            <tr>
              <th>$form1</th>
              <td>$form2</td>
              <td>$form3</td>
              <td>$form4</td>
              <td>$arabic</td>
            </tr>
            </tbody>        
         </table>";
    }
    else
    {
        echo "<table class='table'>
            <thead>
                <tr>
                <th>النرويجيه
                <br>Norwegian</th>
                <th>العربية
                <br>Arabisk</th>
                </tr>
            </thead>
            <tbody>
            <tr>
              <td>$norwegian</td>
              <td>$arabic</td>
            </tr>
            </tbody>        
         </table>";
    }
}

?>