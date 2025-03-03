<?php
require_once 'config.php';
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $otp = htmlspecialchars($_POST['otp']);
    if(empty($otp))die("null");
    elseif(isset($_SESSION['otp'])){
        if($otp == $_SESSION['otp']){
            echo "yes";
        }   
        else die("incorrect");
    }
    else die("notvalid");
}
else{
    header("Location: ../signup.html");
}