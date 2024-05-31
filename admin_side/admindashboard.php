<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: ..\index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../include/styles/admin.css">
    <link rel="icon" type="image/png" href="..\include\image\sadas.png">
    
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        <nav class="nav-menu">
            <ul>
                <li><a href="user_settings.php">User Settings</a></li>
                <li><a href="./cashmanagement.php">Cash Management</a></li>
                <li><a href="audit_trail.php">History logs</a></li>
                <li><a href="items_settings.php">Item Settings</a></li>
                <li><a href="discount.php">Discounts</a></li>
                <li><a href="tax.php">Tax</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
