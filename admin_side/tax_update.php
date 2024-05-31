<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:..\index.php");
}

    require_once "..\include\connect\dbcon.php";
include_once "log.php";


if (isset($_POST['update'])) {    
    $taxpercent = $_POST['tax_percent'];
    if (empty($taxpercent)) {
                echo"tax percent shouldnt be empty";
            }

    else {
        $id = $_GET['id'];
        $sql = "UPDATE `tax` SET `tax_percent` = ?WHERE id = ?";
    $stmt = $pdoConnect->prepare($sql);
    

    if ($stmt->execute([$taxpercent,$id])) {
        loghistory($pdoConnect,"Updated vat, tax_id: $id");
        header("location:tax.php");
    }else {
        echo"Something went wrong";
    }

    }
       
}
    $sql = "SELECT * FROM tax WHERE id = ?";
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
    <title>Tax Update</title>
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount_update.css">
</head>
<body>


<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="tax.php">Back</a>
</div>

</nav>


    <form action="" method="post">
Name:
<input type="text" value="<?php echo $row[0]['tax_name'];?>" name="tax_name" disabled> <br>

Tax Percent:
<input type="text" value="<?php echo $row[0]['tax_percent'];?>" pattern="\d+(\.\d{1,2})?" oninput="this.value = this.value.replace(/[^\d.]/g, '');" name="tax_percent"> <br>

<input type="submit" value="update" name="update">
    </form>
</body>
</html>