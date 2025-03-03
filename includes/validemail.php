<?PHP

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = htmlspecialchars($_POST['email']);
    if(empty($email))die("null");
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))die("notValid");
    else{
        require_once '../classes/Dbh.php';
        require_once '../classes/User.php';
        $user = new User();
        if($user->isEmailExist($email))die("email exist");
        require_once '../classes/Mail.php';
        $mails = new Mail($email);
        echo "sent";
        require_once 'config.php';
        $_SESSION['email'] = $email;
        // echo $_SESSION['email'];
        // echo $_SESSION['otp'];
    }
}
else{
    header("Location: ../signup.html");
}