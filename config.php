<?php
ob_start();
session_start();

$connection = mysqli_connect("tolkeguide.no.mysql","tolkeguide_nonorwegian","0162310296","tolkeguide_nonorwegian");
if(mysqli_connect_error()){
    echo "Connection Error". mysqli_connect_error();
}
$url = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
$url_array =explode(".",$url);
date_default_timezone_set("Europe/Oslo");
function goTrim($connection,$data) {
    $data = strip_tags($data);
    $data =htmlspecialchars($data);
    $data = mysqli_real_escape_string($connection,$data);
    return $data;
}

?>