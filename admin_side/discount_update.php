<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:..\index.php");
}

    require_once "..\include\connect\dbcon.php";
include_once "log.php";
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $value = $_POST['value'];
    $id = $_GET['id'];
    if (empty($name)&&empty($type)&&empty($value)) {
        echo"All fields are required";
    }
    else {
        $sql = "UPDATE `discount` SET `name` = ?,`type` = ?,`value`= ? WHERE discount_id = ?";
    $stmt = $pdoConnect->prepare($sql);
    

    if ($stmt->execute([$name,$type,$value,$id])) {
        loghistory($pdoConnect,"Updated discount, discount_id: $id");
        header("location:discount.php");
    }else {
        echo"Something went wrong";
    }
}
    }
       

    $sql = "SELECT * FROM discount WHERE discount_id = ?";
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
    <title>Discount Update</title>
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount_update.css">
</head>
<body>


<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="discount.php">Back</a>
</div>

</nav>


    <form action="" method="post">
Name:
<input type="text" value="<?php echo $row[0]['name'];?>" name="name"> <br>
Type:
<select name="type"  >
    <option value="amount">Amount</option>
    <option value="percent">Percent</option>
</select>
Value:
<input type="text" value="<?php echo $row[0]['value'];?>" name="value"> <br>

<input type="submit" value="update" name="update">
    </form>
</body>
</html>