<?php
session_start();
require_once "..\include\connect\dbcon.php";


if (!isset($_SESSION['user_id'])){
    header("location: index.php");
}

if (isset($_POST['add'])) {
    $inputFields = array("fname","lname","role", "email", "pass"); // Array of input field names
    $emptyFields = array(); // Array to store empty fields
    
    foreach ($inputFields as $field) {
      if (empty($_POST[$field])) {
        $emptyFields[] = $field;
      }
    }
    
    if (!empty($emptyFields)) {
      echo "Please fill out the following fields: ";
      echo implode(", ", $emptyFields); // Join empty fields with comma and space
    } else {

        $fname =trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
        $role = $_POST['role'];
      
        $sql = "INSERT INTO `user`(`email`, `password`, `role`, `fname`, `lname`) VALUES (?,?,?,?,?)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([$email,$pass,$role,$fname,$lname]);
        $lastId = $pdoConnect->lastInsertId();
        $_SESSION['user_id']=3;
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `log`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
$stmt = $pdoConnect->prepare($sql);
$stmt->execute(["Inserted a new user,user_id: $lastId",$timestamp,$_SESSION['user_id']]);
  header("location:user_settings.php"); 
    
}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount_update.css">
</head>

<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div> 
</div>
<div><a href="user_settings.php">Back</a>
</div>
</nav>

<body>
    <form method="post">
        Firstname:
        <input type="text" name="fname"><br>
        Lastname:
        <input type="text" name="lname" ><br>
        Role:
        <select name="role" id="">
            <option value=""></option>
            <option value="Admin">Admin</option>
            <option value="Cashier">Cashier</option>
        </select><br>
        Email:
        <input type="email" name="email"><br>
        Password:
        <input type="password" name="pass"><br>
        <input type="submit" name="add" value="Add User">
    </form>
</body>
</html>