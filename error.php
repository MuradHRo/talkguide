<?php
$error = $_SERVER["REDIRECT_STATUS"];
$error_title = "";
$error_message = "";
if($error == 404){
    $error_title ="404 Page Not Found";
    $error_message = "This File or document isn't on this server <br> Mahran";
}

echo $error_title."<br>".$error_message;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Mahran
</body>
</html>