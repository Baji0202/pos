<?php
session_start();
require_once "include\connect\dbcon.php";
try {
   
    
    if(isset($_POST["submit"])){
        if(empty($_POST['email']) || empty($_POST['pass'])){
            $message = "Please provide both your username and password for login";
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
                    $_SESSION['email'] = $email;
                    $role = $row['role'];
                    
    
                    $timestamp = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO `log`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
                    $stmt = $pdoConnect->prepare($sql);
                    $stmt->execute(["logged in",$timestamp,$row['user_id']]);
    
                    if ($role == 'admin' || $role == 'Admin') {
                        header("Location: admin_side\admindashboard.php");
                        exit;
                    } else {
                        header("Location: startingcash.php");
                        exit;
                    }
                }else{
                    $message = 'The username or password is incorrect';
                }
            } else {
                $message = 'No account found.';
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
    <meta name="viewport" content="width=device-width, initi.logal-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="include\styles\indexstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="login-page">
   <div class="bg-color">
        <div class="content">
        </div>

        <!-- <div class="picture"><img src="include\image\picture.png" alt="rami"></div> -->
        <div class="form">
        <h1>Log In</h1>
 
        <form class="login-form" method="post">
            <input type="email" placeholder="email" name="email"> 
            <div class="password-toggle">
                    <input type="password" placeholder="password" name="pass" id="password">
                    <span class="toggle-icon" onclick="togglePassword()"><i class="fas fa-eye" id="eye-icon"></i></span>
                </div>
            <input  class="button" type="Submit" name="submit" value="Submit">
            <div class="error-message">
            <?php
            if (isset($message)) {
            echo "<span class='error-message'>$message</span>";
            }
            ?>
            </div>
        </form>
        

        </div>
            
        <img class="background-image" src="include/image/bg.jpg" alt="rami">

</div>
        </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</html>