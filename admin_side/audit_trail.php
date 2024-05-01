<?php
session_start();
require_once "..\include\connect\dbcon.php";
if (!isset($_SESSION['user_id'])) {
    header("location: ..\index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="..\include\image\logo.png">
    <link rel="stylesheet" href="../include/styles/discount.css">
    <title>Audit Trail</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="..\include\image\sadas.png" alt="Company Logo">
        <div class="text_logo">POS System</div>
    </div>
    <div><a href="admindashboard.php">Back</a>
</div>

</nav>

<table border='1' cellpadding='7'>
    <tr>
    <th>ID</th>
    <th>Action</th>
    <th>Timestamps</th>
    <th>User_ID</th>
    </tr>
    
    <?php 
    require_once "..\include\connect\dbcon.php";
   
    $sql = "SELECT * FROM log";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $action . "</td>";
        echo "<td>" . $timestamp . "</td>";
        echo "<td>" . $user_id ."</td>";
        echo "</tr>";
    }
    echo '</table>';
    
?>



</table>

</body>
</html>