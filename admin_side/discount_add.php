<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:..\index.php");
}

    require_once "..\include\connect\dbcon.php";
include_once "log.php";
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $value = $_POST['value'];
    if (empty($name)&&empty($type)&&empty($value)) {
        echo"All fields are required";
    }
    else {
        $sql = "INSERT INTO `discount`(`name`, `type`, `value`) VALUES (?,?,?)";
    $stmt = $pdoConnect->prepare($sql);
    if ($stmt->execute([$name,$type,$value])) {
        loghistory($pdoConnect,"Added discount, discount_id: $id");
        header("location:discount.php");
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
</head>
<body>


    <form action="" method="post">
Name:
<input type="text" value="" name="name"> <br>
Type:
<select name="type" value="" >
    <option value="amount">Amount</option>
    <option value="percent">Percent</option>
</select>
Value:
<input type="text" value="" name="value"> <br>

<input type="submit" value="Add" name="add">
    </form>
</body>
</html>