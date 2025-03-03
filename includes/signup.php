<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $spswrd = htmlspecialchars($_POST['spswrd']);
    $conf = htmlspecialchars($_POST['conf-pass']);
    if(empty($spswrd) || empty($conf))die("Password is required");
    elseif($spswrd !== $conf)die("password and confirm password should be same");
    else{
        require_once '../classes/Dbh.php';
        require_once '../classes/User.php';
        $user = new User();
        require_once('config.php');
        if(isset($_SESSION['email'])){
            $semail = $_SESSION['email'];
            $user->insert($semail, $spswrd);
            header("Location: ../details.html");
            exit();
        }
    }
}
else{
    header("Location: ../login.html");
}