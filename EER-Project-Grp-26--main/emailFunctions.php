<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require 'vendor/autoload.php';
//require_once "notLoggedIn.php";

function sendEmail($email)
{   
    $otp_data = isset($_SESSION['otp_data']) ? $_SESSION['otp_data'] : null;

    if ($otp_data) {
        $otp = $otp_data['otp'];
    } else {
        echo 'Error: OTP Missing or Invalid';
        return;
    }


    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'eerapplication@gmail.com';
    $mail->Password = ' '; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('eerapplication@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = 'Please Verify Your Email';
    $mail->Body    = 'Please Click On the Link Below to Verify' . 
        "\nhttps://eercalc.azurewebsites.net/verifyOTP.php?otp=" . $otp;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

function updateVerificationStatus($email, $conn)
{
    try{
        $sql = "UPDATE account SET verrifyEmail = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([1,$email]);
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        return $e;
    }
}
