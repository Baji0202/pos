<?php
session_start();
if (!isset($_SESSION['user_id'])){
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount.css">
    <title>Discounts</title>
</head>

<body>
  

<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div> <a href='discount_add.php?id=$discount_id'>Add</a> 
    
</div>
<div><a href="admindashboard.php">Back</a>
</div>

</nav>
<table border='1' cellpadding='7'>
    <tr>
    <th>discount_id</th>
    <th>name</th>
    <th>value</th>
    <th>modify</th>
    
    </tr>

    <?php 
    require_once "..\include\connect\dbcon.php";
   
    $sql = "SELECT * FROM discount";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>" . $discount_id . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $value . "</td>";
        echo "<td class='modify'><a href='discount_update.php?id=$discount_id'>Update</a> | <a href='discount_delete.php?id=$discount_id'>Delete</a></td>";

        echo "</tr>";
    }
    echo '</table>';
    
?>
</body>
</html>