<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
require_once "include/connect/dbcon.php";


// $emailJson = file_get_contents("php://input");

// $emailData = json_decode($emailJson, true);


// if (!isset($emailData['name'], $emailData['email'], $emailData['pdfContent'])) {
//     http_response_code(400);
//     echo "Missing required fields";
//     exit;
// }

// $customerName = $emailData['name'];
// $customerEmail = $emailData['email'];
// $pdfContent = $emailData['pdfContent'];


// $emailSent = sendEmailWithAttachment($customerEmail, $customerName, $pdfContent);

// if ($emailSent) {
//     echo "Email sent successfully";
// }

function sendEmailWithAttachment($email, $name, $pdfContent) {
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
        $mail->setFrom('posbsite3e@gmail.com', 'BANANA WEAR?');
        $mail->addAddress($email, $name);
        $mail->addReplyTo('posbsite3e@gmail.com', 'BANANA WEAR?');
        $mail->isHTML(true);
        $mail->Subject = 'THANK YOU FOR YOUR PURCHASE FROM BANANA WEAR';
        $mail->Body = $pdfContent;
        $mail->AltBody = 'Please find attached your receipt.';

        // $mail->addStringAttachment($pdfContent, 'receipt.pdf', 'base64', 'application/pdf'); // Uncomment to attach PDF

        // Send email
        $mail->send();
        return true; // Indicate successful sending
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false; // Indicate error
    }
}
?>
