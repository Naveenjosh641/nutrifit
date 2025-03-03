<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail{
    
    public function __construct($remail){
        try{
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nutrifit.connect@gmail.com';
            $mail->Password = 'symt oxiq lpqq vdjw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->isHTML(true);
            
            $otp = rand(100000, 999999);

            $mail->setFrom('nutrifit.connect@gmail.com');
            $mail->addAddress($remail);
            $mail->Subject = "Enter This OTP Code to Complete Your Signup";
            $mail->Body = "Dear User,<br><br>Thank you for signing up for NutriFit!<br><br>Your one-time password (OTP) for completing your registration is: <strong>$otp</strong><br><br>Please enter this OTP on the signup page to complete your registration.<br><br>If you did not request this, please ignore this email.<br><br>Best regards,<br>The NutriFit Team";

            $mail->send();
            require_once '../includes/config.php';
            $_SESSION['otp']=$otp;
        }
        catch(Exception $e){
            echo " error " . $e->getMessage();
        }
    }
}