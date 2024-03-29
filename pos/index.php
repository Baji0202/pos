<?php
session_start();
require_once "include\connect\dbcon.php";
try {
   
    
    if(isset($_POST["submit"])){
        if(empty($_POST['email']) || empty($_POST['pass'])){
            echo "Please provide both your username and password for login";
        }
        else{
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = $pdoConnect->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount()>0) {
                if($row && password_verify($_POST['pass'], $row['password'])){
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['user_id'] = $row['user_id'];
    
                    $role = $row['role'];
                    
    
                    $timestamp = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO `log`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
                    $stmt = $pdoConnect->prepare($sql);
                    $stmt->execute(["logged in",$timestamp,$row['user_id']]);
    
                    if ($role == 'admin' || $role == 'Admin') {
                        header("Location: admin_side\admindashboard.php");
                        
                    } else {
                        header("Location: home.php");
                        
                    }
                    $pdoConnect = null;
                        $stmt = null;
                        exit;
                }else{
                    echo 'The username or password is incorrect';
                }
            } else {
                echo 'No account found.';
            }
            
            
            
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="include\styles\indexstyle.css">
</head>
<body>
<div class="login-page">
        <div class="form">
        <h1>POS System</h1>
        <form class="login-form" method="post">
            <input type="email" placeholder="sample@gmail.com" name="email"> 
            <input type="password" placeholder="password" name="pass">
            <input  class="button" type="submit" name="submit" value="submit">
        </form>
        </div>
    </div>
</body>
</html>