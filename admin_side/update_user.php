<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:..\index.php");
}

    require_once "..\include\connect\dbcon.php";
include_once "log.php";
if (isset($_POST['update'])) {
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $id = $_GET['id'];
    if (empty($email)&&empty($role)&&empty($fname)&&empty($lname)) {
        echo"All fields are required";
    }
    else {
        $sql = "UPDATE `user` SET `email` = ?,`role` = ?,`fname`= ?,`lname`= ? WHERE user_id = ?";
    $stmt = $pdoConnect->prepare($sql);
    

    if ($stmt->execute([$email,$role,$fname,$lname,$id])) {
        loghistory($pdoConnect,"Updated user, user_id: $id");
        header("location:user_settings.php");
    }
}
    }
       

    $sql = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$_GET['id']]);

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdoConnect = null;

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
<body>
<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="user_settings.php">Back</a>
</div>

</nav>

    <form action="" method="post">
username:
<input type="text" value="<?php echo $row[0]['email'];?>" name="email"> <br>
role:
<input type="text" value="<?php echo $row[0]['role'];?>" name="role"> <br>
firstname:
<input type="text" value="<?php echo $row[0]['fname'];?>" name="fname"> <br>
lastname:
<input type="text" value="<?php echo $row[0]['lname'];?>" name="lname"> <br>

<input type="submit" value="update" name="update">
    </form>
</body>
</html>