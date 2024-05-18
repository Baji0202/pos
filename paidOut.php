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

<nav>
    <div class="logo">
    <img src="include\image\sadas.png" alt="Company Logo" class="logo_pic">
        <div class="text_logo">POS System</div>
        <link rel="stylesheet" href="include\styles\global.css">
    </div>
    
    <div class="dropdown">
        <div class="acc_name" id="acc_name"><?php echo $loggedemail?></div>
        <!-- Dropdown content -->
        <div class="dropdown-content" id="logout_dropdown">
            <a href="cashmanagement.php">Back</a>
            <a href="home.php">Home</a>
            <a href="refund.php">Refund</a>
            <a href="logout.php" class="logout-btn">Logout</a>
            
        </div>
    </div>
</nav>


<div class="maincontainer">
<div class ="form" style="margin-top:3%;">
<form  method="post">
<h2 style=" display: block; text-align: center; margin-bottom: 12%; ">Add paid out</h2>
<input type="text" name="paidOut" pattern="\d+(\.\d{1,2})?" oninput="this.value = this.value.replace(/[^\d.]/g, '');" required placeholder="0.00">
<input type="submit" value="submit" name="submit" class="main-button">
    </form>
</body>
</div>
</div>
</html>