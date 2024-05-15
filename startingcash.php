
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");

}
$loggedemail = $_SESSION['email'];
require_once "include\connect\dbcon.php";

if (isset($_POST['submit'])) {
    $cash = $_POST['startcash'];
    if (!isset($cash)) {
        echo("Please input starting cash");
    }else {
        $_SESSION['startcash'] = $cash;
        header("location:home.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starting Cash</title>
</head>
<body>
    <form action="" method="post">
        Input starting cash in hand:
        <input type="text" name="startcash" pattern="\d+(\.\d{1,2})?" oninput="this.value = this.value.replace(/[^\d.]/g, '');" required placeholder="00.00">

        <input type="submit" value="submit" name="submit">
        
    </form>
</body>
</html>