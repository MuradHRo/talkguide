<?php
include "handlers/data.php";
include "config.php";



$name="";
$email="";
$subject="";
$message="";
$error_array= array();
// Validtaion

if(isset($_POST["sendMessage"])){
    if(empty($_POST["name"])){
        array_push($error_array,"Name is required");
    }elseif(strlen($_POST["name"])<4 || strlen($_POST["name"] >25)){
        array_push($error_array,"Name should be between 4 and 25 character");
    }else{
        $name =$_POST["name"];
        $name = goTrim($connection,$name);
        $_SESSION["name"] = $name;
    }

if(isset($_POST["email"])){
    if(empty($_POST["email"])){
        array_push($error_array,"Email is required");
    }elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) === true){
        array_push($error_array,"Invalid Email");
    }else{
        $email =$_POST["email"];
        $email = goTrim($connection,$email);
        $_SESSION["email"] = $email;
    }
}

if(isset($_POST["subject"])){
    if(empty($_POST["subject"])){
        array_push($error_array,"Subject is requied");
    }else{
        $subject = $_POST["subject"];
        $subject =goTrim($connection,$subject);
        $_SESSION["subject"] = $subject;
    }
}


if(isset($_POST["message"])){
    if(empty($_POST["message"])){
        array_push($error_array,"This field is required");
    }elseif(strlen($_POST["message"])<10){
        array_push($error_array,"Your message is so short");
    }elseif(strlen($_POST["message"]>800)){
        array_push($error_array,"Message can't be more than 800 charachter");
    }else{
        $message = $_POST["message"];
        $message = goTrim($connection,$message);
        $_SESSION["message"] = $message;
    }
}
if(empty($error_array)){
    $date = date("Y-m-d H:i:s");
    $query = mysqli_query($connection,"INSERT INTO complaints VALUES (NULL,'$name','$email','$subject','$message','$date','no')");
    $_SESSION["name"]="";
    $_SESSION["email"] ="";
    $_SESSION["subject"]="";
    $_SESSION["message"]="";
    session_destroy();
    header("Location:kontakt_oss?success=1");
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Kontakt oss</title>
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
                                <li class="nav-item"><a href="termlistet" class="nav-link">Termlister</a></li>
                <li class="nav-item"><a href="ordlistet" class="nav-link">Ordlister</a></li>
                <li class="nav-item"><a href="verblistet"  class="nav-link">Verblister</a></li>

                <li class="nav-item"><a href="om_oss" class="nav-link">Om oss</a></li>
                <li class="nav-item"><a href="#" class="nav-link" style="border-bottom: 7px solid #fff;">Kontakt oss</a></li>
                <li class="nav-item"><a href="<?= (isset($_SESSION['username']))?"dashboard":"logginn"?>" class="nav-link"><?= (isset($_SESSION['username']))?"Dashboard":"Logg inn"?></a></li>
            </ul>
            </div>
        </nav>

        
        <div class="content-contactus">
        <div class="contact1">
		<div class="contactUsContainer">
                <!--<div class="contact1-pic js-tilt" data-tilt>-->
                <!--    <div>-->
                <!--        <h5>نرحب بجميع استفسارتكم و مقتراحاتكم</h5> -->
                <!--        <h6>و كذلك نرحب بك كمتطوع للإضافة في الموقع<br>  مع تحيات <br> منير / وليد / محمد</h6> -->


                <!--    </div>-->
                    <!--<img src="assets/imgs/iphone.png" alt="IMG">-->
                    
                <!--</div>-->


                <form class="contact1-form validate-form" method="POST">
                    <div class="form-title"> <h2>نموذج الاتصال</h2> 
                    <h5>نرحب بجميع استفسارتكم و مقتراحاتكم</h5> 
                    <h6>و كذلك نرحب بك كمتطوع للإضافة في الموقع<br>  مع تحيات : منير / وليد / محمد</h6> 
                    </div>
                

                    <h3 class="text-success text-center mb-4">
                        <?php
                        if(isset($_GET["success"])){
                            echo "تم إرسال رسالتك بنجاح";
                            session_destroy();

                        }
                        
                        ?>


                    </h3>

                    <div class="form-input" >
                        <input class="field" type="text" name="name" placeholder="Name" value="<?php
                        if(isset($_SESSION["name"])){
                            echo $_SESSION["name"];
                        }
                        ?>">
                        <span class="shadow-effect"></span>
                        <p style="text-align:center;color:red;">
                        <?php
                        if(in_array("Name should be between 4 and 25 character",$error_array)){
                            echo "Name should be between 4 and 25 character";
                        }elseif(in_array("Name is required",$error_array)){
                            echo "Name is required";
                        }
                        ?>
                        </p>
                    </div>

                    <div class="form-input">
                        <input class="field" type="text" name="email" placeholder="Email" value="<?php
                        if(isset($_SESSION["email"])){
                            echo $_SESSION["email"];
                        }
                        ?>">
                        <span class="shadow-effect"></span>
                        <p style="text-align:center;color:red;">
                        <?php
                        if(in_array("Invalid Email",$error_array)){
                            echo "Invalid Email";
                        }elseif(in_array("Email is required",$error_array)){
                            echo "Email is required";
                        }
                        ?>
                        </p>
                    </div>


                    <div class="form-input">
                        <input class="field" type="text" name="subject" placeholder="Subject" value="<?php
                        if(isset($_SESSION["subject"])){
                            echo $_SESSION["subject"];
                        }
                        ?>">
                        <span class="shadow-effect"></span>
                        <p style="text-align:center;color:red;">
                        <?php
                        if(in_array("Subject is requied",$error_array)){
                            echo "Subject is requied";
                        }
                        ?>
                        </p>
                    </div>

                    <div class="form-input">
                        <textarea class="field" name="message" placeholder="Message"><?php
                        if(isset($_SESSION["message"])){
                            echo $_SESSION["message"];
                        }
                        ?></textarea>
                        <span class="shadow-effect"></span>
                        <p style="text-align:center;color:red;">
                        <?php
                        if(in_array("This field is required",$error_array)){
                            echo "This field is required";
                        }elseif(in_array("Your message is so short",$error_array)){
                            echo "Your message is so short";
                        }elseif(in_array("Message can't be more than 800 charachter",$error_array)){
                            echo "Message can't be more than 800 charachter";
                        }
                        ?>
                        </p>
                    </div>
                    <div class="contactUsBtn">
                        <button class="g-recaptcha sendBtn" data-sitekey="6LfkwzsaAAAAAKqvaqxwgMfuhjps8KUtrLe6FBrs" data-callback='onSubmit' data-action='submit' name="sendMessage" style="margin:0 auto;">
                            <span style="display:flex;align-items:center;">
                                Send Email
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        </div>



    


    <!-- Footer -->

    <footer>
        <h4>Tolkeguiden 2020</h4>
        <p>Powered by:<a href="https://www.peofree.com/" target="_blank"> PeoFree </a></p>

    </footer>
    <p class= "copywrightP">Tolkeguiden 2020</p>


    <!-- End of footer -->





    <!-- Scripts -->
    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- End of Bootstrap -->
    <!-- Wow Library -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Main Script -->
    <script src="assets/js/custom.js"></script>
    
    <!-- Capatcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
       function onSubmit(token) {
         document.getElementById("demo-form").submit();
       }
    </script>
</body>
</html>
