<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");

}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";
if (isset($_POST['submit'])) {
    $paidOut = $_POST['paidOut'];
    if (!isset($paidOut)) {
        echo"Please enter value.";
    } else {
        $_SESSION['paidOut'] -= $paidOut;
        header("location:cashmanagement.php");
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Out</title>
</head>
<body>
    <form  method="post">
<label>Add paid in</label>
<input type="text" name="paidOut" pattern="\d+(\.\d{1,2})?" oninput="this.value = this.value.replace(/[^\d.]/g, '');" required placeholder="0.00">
<input type="submit" value="submit" name="submit">
    </form>
</body>
</html>