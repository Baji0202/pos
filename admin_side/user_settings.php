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
    <title>User Settings</title>
</head>
<body>
    <br>

    <a href="adduser.php">Add User</a><br>
<table border='1' cellpadding='7'>
    <tr>
    <th>id</th>
    <th>email</th>
    <th>role</th>
    <th>firstname</th>
    <th>lastname</th>
    <th>modify</th>
    
    </tr>
    
    <?php 
    require_once "..\include\connect\dbcon.php";
   
    $sql = "SELECT * FROM user";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>" . $user_id . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $role . "</td>";
        echo "<td>" . $fname ."</td>";
        echo "<td>" . $lname . "</td>";
        if ($role != 'admin') {
            echo "<td><a href='update_user.php?id=$user_id'; ?>Update<a href='delete_user.php?id=$user_id'; ?>Delete</a></td>"; 
        } else {
            echo "<td></td>";
        }
       
        echo "</tr>";
    }
    echo '</table>';
    
?>
</body>
</html>