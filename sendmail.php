<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
require_once "include/connect/dbcon.php";


$emailContent = file_get_contents("php://input");
var_dump($emailContent);
$emailData = json_decode($emailContent, true);


if (!isset($emailData['name'], $emailData['email'], $emailData['body'])) {
    http_response_code(400);
    echo "Missing required fields";
    exit;
}

$customerName = $emailData['name'];
$customerEmail = $emailData['email'];
$emailbody = $emailData['body'];


$emailSent = sendEmailWithAttachment($customerEmail, $customerName, $emailbody);

if ($emailSent) {
    echo "Email sent successfully";
}

function sendEmailWithAttachment($email, $name, $emailbody) {
    try {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'posbsite3e@gmail.com'; //SMTP username
        $mail->Password = 'aded ceoh xlxz qhwg'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
        $mail->Port = 587; 

        // Set email parameters
        $mail->setFrom('posbsite3e@gmail.com', 'BANANA GROCERY STORE');
        $mail->addAddress($email, $name);
        $mail->addReplyTo('posbsite3e@gmail.com', 'BANANA GROCERY STORE');
        $mail->isHTML(true);
        $mail->Subject = 'Thank you for purchasing from us. You are BANANAMAZING!!';
        $mail->Body = $emailbody;
        $mail->AltBody = 'Please find attached your receipt.';

        // $mail->addStringAttachment($emailbody, 'receipt.pdf', 'base64', 'application/pdf'); // Uncomment to attach PDF

        // Send email
        $mail->send();
        return true; // Indicate successful sending
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false; // Indicate error
    }
}

