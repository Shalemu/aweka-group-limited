<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $company = htmlspecialchars($_POST['company']);
    $location = htmlspecialchars($_POST['location']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'mail.awekagroupltd.co.tz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@awekagroupltd.co.tz';
        $mail->Password   = 'Tanzania@@@2026';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('info@awekagroupltd.co.tz', 'AWEKA GROUP LIMITED');
        $mail->addAddress('info@awekagroupltd.co.tz');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Full Name: $name\nEmail: $email\nCompany: $company\nLocation: $location\nMessage: $message";

        $mail->send();

        // Redirect back to index.html with success
        header("Location: index.html?status=success");
        exit;

    } catch (Exception $e) {
        // Redirect back with error
        header("Location: index.html?status=error&message=".urlencode($mail->ErrorInfo));
        exit;
    }
}
?>