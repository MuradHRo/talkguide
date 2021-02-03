<?php
include "data.php";
include "../config.php";
if(isset($_REQUEST["pattern"])){
    $pattern = $_REQUEST["pattern"];

    // Search in verbs
    $verb_sql = $connection->query("SELECT * FROM verb  WHERE Form1 LIKE '%$pattern%' OR Form2 LIKE '%$pattern%' OR Form3 LIKE '%$pattern%' OR Form4 LIKE '%$pattern%' OR Arabic LIKE '%$pattern%' LIMIT 100");
    $verbs = $verb_sql->fetch_all(MYSQLI_ASSOC);
    $verbs_list ="";
    foreach($verbs as $item){
        $form1 = $item["Form1"];
        $arabic = $item["Arabic"];
        $verb_id = $item["id"];
        $verbs_list .= "<li class='list-group-item'><a href='javascript:getWord($verb_id,".'"verb"'.")' class='result_item'><p>$form1</p><p>$arabic</p></a></li> ";
    }
    echo $verbs_list;
    $tables = array("helse","juss","nav_og_sosial","norsk_utrykk","trafikk","pysk","words");
    $word_list="";
    foreach ($tables as $table){
        $words_sql=$connection->query("SElECT * FROM $table WHERE Norwegian LIKE '%$pattern%' OR Arabic LIKE '%$pattern%' LIMIT 100");
        $words=$words_sql->fetch_all(MYSQLI_ASSOC);
        foreach($words as $item){
            $norwegian = $item["Norwegian"];
            $arabic = $item["Arabic"];
            $word_id = $item["id"];
            $word_list .= "<li class='list-group-item'><a href='javascript:getWord($word_id,".'"'.$table.'"'.")' class='result_item'><p>$norwegian</p><p>$arabic</p></a></li> ";
        }
    
    }
    echo $word_list;
}

?>