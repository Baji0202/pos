<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
include_once "sendmail.php";
require_once "include\connect\dbcon.php";

$emailJson = file_get_contents("php://input");

$receiptinfo = json_decode($emailJson, true);
// $receipt = $receiptinfo["pdfContent"];

if(isset($_POST["submit"] )) {
    $email = $_POST["submit"];
    $name = $_POST["name"];
sendEmailWithAttachment($email, $name,$receiptinfo);

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