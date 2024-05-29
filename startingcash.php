
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}

$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";
if (!isset($_SESSION['startcash'])) {
    if (isset($_POST['submit'])) {
        $cash = $_POST['startcash'];
        if (!isset($cash)) {
            echo("Please input starting cash");
        }else {
            $_SESSION['startcash'] = $cash;
            header("location:home.php");
            exit;
        }
    }
}else {
    header("location:home.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starting Cash</title>
    <link rel="stylesheet" href="include\styles\indexstyle.css">
    <link rel="stylesheet" href="include\styles\global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="include\image\logo.png">
    <link rel="icon" type="image/png" href="include\image\sadas1.png">
    
    
</head>
<body>
<nav>
    <ul>
    <div class="logo">
        <img src="include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    </ul>
</nav>


<div class="maincontainer">
    <div class ="form" style="margin-top:4%; margin-left: 35%;">
    <form action="" method="post" style="padding:3%" >
    <h2 style=" display: block; text-align: center; margin-bottom: 12%; ">Starting Cash:</h2>
        <input type="text" name="startcash" pattern="\d+(\.\d{1,2})?" oninput="this.value = this.value.replace(/[^\d.]/g, '');" required placeholder="0">
        <button type="submit" name="submit" class="main-button">Submit</button>     
    </form>
</div>
</div>
</body>
</html>