<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '192.168.29.105',
    'httponly' => true,
    'samesite' =>true
]);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();

if(!isset($_SESSION['created'])){
    $_SESSION['created'] = time();
    session_regenerate_id(true);
}
else{
    if(time() - $_SESSION['created'] > 300){
        $_SESSION['created'] = time();
    }
}

if(isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 7200 ){
    session_unset();
    session_destroy();
    header("Location: ../login.html");
    exit();
}
$_SESSION['last_activity'] = time();

if(!isset($_SESSION['user_agent'])){
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}
if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    header("Location: ../login.html");
    exit();
}

header("Content-Security-Policy: default-src 'self'; script-src 'self' https://trusted-cdn.com; style-src 'self' https://trusted-cdn.com;");