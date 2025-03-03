<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $leml = htmlspecialchars($_POST['lemail']);
    $lpas = htmlspecialchars($_POST['lpswrd']);
    if(empty($leml) || empty($lpas))die("All fields required");
    require_once '../classes/Dbh.php';
    require_once '../classes/User.php';
    $loguser = new User();
    if(!$loguser->isEmailExist($leml))die("Invalid User");
    if($loguser->check($leml, $lpas)=="done"){
        $usrd = new User();
        require_once 'config.php';
        // echo "configing\n";
        $_SESSION['person'] = $usrd->getNGHWGM($leml);
        $_SESSION['age']=$usrd->getAge($leml);
        $_SESSION['email']=$leml;
        header("Location: ../diet");
    }
    else {
        echo "Incorrect Password";
    }
}