<?php
include "handlers/data.php";
include "config.php";
include "handlers/addWords.php";
include "handlers/login_handler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginn</title>
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" media ="print" href="assets/css/printing.css" >
    <!-- Animate Library -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
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
 

    <!-- Navbar -->
    <nav class = "myNav navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href = 'index'><img src="assets/imgs/logo.png" alt="flags-logo" width="312" class="animated fadeIn"></a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index"  class="nav-link">Forsiden</a></li>
                 <li class="nav-item"><a href="termlistet" class="nav-link">Termlistet</a></li>
                 <li class="nav-item"><a href="ordlistet"   class="nav-link">Ordlistet</a></li>
                <li class="nav-item"><a href="verblistet" class="nav-link">Verblistet</a></li>
                <li class="nav-item"><a href="om_oss" class="nav-link">Om oss</a></li>
                <li class="nav-item"><a href="kontakt_oss" class="nav-link">Kontakt oss</a></li>
                <li class="nav-item"><a href="logginn" style="border-bottom: 7px solid #fff;" class="nav-link">Logg inn</a></li>
            </ul>
            </div>
        </nav>


<!-- Login Form -->
<div class="container formContainer d-flex justify-content-center align-items-center">
<form method="POST" class="text-center" id="loginForm">
    <h1>Logg inn</h1>
    <div class="form-group w-80">
    <label for="uname">
Brukernavn
</label>
        <input type="text" name="uname" id="uname" class="form-control">
        <p>
            <?php
            if(in_array("برجاء إدخال اسم المستخدم",$error_array)){
                echo "برجاء إدخال اسم المستخدم";
            }
            ?>
        </p>
    </div>
    <div class="form-group">
        <label for="pw">
      Passord
        </label>
        <input type="password" name="pw" id="pw" class="form-control">
        <p><?php
            if(in_array("برجاء إدخال كلمة المرور",$error_array)){
                echo "برجاء إدخال كلمة المرور";
            }
        ?></p>
    </div>
    <button type="submit" class="btn btn-primary" name="login">Logg inn</button>
    <p><?php
            if(in_array("اسم المستخدم أو كلمة المرور غير صحيح",$error_array)){
                echo "اسم المستخدم أو كلمة المرور غير صحيح";
            }
    ?></p>
</form>

</div>
<!-- End of login form -->

    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020</h4>
        <p>Powered by:<a href="https://www.peofree.com/" target="_blank"> PeoFree ltd. </a></p>

    </footer>
    <p class= "copywrightP">Tolkeguiden 2020</p>


    <!-- End of footer -->


    <!-- Scripts -->
    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Ajax jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- End of Bootstrap -->
    <!-- Wow Library -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/custom.js"></script>
</body>
</html>