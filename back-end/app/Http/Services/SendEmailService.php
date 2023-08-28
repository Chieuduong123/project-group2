<?php

namespace App\Http\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendEmailService
{
    public function sendVerificationEmail($email)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'anhd10315@gmail.com';
            $mail->Password = 'sahguxffvzeahbzs';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('anhd10315@gmail.com', 'Juong Job');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email verification';
            $mail->Body = '<h2>You have registered successfully</h2>';

            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
