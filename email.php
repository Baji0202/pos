<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
require_once "include/connect/dbcon.php";


// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Read the request body
    $emailInfo = file_get_contents("php://input");
    var_dump($emailInfo);
    // Decode the JSON data
    $receiptinfo = json_decode($emailInfo, true);
    
    // Extract the receipt content
    $pdfContent = $receiptinfo;

    if (isset($_POST["email"]) && isset($_POST["name"])) {
        $email = $_POST["email"];
        $name = $_POST["name"];
        
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
}

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        Email:
        <input type="email" name="email" required>
        Name:
        <input type="text" name="name" required>
        <input type="submit" value="send email" name="submit" > 
    </form>
</body>
</html>